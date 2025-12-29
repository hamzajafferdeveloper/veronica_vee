@extends('layouts.professional')

@section('title', 'Professional Chat Page')

@section('content')
    <div class="chat-wrapper">
        @include('recruiter.chat.partials.sidebar')

        <div class="chat-main card">

            <!-- Chat Header -->
            <div id="chatHeader" class="chat-sidebar-single active d-none">
                <div class="img">
                    <img id="headerAvatar" src="{{ asset('assets/images/user.png') }}" alt="image"
                        style="border-radius: 100%; width:45px; height:45px;">
                </div>
                <div class="info">
                    <h6 id="headerName" class="text-md mb-0"></h6>
                    <p id="headerEmail" class="mb-0"></p>
                </div>
            </div>

            @include('recruiter.chat.partials.chat-messages')

            <form class="chat-message-box d-none" id="messageForm">
                @csrf
                <input type="text" name="chatMessage " style="padding: 10px" id="chatMessage" placeholder="Write message"
                    autocomplete="off">
                <div class="chat-message-box-action">
                    <button type="button" class="text-xl" title="Attach Image">
                        <iconify-icon icon="solar:gallery-linear"></iconify-icon>
                    </button>
                    <button type="submit"
                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                        Send
                        <iconify-icon icon="f7:paperplane"></iconify-icon>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let activeConversationId = null;
            let activeReceiverId = null;

            const professionalList = document.getElementById('professionalList');
            const chatContainer = document.querySelector('.chat-message-list');
            const searchInput = document.getElementById('professionalSearch');
            const messageForm = document.getElementById('messageForm');
            const chatInput = document.getElementById('chatMessage');
            const AUTH_ID = {{ auth()->id() }};

            const headerBox = document.getElementById('chatHeader');
            const headerName = document.getElementById('headerName');
            const headerEmail = document.getElementById('headerEmail');
            const headerAvatar = document.getElementById('headerAvatar');



            // Load professionals in sidebar
            function loadProfessionals() {


                fetch("{{ route('recruiter.chat.get-professional') }}")
                    .then(res => res.json())
                    .then(data => {
                        professionalList.innerHTML = '';
                        data.forEach(user => {
                            const div = document.createElement('div');
                            div.classList.add('chat-sidebar-single');
                            div.dataset.userId = user.id;
                            div.dataset.name = `${user.first_name} ${user.last_name}`;
                            div.dataset.avatar = user.model?.avatar ? '/storage/' + user.model.avatar :
                                '{{ asset('assets/images/user.png') }}';

                            div.innerHTML = `
                        <div class="img">
                            <img src="${div.dataset.avatar}" class="rounded-full" style="width:40px;height:40px;object-fit:cover;border-radius:100%">
                        </div>
                        <div class="info">
                            <h6 class="text-sm mb-1">${div.dataset.name}</h6>
                            <p class="mb-0 text-xs">Available</p>
                        </div>
                    `;

                            div.addEventListener('click', function() {
                                activeReceiverId = this.dataset.userId;

                                setActiveUser(this);
                                updateHeader(this.dataset.name, this.dataset.email, this.dataset
                                    .avatar);
                                messageForm.classList.remove('d-none');
                                getConversation(activeReceiverId);
                            });

                            professionalList.appendChild(div);
                        });


                        setTimeout(() => {
                            const urlParts = window.location.pathname.split('/');
                            const receiverIdFromURL = parseInt(urlParts[urlParts.length - 1]);

                            if (receiverIdFromURL) {
                                const userElement = Array.from(professionalList.children)
                                    .find(el => parseInt(el.dataset.userId) === receiverIdFromURL);

                                if (userElement) {
                                    messageForm.classList.remove('d-none');
                                    userElement.click();
                                }
                            }
                        }, 500)


                    });
            }

            function setActiveUser(selected) {
                document.querySelectorAll('.chat-sidebar-single').forEach(el => el.classList.remove('active'));
                selected.classList.add('active');
            }

            function updateHeader(name, email, avatar) {
                headerName.textContent = name;
                headerAvatar.src = avatar;
                headerEmail.textContent = email;
                headerBox.classList.remove('d-none');
            }

            function getConversation(receiverId) {
                fetch(`/recruiter/chat/conversation/${receiverId}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        activeConversationId = data.conversation_id;
                        updateURL(receiverId);
                        ListenToConversation(activeConversationId);
                        loadMessages(activeConversationId);
                    });
            }

            function ListenToConversation(conversationId) {
                window.Echo.channel(`conversation.${conversationId}`)
                    .listen('.message.sent', (e) => {
                        if (e.sender_id === AUTH_ID) return;
                        addMessageToUI(e)
                    })
            }

            function addMessageToUI(msg) {
                const isMine = msg.sender_id == AUTH_ID;

                const messageHTML = `
                    <div class="chat-single-message ${isMine ? 'right' : 'left'}">
                        ${!isMine ? `<img src="{{ asset('assets/images/user.png') }}" class="avatar-lg rounded-circle">` : ''}
                        <div class="chat-message-content ${isMine ? 'bg-primary' : 'bg-info'}">
                            <p class="mb-3">${msg.message}</p>
                            <p class="chat-time mb-0">
                                <span>${new Date(msg.created_at).toLocaleTimeString()}</span>
                            </p>
                        </div>
                    </div>
                `;

                chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }

            function loadMessages(conversationId) {
                fetch(`/recruiter/chat/messages/${conversationId}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(res => res.json())
                    .then(messages => {
                        chatContainer.innerHTML = '';
                        messages.forEach(msg => {
                            const messageHTML = `
                        <div class="chat-single-message ${msg.sender_id == AUTH_ID ? 'right' : 'left'}">
                            ${msg.sender_id != AUTH_ID ? `<img src="{{ asset('assets/images/user.png') }}" class="avatar-lg rounded-circle">` : ''}
                            <div class="chat-message-content ${msg.sender_id == AUTH_ID ? 'bg-primary ' : 'bg-info'}">
                                <p class="chat-text mb-3">${msg.message}</p>
                                <p class="chat-time mb-0"><span>${msg.time}</span></p>
                            </div>
                        </div>
                    `;
                            chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                        });
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    });
            }

            function updateURL(receiverId) {
                window.history.pushState({}, '', `/recruiter/chat/messages/${receiverId}`);
            }

            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = chatInput.value.trim();
                if (!message || !activeConversationId) return;

                fetch("{{ route('recruiter.chat.send') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            message,
                            conversation_id: activeConversationId
                        })
                    })
                    .then(res => res.json())
                    .then(() => {
                        chatContainer.insertAdjacentHTML('beforeend', `
                <div class="chat-single-message right">
                    <div class="chat-message-content">
                        <p class="mb-3">${message}</p>
                        <p class="chat-time mb-0"><span>now</span></p>
                    </div>
                </div>
            `);
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                        chatInput.value = '';
                    });
            });

            loadProfessionals();
        });
    </script>
@endpush
