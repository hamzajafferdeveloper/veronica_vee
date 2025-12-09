@extends('layouts.professional')

@section('title', 'Professional Chat Page')

@section('content')
    <div class="chat-wrapper">
        @include('professional.chat.partials.sidebar')

        <div class="chat-main card">

            {{-- Selected Recruiter / User --}}
            <div id="selectedUserInfo" class="chat-sidebar-single active d-none">
                <div class="img">
                    <img id="selectedUserAvatar" src="{{ asset('assets/images/user.png') }}" alt="image"
                        style="border-radius: 100%">
                </div>
                <div class="info">
                    <h6 id="selectedUserName" class="text-md mb-0"></h6>
                    <p class="mb-0">Available</p>
                </div>
            </div>

            {{-- Chat Messages --}}
            <div id="chatMessagesBox">
                @include('professional.chat.partials.chat-messages')
            </div>

            {{-- Chat Send Box --}}
            <form class="chat-message-box" id="messageForm">
                @csrf
                <input type="hidden" id="conversation_id" name="conversation_id">
                <input type="text" name="chatMessage" id="chatMessage" placeholder="Write message" autocomplete="off">

                <div class="chat-message-box-action">
                    <button type="submit"
                        class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                        Send <iconify-icon icon="f7:paperplane"></iconify-icon>
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const recruiterList = document.getElementById('recruiterList');
            const searchInput = document.getElementById('recruiterSearch');
            const chatMessagesBox = document.getElementById('chatMessagesBox');
            const messageForm = document.getElementById('messageForm');
            const conversationInput = document.getElementById('conversation_id');
            const chatMessageInput = document.getElementById('chatMessage');

            const selectedUserInfo = document.getElementById('selectedUserInfo');
            const selectedUserName = document.getElementById('selectedUserName');
            const selectedUserAvatar = document.getElementById('selectedUserAvatar');

            let activeUserId = null;
            let polling = null;

            const fallbackImage = "{{ asset('assets/images/user.png') }}";


            /* ============================================================
                1. LOAD RECRUITERS
            ============================================================ */
            function loadRecruiters() {
                fetch("{{ route('professional.chat.get-recuiters') }}")
                    .then(res => res.json())
                    .then(users => {

                        recruiterList.innerHTML = '';

                        users.forEach(user => {
                            let avatar = user.avatar ? `/storage/${user.avatar}` : fallbackImage;

                            const div = document.createElement('div');
                            div.classList.add('chat-sidebar-single');
                            div.setAttribute('data-id', user.id);
                            div.setAttribute('data-name', user.first_name + ' ' + user.last_name);
                            div.setAttribute('data-avatar', avatar);

                            div.innerHTML = `
                        <div class="img">
                            <img src="${avatar}" alt="image" style="border-radius:100%; width:45px; height:45px; object-fit:cover;">
                        </div>
                        <div class="info">
                            <h6 class="text-sm mb-1">${user.first_name ?? ''} ${user.last_name ?? ''}</h6>
                            <p class="mb-0 text-xs">Available</p>
                        </div>
                    `;

                            recruiterList.appendChild(div);
                        });

                        activateClickListener();
                    })
                    .catch(error => console.error("Recruiter Load Error: ", error));
            }

            loadRecruiters();


            /* ============================================================
                2. RECRUITER CLICK → OPEN CONVERSATION
            ============================================================ */
            function activateClickListener() {
                recruiterList.querySelectorAll('.chat-sidebar-single').forEach(item => {

                    item.addEventListener('click', async function() {

                        activeUserId = this.dataset.id;

                        selectedUserName.innerText = this.dataset.name;
                        selectedUserAvatar.src = this.dataset.avatar;

                        selectedUserInfo.classList.remove('d-none');

                        // Step 1: Get or create conversation
                        const response = await fetch(
                            `/professional/chat/get-or-create/${activeUserId}`);
                        const data = await response.json();

                        conversationInput.value = data.conversation_id;

                        // Step 2: Load Messages
                        loadMessages();

                        // Step 3: Start polling
                        if (polling) clearInterval(polling);
                        polling = setInterval(loadMessages, 2000);
                    });
                });
            }


            /* ============================================================
                3. LOAD MESSAGES
            ============================================================ */
            function loadMessages() {

                if (!conversationInput.value) return;

                fetch(`/professional/chat/messages/${conversationInput.value}`)
                    .then(res => res.json())
                    .then(messages => {

                        let html = '';

                        messages.forEach(msg => {
                            const myMessage = msg.sender_id == {{ auth()->id() }} ? 'my-message' :
                                'other-message';

                            html += `
                        <div class="single-message ${myMessage}">
                            <p>${msg.message}</p>
                            <span class="msg-time">${msg.time}</span>
                        </div>
                    `;
                        });

                        chatMessagesBox.innerHTML = html;

                        chatMessagesBox.scrollTop = chatMessagesBox.scrollHeight;
                    });
            }


            /* ============================================================
                4. SEND MESSAGE
            ============================================================ */
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let message = chatMessageInput.value.trim();
                if (!message) return;

                let formData = new FormData(this);

                fetch("{{ route('professional.chat.send') }}", {
                        method: "POST",
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        chatMessageInput.value = '';

                        loadMessages();
                    });
            });


            /* ============================================================
                5. SEARCH FILTER
            ============================================================ */
            searchInput.addEventListener('input', function() {
                const search = this.value.toLowerCase();

                recruiterList.querySelectorAll('.chat-sidebar-single').forEach(item => {
                    const name = item.dataset.name.toLowerCase();
                    item.style.display = name.includes(search) ? '' : 'none';
                });
            });

        });
    </script>
@endpush
