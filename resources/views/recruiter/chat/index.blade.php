@extends('layouts.professional')

@section('title', 'Professional Chat Page')

@section('content')
    <div class="chat-wrapper">
        @include('recruiter.chat.partials.sidebar')
        <div class="chat-main card">
            <div class="chat-sidebar-single active">
                <div class="img">
                    <img src="{{ asset('assets/images/user.png') }}" alt="image" style="border-radius: 100%">
                </div>
                <div class="info">
                    <h6 class="text-md mb-0">Kathryn Murphy</h6>
                    <p class="mb-0">Available</p>
                </div>
            </div><!-- chat-sidebar-single end -->
            @include('recruiter.chat.partials.chat-messages')
            <form class="chat-message-box" id="messageForm">
                @csrf
                <input type="text" name="chatMessage" id="chatMessage" placeholder="Write message" autocomplete="off">
                <div class="chat-message-box-action">
                    <button type="button" class="text-xl" title="Attach File">
                        <iconify-icon icon="ph:link"></iconify-icon>
                    </button>
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

            // -----------------------------
            // 1️⃣ Load Professionals (Sidebar)
            // -----------------------------
            function loadProfessionals() {
                fetch("{{ route('recruiter.chat.get-professional') }}")
                    .then(res => res.json())
                    .then(data => {
                        professionalList.innerHTML = '';
                        data.forEach(user => {

                            const div = document.createElement('div');
                            div.classList.add('chat-sidebar-single');
                            div.dataset.userId = user.id;

                            div.innerHTML = `
                        <div class="img">
                            <img src="${user.model?.avatar ? '/storage/' + user.model.avatar : '{{ asset('assets/images/user.png') }}'}"
                                class="rounded-full"
                                style="width:40px;height:40px;object-fit:cover;border-radius:100%">
                        </div>

                        <div class="info">
                            <h6 class="text-sm mb-1">${user.first_name} ${user.last_name}</h6>
                            <p class="mb-0 text-xs">Available</p>
                        </div>
                    `;

                            // Click event → Load chat, conversation
                            div.addEventListener('click', function() {
                                let receiverId = this.dataset.userId;
                                activeReceiverId = receiverId;

                                setActiveUser(this);
                                getConversation(receiverId);
                            });

                            professionalList.appendChild(div);
                        });
                    });
            }

            function setActiveUser(selected) {
                document.querySelectorAll('.chat-sidebar-single').forEach(el => el.classList.remove('active'));
                selected.classList.add('active');
            }

            // -----------------------------
            // 2️⃣ Get or Create Conversation
            // -----------------------------
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
                        loadMessages(activeConversationId);
                    });
            }

            // -----------------------------
            // 3️⃣ Load Messages
            // -----------------------------
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
                        <div class="chat-message-content">
                            <p class="mb-3">${msg.message}</p>
                            <p class="chat-time mb-0"><span>${msg.time}</span></p>
                        </div>
                    </div>
                `;
                            chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                        });

                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    });
            }

            // -----------------------------
            // 4️⃣ Update URL Without Reload
            // -----------------------------
            function updateURL(receiverId) {
                window.history.pushState({}, '', `/professional/chat/messages/${receiverId}`);
            }

            // -----------------------------
            // 5️⃣ Send Message (AJAX)
            // -----------------------------
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let message = chatInput.value.trim();
                if (message === '' || !activeConversationId) return;

                fetch("{{ route('recruiter.chat.send') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            message: message,
                            conversation_id: activeConversationId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {

                        const messageHTML = `
                <div class="chat-single-message right">
                    <div class="chat-message-content">
                        <p class="mb-3">${message}</p>
                        <p class="chat-time mb-0"><span>now</span></p>
                    </div>
                </div>
            `;
                        chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                        chatContainer.scrollTop = chatContainer.scrollHeight;

                        chatInput.value = '';
                    });
            });

            loadProfessionals();
        });
    </script>
@endpush
