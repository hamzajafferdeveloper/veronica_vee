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

            <!-- Chat Messages -->
            @include('recruiter.chat.partials.chat-messages')

            <!-- Chat Send Box -->
            <form class="chat-message-box d-none p-1" id="messageForm"
                style="
                        border-top:1px solid #e0e0e0;
                    "
                enctype="multipart/form-data">

                @csrf

                <div class="d-flex align-items-center gap-2 p-1 w-100"><!-- Attach -->
                    <button type="button" id="attachBtn" class="btn  d-flex align-items-center justify-content-center"
                        style="width:38px;height:38px;">
                        <iconify-icon icon="openmoji:paperclip" style="font-size:26px;"></iconify-icon>
                    </button>
                    <input type="file" name="attachment" id="chatAttachment" style="display:none;">

                    <!-- Message box -->
                    <textarea name="chatMessage" id="chatMessage" rows="1" placeholder="Type a message" autocomplete="off"
                        class="flex-grow-1 pt-1 px-3"
                        style="
                            border-radius:4px !important;
                            border:1px solid #d8dadd;
                            background:#f0f2f5;
                            outline:none;
                            font-size:14px;
                            overflow-y:auto;
                        "></textarea>

                    <!-- Send -->
                    <button type="submit" class="btn d-flex align-items-center justify-content-center"
                        style="
                            width:35px;
                            height:35px;
                            background:#0d6efd;
                            color:#fff;
                        ">
                        <iconify-icon icon="f7:paperplane" style="font-size:18px;"></iconify-icon>
                    </button>
                </div>

                <text id="selectedImagePreview" class="px-3"></text>

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
            const messageForm = document.getElementById('messageForm');
            const chatInput = document.getElementById('chatMessage');
            const AUTH_ID = {{ auth()->id() }};

            const headerBox = document.getElementById('chatHeader');
            const headerName = document.getElementById('headerName');
            const headerEmail = document.getElementById('headerEmail');
            const headerAvatar = document.getElementById('headerAvatar');

            const attachBtn = document.getElementById('attachBtn');
            const chatAttachment = document.getElementById('chatAttachment');
            const selectedImagePreview = document.getElementById('selectedImagePreview');

            const sendButton = messageForm.querySelector('button[type="submit"]');

            attachBtn.addEventListener('click', () => {
                chatAttachment.click();
            });

            chatAttachment.addEventListener('change', () => {
                if (chatAttachment.files.length > 0) {
                    let fileName = chatAttachment.files[0].name;

                    // Truncate filename if longer than 20 characters
                    const maxLength = 20;
                    if (fileName.length > maxLength) {
                        const ext = fileName.split('.').pop();
                        const nameWithoutExt = fileName.substring(0, fileName.length - ext.length - 1);
                        fileName = nameWithoutExt.substring(0, maxLength - ext.length - 3) + '….' + ext;
                    }

                    selectedImagePreview.innerHTML = `
                    <span style="display:inline-block; margin-right:8px;" title="${chatAttachment.files[0].name}">${fileName}</span>
                    <button type="button" id="removeAttachment" style="padding:2px 5px; font-size:12px;">Remove</button>
                `;

                    const removeBtn = document.getElementById('removeAttachment');
                    removeBtn.addEventListener('click', () => {
                        chatAttachment.value = '';
                        selectedImagePreview.textContent = '';
                    });
                } else {
                    selectedImagePreview.textContent = '';
                }
            });

            document.getElementById('professionalSearch').addEventListener('input', function() {
                const keyword = this.value.toLowerCase().trim();

                const filtered = allProfessionals.filter(user => {
                    const fullName = `${user.first_name} ${user.last_name}`.toLowerCase();
                    return fullName.includes(keyword);
                });

                renderProfessionals(filtered);
            });

            // Load professionals in sidebar
            function loadProfessionals() {
                fetch("{{ route('professional.chat.get-recuiters') }}")
                    .then(res => res.json())
                    .then(data => {
                        allProfessionals = data; // store for search
                        renderProfessionals(data);
                    });
            }

            function renderProfessionals(data) {
                professionalList.innerHTML = '';

                data.forEach(user => {
                    console.log(user);
                    const div = document.createElement('div');
                    div.classList.add('chat-sidebar-single');
                    div.dataset.userId = user.id;
                    div.dataset.name = `${user.first_name} ${user.last_name}`.toLowerCase();
                    div.dataset.email = user.email || '';
                    div.dataset.avatar = user.recruiter?.avatar ?
                        '/storage/' + user.recruiter.avatar :
                        '{{ asset('assets/images/user.png') }}';

                    div.innerHTML = `
                        <div class="img">
                            <img src="${div.dataset.avatar}" style="width:40px;height:40px;object-fit:cover;border-radius:100%">
                        </div>
                        <div class="info">
                            <h6 class="text-sm mb-1">${user.first_name} ${user.last_name}</h6>
                        </div>
                    `;

                    div.addEventListener('click', function() {
                        activeReceiverId = this.dataset.userId;
                        setActiveUser(this);
                        updateHeader(`${user.first_name} ${user.last_name}`, user.email || '', this
                            .dataset.avatar);
                        messageForm.classList.remove('d-none');
                        getConversation(activeReceiverId);
                    });

                    professionalList.appendChild(div);
                });

                // Auto-select user from URL
                setTimeout(() => {
                    const urlParts = window.location.pathname.split('/');
                    const receiverIdFromURL = parseInt(urlParts[urlParts.length - 1]);
                    if (receiverIdFromURL) {
                        const userElement = [...professionalList.children]
                            .find(el => parseInt(el.dataset.userId) === receiverIdFromURL);
                        if (userElement) userElement.click();
                    }
                }, 300);
            }

            function setActiveUser(selected) {
                document.querySelectorAll('.chat-sidebar-single').forEach(el => el.classList.remove('active'));
                selected.classList.add('active');
            }

            function updateHeader(name, email, avatar) {
                headerName.textContent = name;
                headerAvatar.src = avatar;
                // headerEmail.textContent = email;
                headerBox.classList.remove('d-none');
            }

            function getConversation(receiverId) {
                fetch(`/professional/chat/get-or-create/${receiverId}`, {
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
                // Check if Echo is initialized
                if (!window.Echo) {
                    console.error(
                        'Echo is not initialized. Make sure echo.js is properly imported before calling this function.'
                    );
                    return;
                }

                // Store the channel reference to be able to unsubscribe later
                if (window.conversationChannel) {
                    window.conversationChannel.stopListening('.message.sent');
                }

                window.conversationChannel = window.Echo.private(`conversation.${conversationId}`)
                    .listen('.message.sent', (e) => {
                        const is_mine = e.sender_id == AUTH_ID;
                        addMessageToUI(is_mine, e);
                    });
            }

            function addMessageToUI(is_mine, message) {
                let attachmentHTML = '';

                if (message.attachment) {
                    const fileUrl = `/storage/${message.attachment}`;
                    const fileName = message.attachment_name ?? 'Attachment';
                    const fileType = message.attachment_type || '';

                    if (fileType.startsWith('image')) {
                        // Image preview
                        attachmentHTML = `
                        <div class="mt-1">
                            <img src="${fileUrl}" alt="${fileName}" onclick="window.open('${fileUrl}', '_blank')" style="max-width:220px; border-radius:8px; display:block;">
                        </div>
                    `;
                    } else if (fileType.startsWith('audio')) {
                        // Audio player
                        attachmentHTML = `
                        <div class="mt-1">
                            <audio controls style="width:100%;">
                                <source src="${fileUrl}" type="${fileType}">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    `;
                    } else if (fileType.startsWith('video')) {
                        // Video player
                        attachmentHTML = `
                        <div class="mt-1">
                            <video controls style="max-width:220px; border-radius:8px;">
                                <source src="${fileUrl}" type="${fileType}">
                                Your browser does not support the video element.
                            </video>
                        </div>
                    `;
                    } else {
                        // Other files
                        attachmentHTML = `
                        <div class="d-flex align-items-center mt-1 p-2 rounded" style="border:1px solid #e0e0e0;">
                            <span style="font-size:20px;margin-right:8px;">
                                <iconify-icon icon="openmoji:paperclip" style="font-size:26px;"></iconify-icon>
                            </span>
                            <div style="flex:1;">
                                <a href="${fileUrl}" target="_blank" style="font-size:0.8rem; color:#333; text-decoration:none;">${fileName}</a>
                            </div>
                        </div>
                    `;
                    }
                }

                const messageHTML = `
                <div class="chat-single-message d-flex mb-2 ${is_mine ? 'justify-content-end' : 'justify-content-start'} align-items-end">
                    <div class="chat-message-content p-2 px-3 rounded-3 position-relative" style="max-width:70%; background-color:${is_mine ? '#DCF8C6' : '#F0F0F0'}; color:#2c2c2c; word-break:break-word; box-shadow:0 1px 1px rgba(0,0,0,0.1);">
                        ${message.message ? `<p class="mb-1 px-3" style="margin:0; color:#2c2c2c;">${message.message}</p>` : ''}
                        <div class="px-3">${attachmentHTML}</div>
                        <span class="chat-time px-3 d-block text-end mt-1" style="font-size:0.65rem; color: rgba(0,0,0,0.45);">
                            ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }).toUpperCase()}
                        </span>
                    </div>
                </div>
            `;

                chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                chatContainer.scrollTop = chatContainer.scrollHeight;

                // 🔹 Move sender to top if the message is NOT mine
                if (!is_mine) {
                    const senderElement = Array.from(professionalList.children)
                        .find(el => el.dataset.userId == message.sender_id);

                    if (senderElement) {
                        professionalList.insertBefore(senderElement, professionalList.firstChild);
                    }
                }
            }

            function loadMessages(conversationId) {
                fetch(`/professional/chat/messages/${conversationId}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(res => res.json())
                    .then(messages => {
                        chatContainer.innerHTML = '';
                        messages.forEach(msg => {
                            const is_mine = msg.sender_id == AUTH_ID;
                            addMessageToUI(is_mine, msg);
                        });
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    });
            }

            function updateURL(receiverId) {
                window.history.pushState({}, '', `/professional/chat/messages/${receiverId}`);
            }

            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const message = chatInput.value.trim();
                const file = chatAttachment.files[0];

                console.log(file);

                if (!message && !file) return;
                if (!activeConversationId) return;

                const formData = new FormData();
                formData.append('conversation_id', activeConversationId);
                formData.append('message', message);
                if (file) formData.append('attachment', file);
                formData.append('_token', document.querySelector('input[name="_token"]').value);

                // Show loading
                const originalContent = sendButton.innerHTML;
                sendButton.disabled = true;
                sendButton.innerHTML =
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

                fetch("{{ route('professional.chat.send') }}", {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        chatInput.value = '';
                        chatAttachment.value = '';
                        selectedImagePreview.textContent = '';
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    })
                    .catch(err => console.error(err))
                    .finally(() => {
                        sendButton.disabled = false;
                        sendButton.innerHTML = originalContent;
                    });
            });

            loadProfessionals();
        });
    </script>
@endpush
