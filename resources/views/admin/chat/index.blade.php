@extends('layouts.admin')

@section('title', __('ui.admin_chat'))

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
                    <button type="button" id="offerBtn" class="btn d-flex align-items-center justify-content-center"
                        style="width:38px;height:38px; color: #198754;" title="Send Offer">
                        <iconify-icon icon="mdi:offer" style="font-size:26px;"></iconify-icon>
                    </button>
                    <input type="file" name="attachment" id="chatAttachment" style="display:none;">

                    <!-- Message box -->
                    <textarea name="chatMessage" id="chatMessage" rows="1" placeholder="{{ __('messages.type_message') }}" autocomplete="off"
                        class="grow pt-1 px-3"
                        style="
                            border-radius:4px !important;
                            border:1px solid #d8dadd;
                            background:#f0f2f5;
                            outline:none;
                            font-size:14px;
                            overflow-y:auto;
                            width: 100%;
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

    <!-- Offer Modal -->
    <div class="modal fade" id="offerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="offerForm">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" id="offerTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="offerDescription" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount ($)</label>
                            <input type="number" id="offerAmount" class="form-control" step="0.01" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="sendOfferSubmit" class="btn btn-primary">Send Offer</button>
                </div>
            </div>
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

            let allUsers = [];

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
                    <button type="button" id="removeAttachment" style="padding:2px 5px; font-size:12px;">{{ __('buttons.remove') }}</button>
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

                const filtered = allUsers.filter(user => {
                    const fullName = `${user.first_name} ${user.last_name}`.toLowerCase();
                    return fullName.includes(keyword);
                });

                renderUsers(filtered);
            });

            // Load users in sidebar
            function loadUsers() {
                fetch("{{ route('admin.chat.get-users') }}")
                    .then(res => res.json())
                    .then(data => {
                        allUsers = data; // store for search
                        renderUsers(data);
                    });
            }

            function renderUsers(data) {
                professionalList.innerHTML = '';

                data.forEach(user => {
                    const div = document.createElement('div');
                    div.classList.add('chat-sidebar-single');
                    div.dataset.userId = user.id;
                    div.dataset.name = `${user.first_name} ${user.last_name}`.toLowerCase();
                    div.dataset.email = user.email || '';
                    
                    let avatar = '{{ asset('assets/images/user.png') }}';
                    if (user.recruiter?.avatar) {
                        avatar = '/storage/' + user.recruiter.avatar;
                    } else if (user.model?.avatar) {
                        avatar = '/storage/' + user.model.avatar;
                    }
                    div.dataset.avatar = avatar;

                    const roleLabel = user.roles ? user.roles.map(role => role.name).join(', ') : '';

                    div.innerHTML = `
                        <div class="img">
                            <img src="${avatar}" style="width:40px;height:40px;object-fit:cover;border-radius:100%">
                        </div>
                        <div class="info">
                            <h6 class="text-sm mb-1">${user.first_name} ${user.last_name}</h6>
                            <p class="text-xs mb-0 text-muted">${roleLabel}</p>
                        </div>
                    `;

                    div.addEventListener('click', function() {
                        activeReceiverId = this.dataset.userId;
                        setActiveUser(this);
                        updateHeader(`${user.first_name} ${user.last_name}`, user.email || '', this.dataset.avatar);
                        messageForm.classList.remove('d-none');
                        getConversation(activeReceiverId);
                    });

                    professionalList.appendChild(div);
                });

                // Auto-select user from URL
                setTimeout(() => {
                    const urlParts = window.location.pathname.split('/');
                    const receiverIdFromURL = parseInt(urlParts[urlParts.length - 1]);
                    if (receiverIdFromURL && !isNaN(receiverIdFromURL)) {
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
                headerBox.classList.remove('d-none');
            }

            function getConversation(receiverId) {
                fetch(`/admin/chat/get-or-create/${receiverId}`, {
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
                if (!window.Echo) {
                    console.error('Echo is not initialized.');
                    return;
                }

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
                if (!message) return;

                let attachmentHTML = '';

                // Handle Offer Card
                if (message.type === 'offer' && message.offer) {
                    const offer = message.offer;
                    attachmentHTML += `
                        <div class="offer-card p-3 mt-2 rounded-4 shadow-sm border-0 position-relative overflow-hidden" 
                             style="background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%); min-width:240px; color: #333; border-left: 4px solid #0d6efd !important;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <iconify-icon icon="solar:bill-list-bold-duotone" class="text-primary" style="font-size:20px;"></iconify-icon>
                                <span class="text-uppercase tracking-wider" style="font-size: 10px; font-weight:800; color:#0d6efd;">Formal Offer</span>
                            </div>
                            <h6 class="mb-1 fw-bold" style="font-size: 15px; color:#1a1a1a;">${offer.title}</h6>
                            <h5 class="mb-2 text-primary fw-bold" style="font-size: 18px;">$${parseFloat(offer.amount).toLocaleString(undefined, {minimumFractionDigits: 2})}</h5>
                            <div class="mt-2">
                                <span class="badge rounded-pill" 
                                      style="font-size: 10px; padding: 4px 10px; background-color: ${offer.status === 'pending' ? '#fff3cd' : (offer.status === 'accepted' ? '#d1e7dd' : '#f8d7da')}; color: ${offer.status === 'pending' ? '#856404' : (offer.status === 'accepted' ? '#0f5132' : '#842029')}">
                                    ${offer.status.toUpperCase()}
                                </span>
                            </div>
                        </div>
                    `;
                }

                if (message.attachment) {
                    const fileUrl = `/storage/${message.attachment}`;
                    const fileName = message.attachment_name ?? '{{ __('ui.attachment') }}';
                    const fileType = message.attachment_type || '';

                    if (fileType.startsWith('image')) {
                        attachmentHTML += `
                        <div class="mt-1">
                            <img src="${fileUrl}" alt="${fileName}" onclick="window.open('${fileUrl}', '_blank')" style="max-width:220px; border-radius:8px; display:block;">
                        </div>
                    `;
                    } else if (fileType.startsWith('audio')) {
                        attachmentHTML += `
                        <div class="mt-1">
                            <audio controls style="width:100%;">
                                <source src="${fileUrl}" type="${fileType}">
                                {{ __('messages.browser_audio_support') }}
                            </audio>
                        </div>
                    `;
                    } else if (fileType.startsWith('video')) {
                        attachmentHTML += `
                        <div class="mt-1">
                            <video controls style="max-width:220px; border-radius:8px;">
                                <source src="${fileUrl}" type="${fileType}">
                                {{ __('messages.browser_video_support') }}
                            </video>
                        </div>
                    `;
                    } else {
                        attachmentHTML += `
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
                        ${message.message && message.type !== 'offer' ? `<p class="mb-1 px-3" style="margin:0; color:#2c2c2c;">${message.message}</p>` : ''}
                        <div class="px-3">${attachmentHTML}</div>
                        <span class="chat-time px-3 d-block text-end mt-1" style="font-size:0.65rem; color: rgba(0,0,0,0.45);">
                            ${message.created_at ? new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }).toUpperCase() : 'NOW'}
                        </span>
                    </div>
                </div>
            `;

                chatContainer.insertAdjacentHTML('beforeend', messageHTML);
                chatContainer.scrollTop = chatContainer.scrollHeight;

                if (!is_mine) {
                    const senderElement = Array.from(professionalList.children)
                        .find(el => el.dataset.userId == message.sender_id);

                    if (senderElement) {
                        professionalList.insertBefore(senderElement, professionalList.firstChild);
                    }
                }
            }

            function loadMessages(conversationId) {
                fetch(`/admin/chat/messages/${conversationId}`, {
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
                window.history.pushState({}, '', `/admin/chat/messages/${receiverId}`);
            }

            const offerBtn = document.getElementById('offerBtn');
            const offerModal = new bootstrap.Modal(document.getElementById('offerModal'));
            const sendOfferSubmit = document.getElementById('sendOfferSubmit');

            offerBtn.addEventListener('click', () => {
                if (!activeReceiverId) {
                    alert('Please select a user first');
                    return;
                }
                // Check if user is recruiter (admin can only send to recruiter)
                const selectedUser = allUsers.find(u => u.id == activeReceiverId);
                const isRecruiter = selectedUser.roles && selectedUser.roles.some(role => role.name === 'recruiter');
                
                if (!isRecruiter) {
                    alert('Offers can only be sent to Recruiters');
                    return;
                }
                offerModal.show();
            });

            sendOfferSubmit.addEventListener('click', () => {
                const title = document.getElementById('offerTitle').value;
                const description = document.getElementById('offerDescription').value;
                const amount = document.getElementById('offerAmount').value;

                if (!title || !amount) {
                    alert('Title and Amount are required');
                    return;
                }

                if (!activeConversationId) {
                    alert('Please select a user and wait for conversation to load');
                    return;
                }

                sendOfferSubmit.disabled = true;

                fetch("{{ route('admin.chat.offer.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        conversation_id: activeConversationId,
                        receiver_id: activeReceiverId,
                        title: title,
                        description: description,
                        amount: amount
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Close modal reliably
                        const mEle = document.getElementById('offerModal');
                        let m = bootstrap.Modal.getInstance(mEle);
                        if (!m) m = new bootstrap.Modal(mEle);
                        m.hide();
                        
                        document.getElementById('offerForm').reset();
                        // addMessageToUI(true, data.data);
                    } else {
                        alert(data.message || 'Error sending offer');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('An error occurred while sending the offer');
                })
                .finally(() => {
                    sendOfferSubmit.disabled = false;
                });
            });

            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const message = chatInput.value.trim();
                const file = chatAttachment.files[0];

                if (!message && !file) return;
                if (!activeConversationId) return;

                const formData = new FormData();
                formData.append('conversation_id', activeConversationId);
                formData.append('message', message);
                if (file) formData.append('attachment', file);
                formData.append('_token', '{{ csrf_token() }}');

                const originalContent = sendButton.innerHTML;
                sendButton.disabled = true;
                sendButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;

                fetch("{{ route('admin.chat.send') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        chatInput.value = '';
                        chatAttachment.value = '';
                        selectedImagePreview.textContent = '';
                    })
                    .catch(err => {
                        console.error(err);
                        alert('An error occurred while sending the message');
                    })
                    .finally(() => {
                        sendButton.disabled = false;
                        sendButton.innerHTML = originalContent;
                    });
            });

            loadUsers();
        });
    </script>
@endpush
