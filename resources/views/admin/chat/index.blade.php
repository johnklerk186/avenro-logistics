@extends('admin.layouts.app')

@section('title', 'Live Chat Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-6 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
        <h1 class="text-3xl font-bold heading-font" style="color: #2D3748;">
            <i class="fas fa-comments mr-2" style="color: #0F2B4D;"></i>Live Chat Management
        </h1>
        <p class="text-sm mt-1" style="color: #718096;">Real-time customer support and messaging</p>
    </div>

    <!-- Status Bar -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6" style="border-top: 3px solid #0F2B4D;">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 rounded-lg transition-all duration-150" style="background-color: #F4F6F9;" onmouseover="this.style.backgroundColor='#F1F4F9'" onmouseout="this.style.backgroundColor='#F4F6F9'">
                <div class="text-2xl font-bold heading-font" style="color: #0F2B4D;" id="total-chats">0</div>
                <div class="text-sm font-semibold mt-1" style="color: #4A5568;"><i class="fas fa-comments mr-1"></i>Total Chats</div>
            </div>
            <div class="text-center p-4 rounded-lg transition-all duration-150" style="background-color: #F0FFF4;" onmouseover="this.style.backgroundColor='#E6FFED'" onmouseout="this.style.backgroundColor='#F0FFF4'">
                <div class="text-2xl font-bold heading-font" style="color: #38A169;" id="active-chats">0</div>
                <div class="text-sm font-semibold mt-1" style="color: #4A5568;"><i class="fas fa-circle mr-1" style="color: #38A169;"></i>Active Chats</div>
            </div>
            <div class="text-center p-4 rounded-lg transition-all duration-150" style="background-color: #F4F6F9;" onmouseover="this.style.backgroundColor='#F1F4F9'" onmouseout="this.style.backgroundColor='#F4F6F9'">
                <div class="text-2xl font-bold heading-font" style="color: #0F2B4D;" id="today-chats">0</div>
                <div class="text-sm font-semibold mt-1" style="color: #4A5568;"><i class="fas fa-calendar-day mr-1"></i>Today's Chats</div>
            </div>
            <div class="text-center p-4 rounded-lg transition-all duration-150" style="background-color: #FAF5FF;" onmouseover="this.style.backgroundColor='#F3E8FF'" onmouseout="this.style.backgroundColor='#FAF5FF'">
                <div class="text-2xl font-bold heading-font" style="color: #805AD5;" id="response-time">0m</div>
                <div class="text-sm font-semibold mt-1" style="color: #4A5568;"><i class="fas fa-clock mr-1"></i>Avg Response</div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Chat List Panel -->
        <div class="w-full lg:w-1/3 bg-white rounded-lg shadow-lg" style="border-top: 3px solid #0F2B4D;">
            <div class="p-4 border-b" style="background-color: #F4F6F9;">
                <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between">
                    <h2 class="text-xl font-bold heading-font" style="color: #2D3748;"><i class="fas fa-inbox mr-2" style="color: #0F2B4D;"></i>Chat Sessions</h2>
                    <button id="newChatBtn" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all duration-150 shadow-md" style="background-color: #0F2B4D; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#0A1F3D'" onmouseout="this.style.backgroundColor='#0F2B4D'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Chat
                    </button>
                </div>
                <!-- Search Box -->
                <div class="mt-4">
                    <div class="relative">
                        <input type="text" id="searchChats" 
                            class="w-full pl-10 pr-4 py-3 border-2 rounded-lg transition-all duration-150"
                            style="border-color: #E2E8F0;"
                            placeholder="Search chats..."
                            onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                        <svg class="w-5 h-5 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #0F2B4D;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Chat List -->
            <div class="overflow-y-auto h-[calc(100vh-280px)] lg:h-[calc(100vh-280px)]" id="chatList">
                <!-- Chat sessions will be loaded here -->
            </div>
        </div>

        <!-- Chat Area -->
        <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg flex flex-col" style="border-top: 3px solid #0F2B4D;">
            <!-- Chat Header -->
            <div class="p-4 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0" style="background-color: #F4F6F9;">
                <div class="flex items-center gap-3 w-full sm:w-auto" id="chatHeader">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-md" style="background: linear-gradient(135deg, #0F2B4D 0%, #1B4470 100%);">
                        <span class="text-white font-bold text-lg" id="userInitials">--</span>
                    </div>
                    <div class="flex-1 sm:flex-none">
                        <h3 class="font-bold" style="color: #2D3748;" id="userName">Select a chat</h3>
                        <p class="text-sm" style="color: #718096;" id="userEmail"></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold" id="chatStatus"></span>
                    <button id="endChatBtn" class="hidden inline-flex items-center px-4 py-2 rounded-lg font-semibold transition-all duration-150" style="background-color: #E53E3E; color: #FFFFFF;" onmouseover="this.style.backgroundColor='#C53030'" onmouseout="this.style.backgroundColor='#E53E3E'">
                        <i class="fas fa-times-circle mr-2"></i>End Chat
                    </button>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="flex-1 overflow-y-auto p-4" id="messagesArea" style="background-color: #FAFAFA;">
                <div class="flex items-center justify-center h-full" style="color: #718096;">
                    <div class="text-center">
                        <i class="fas fa-comments text-5xl mb-3" style="color: #C6A15B;"></i>
                        <p class="font-semibold">Select a chat session to start messaging</p>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t" id="messageInput" style="display: none; background-color: #F4F6F9;">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <textarea id="messageText" rows="2"
                            class="w-full px-4 py-3 border-2 rounded-lg resize-none transition-all duration-150"
                            style="border-color: #E2E8F0;"
                            placeholder="Type your message..."
                            onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'"></textarea>
                    </div>
                    <button id="sendMessageBtn" 
                        class="w-full sm:w-auto px-6 py-2 rounded-lg font-semibold flex items-center justify-center gap-2 transition-all duration-150 shadow-md"
                        style="background-color: #0F2B4D; color: #FFFFFF;"
                        onmouseover="this.style.backgroundColor='#0A1F3D'"
                        onmouseout="this.style.backgroundColor='#0F2B4D'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Chat Modal -->
<div id="newChatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-auto shadow-2xl" style="border-top: 4px solid #0F2B4D;">
        <div class="mb-6">
            <h3 class="text-2xl font-bold heading-font" style="color: #2D3748;">
                <i class="fas fa-plus-circle mr-2" style="color: #0F2B4D;"></i>Start New Chat
            </h3>
            <p class="text-sm mt-1" style="color: #718096;">Create a new customer chat session</p>
        </div>
        <form id="newChatForm" class="space-y-5">
            <div>
                <label for="customerName" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                    <i class="fas fa-user mr-1" style="color: #0F2B4D;"></i>Customer Name
                </label>
                <input type="text" id="customerName" name="customerName" required
                    class="w-full px-4 py-3 border-2 rounded-lg transition-all duration-150"
                    style="border-color: #E2E8F0;"
                    onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                    onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
            </div>
            <div>
                <label for="customerEmail" class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                    <i class="fas fa-envelope mr-1" style="color: #0F2B4D;"></i>Customer Email
                </label>
                <input type="email" id="customerEmail" name="customerEmail" required
                    class="w-full px-4 py-3 border-2 rounded-lg transition-all duration-150"
                    style="border-color: #E2E8F0;"
                    onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                    onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
            </div>
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                <button type="button" id="cancelNewChat"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-lg font-semibold transition-all duration-150 order-2 sm:order-1"
                    style="background-color: #E2E8F0; color: #4A5568;"
                    onmouseover="this.style.backgroundColor='#CBD5E0'"
                    onmouseout="this.style.backgroundColor='#E2E8F0'">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 rounded-lg font-semibold transition-all duration-150 shadow-md order-1 sm:order-2"
                    style="background-color: #0F2B4D; color: #FFFFFF;"
                    onmouseover="this.style.backgroundColor='#0A1F3D'"
                    onmouseout="this.style.backgroundColor='#0F2B4D'">
                    <i class="fas fa-comment-dots mr-2"></i>Start Chat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
console.log('jQuery version:', $.fn.jquery);
console.log('Document ready state:', document.readyState);

let currentChat = null;
let chats = [];

// Debug function (now just logs to console)
function updateDebug(type, value) {
    console.log(`${type}: ${value}`);
}

// Basic HTML escape to prevent XSS when inserting untrusted content
function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
// Initialize chat interface
$(document).ready(function() {
    console.log('Chat interface initializing...');
    updateDebug('api_status', 'Initializing...');

    // Initial load
    loadChats();
    startPolling();

    // Event Listeners
    $('#newChatBtn').click(function() {
        console.log('Opening new chat modal');
        showNewChatModal();
    });

    $('#cancelNewChat').click(function() {
        console.log('Canceling new chat');
        hideNewChatModal();
    });

    $('#newChatForm').submit(function(e) {
        e.preventDefault();
        console.log('Submitting new chat form');
        handleNewChat();
    });

    $('#sendMessageBtn').click(function() {
        console.log('Sending message');
        sendMessage();
    });

    $('#messageText').on('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    $('#endChatBtn').click(function() {
        console.log('Ending chat');
        endCurrentChat();
    });

    $('#searchChats').on('input', function() {
        console.log('Filtering chats');
        filterChats();
    });
});

function showNewChatModal() {
    $('#newChatModal').removeClass('hidden').addClass('flex');
}

function hideNewChatModal() {
    $('#newChatModal').removeClass('flex').addClass('hidden');
    $('#newChatForm')[0].reset();
}

function handleNewChat() {
    const name = $('#customerName').val().trim();
    const email = $('#customerEmail').val().trim();

    updateDebug('api_call', 'Initiating new chat');
    
    $.ajax({
        url: '{{ route("chat.initiate") }}',
        method: 'POST',
        data: { name, email },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log('Chat initiated:', response);
            updateDebug('api_status', 'Chat initiated');
            
            const chat = {
                id: response.session_id,
                name: name,
                email: email,
                status: 'active',
                created_at: new Date().toISOString()
            };

            // Send welcome message
            $.ajax({
                url: '{{ route("admin.chat.send") }}',
                method: 'POST',
                data: {
                    session_id: chat.id,
                    message: `Hello ${name}, how can I assist you today?`
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            addChatToList(chat);
            selectChat(chat);
            hideNewChatModal();
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to start new chat';
            updateDebug('error', error);
            alert(error);
        }
    });
}

function loadChats() {
    updateDebug('api_call', 'Loading chat sessions');
    
    $.ajax({
        url: '{{ route("admin.chat.sessions") }}',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log('Chats loaded:', response);
            updateDebug('api_status', 'Connected');
            chats = response;
            updateChatList();
            updateStats();
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to load chats';
            updateDebug('error', error);
            updateDebug('api_status', 'Disconnected');
            $('#chatList').html('<div class="p-4 text-center text-red-600">Failed to load chats. Retrying...</div>');
        }
    });
}

function updateChatList() {
    const $chatList = $('#chatList');
    $chatList.empty();
    
    updateDebug('sessions', chats.length);

    if (chats.length === 0) {
        $chatList.html('<div class="p-4 text-center text-gray-500">No active chats</div>');
        return;
    }

    chats.forEach(chat => {
        addChatToList(chat);
    });
}

function addChatToList(chat) {
    const $chatList = $('#chatList');
    const isActive = currentChat && currentChat.id === chat.id;
    
    const chatHtml = `
        <div class="chat-item p-3 border-b hover:bg-gray-50 cursor-pointer ${isActive ? 'bg-orange-50' : ''}" 
             data-chat-id="${chat.id}">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h4 class="font-medium">${chat.name}</h4>
                    <p class="text-sm text-gray-600">${chat.email}</p>
                </div>
                <div class="flex flex-col items-end ml-4">
                    <span class="text-xs text-gray-500">${formatDate(chat.created_at)}</span>
                    <span class="px-2 py-1 rounded-full text-xs ${getStatusClass(chat.status)}">
                        ${chat.status}
                    </span>
                    <button onclick="deleteChat('${chat.id}')" class="mt-2 btn-danger px-2 py-1 rounded inline-flex items-center gap-1">
                        <i class="fas fa-trash"></i>
                        <span class="hidden lg:inline">Delete</span>
                    </button>
                </div>
            </div>
        </div>
    `;

    if (isActive) {
        $chatList.prepend(chatHtml);
    } else {
        $chatList.append(chatHtml);
    }
}

function selectChat(chat) {
    console.log('Selecting chat:', chat);
    currentChat = chat;
    
    // Update UI
    $('#userInitials').text(getInitials(chat.name));
    $('#userName').text(chat.name);
    $('#userEmail').text(chat.email);
    $('#chatStatus').text(chat.status)
        .removeClass()
        .addClass(`px-3 py-1 rounded-full text-sm ${getStatusClass(chat.status)}`);
    
    $('#messageInput').show();
    $('#endChatBtn').show();
    
    loadMessages(chat.id);
    updateChatList();
}

function loadMessages(chatId) {
    updateDebug('api_call', 'Loading messages for ' + chatId);
    
    $.ajax({
        url: '{{ route("chat.messages") }}',
        method: 'GET',
        data: { session_id: chatId },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(messages) {
            console.log('Messages loaded:', messages);
            displayMessages(messages);
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to load messages';
            updateDebug('error', error);
            $('#messagesArea').html('<div class="text-center text-red-600 mt-4">'+escapeHtml(error)+'</div>');
        }
    });
}

function displayMessages(messages) {
    const $messagesArea = $('#messagesArea');
    $messagesArea.empty();

    if (messages.length === 0) {
        $messagesArea.html('<div class="text-center text-gray-500 mt-4">No messages yet</div>');
        return;
    }

    messages.forEach(msg => {
        const user = escapeHtml(msg.user_name || '');
        const body = escapeHtml(msg.message || '');
        const messageHtml = `
            <div class="mb-4 ${msg.is_admin ? 'text-right' : 'text-left'}">
                <div class="inline-block max-w-[70%] ${
                    msg.is_admin 
                        ? 'bg-orange-600 text-white rounded-lg rounded-tr-none msg-admin' 
                        : 'bg-gray-100 text-gray-800 rounded-lg rounded-tl-none msg-user'
                } px-4 py-2">
                    <p class="text-sm font-semibold mb-1">${user}</p>
                    <p>${body}</p>
                    <p class="text-xs ${msg.is_admin ? 'text-orange-100 msg-time admin' : 'text-gray-500 msg-time'} mt-1">
                        ${formatTime(msg.created_at)}
                    </p>
                </div>
            </div>
        `;
        $messagesArea.append(messageHtml);
    });

    $messagesArea.scrollTop($messagesArea[0].scrollHeight);
}

function sendMessage() {
    if (!currentChat) {
        updateDebug('error', 'No chat selected');
        return;
    }

    const message = $('#messageText').val().trim();
    if (!message) return;

    updateDebug('api_call', 'Sending message');

    $.ajax({
        url: '{{ route("admin.chat.send") }}',
        method: 'POST',
        data: {
            session_id: currentChat.id,
            message: message
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function() {
            console.log('Message sent');
            $('#messageText').val('');
            loadMessages(currentChat.id);
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to send message';
            updateDebug('error', error);
            alert(error);
        }
    });
}

function endCurrentChat() {
    if (!currentChat || !confirm('Are you sure you want to end this chat?')) return;

    updateDebug('api_call', 'Ending chat');

    $.ajax({
        url: '{{ route("admin.chat.end") }}',
        method: 'POST',
        data: { session_id: currentChat.id },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function() {
            console.log('Chat ended');
            currentChat.status = 'ended';
            updateChatList();
            loadChats();
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to end chat';
            updateDebug('error', error);
            alert(error);
        }
    });
}

function filterChats() {
    const query = $('#searchChats').val().toLowerCase();
    $('.chat-item').each(function() {
        const name = $(this).find('h4').text().toLowerCase();
        const email = $(this).find('p').text().toLowerCase();
        $(this).toggle(name.includes(query) || email.includes(query));
    });
}

function updateStats() {
    $('#total-chats').text(chats.length);
    $('#active-chats').text(chats.filter(c => c.status === 'active').length);
    $('#today-chats').text(chats.filter(c => isToday(c.created_at)).length);
    
    // Calculate average response time
    const avgTime = calculateAverageResponseTime(chats);
    $('#response-time').text(avgTime + 'm');
}

// Utility functions
function getInitials(name) {
    return name.split(' ').map(n => n[0]).join('').toUpperCase();
}

function formatDate(date) {
    return new Date(date).toLocaleDateString();
}

function formatTime(date) {
    return new Date(date).toLocaleTimeString();
}

function isToday(date) {
    const today = new Date();
    const chatDate = new Date(date);
    return today.toDateString() === chatDate.toDateString();
}

function getStatusClass(status) {
    switch (status) {
        case 'active':
            return 'bg-green-100 text-green-800';
        case 'ended':
            return 'bg-gray-100 text-gray-800';
        default:
            return 'bg-orange-100 text-orange-800';
    }
}

function calculateAverageResponseTime(chats) {
    // Implementation for calculating average response time
    return '2'; // Placeholder
}

function startPolling() {
    setInterval(loadChats, 5000);
    setInterval(() => {
        if (currentChat) loadMessages(currentChat.id);
    }, 3000);
}

// Event delegation for chat items
$(document).on('click', '.chat-item', function() {
    const chatId = $(this).data('chat-id');
    const chat = chats.find(c => c.id === chatId);
    if (chat) selectChat(chat);
});

// Add the delete function
function deleteChat(sessionId) {
    if (!confirm('Are you sure you want to delete this chat session? This action cannot be undone.')) {
        return;
    }

    updateDebug('api_call', 'Deleting chat session');

    $.ajax({
        url: '{{ route("admin.chat.delete", ["session_id" => "_ID_"]) }}'.replace('_ID_', sessionId),
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function() {
            console.log('Chat deleted');
            if (currentChat && currentChat.id === sessionId) {
                currentChat = null;
                $('#userInitials').text('--');
                $('#userName').text('Select a chat');
                $('#userEmail').text('');
                $('#chatStatus').text('').removeClass();
                $('#messageInput').hide();
                $('#endChatBtn').hide();
                $('#messagesArea').html('<div class="flex items-center justify-center h-full text-gray-500">Select a chat session to start messaging</div>');
            }
            loadChats();
        },
        error: function(xhr) {
            const error = xhr.responseJSON?.error || 'Failed to delete chat';
            updateDebug('error', error);
            alert(error);
        }
    });
}
</script>
<style>
/* Fallback bubble styles to ensure visibility even if Tailwind utilities fail */
.msg-admin {
  background-color: #EA580C; /* orange-600 approx */
  color: #ffffff;            /* ensure readable text */
}
.msg-user {
  background-color: #F3F4F6; /* gray-100 approx */
  color: #111827;            /* gray-900 approx for contrast */
}
.msg-admin p, .msg-user p {
  white-space: pre-wrap;     /* preserve newlines */
  word-break: break-word;    /* prevent overflow */
}
.msg-time.admin { color: #FFEDD5; } /* light orange for timestamp on dark bubble */
.msg-time { opacity: 0.8; }
</style>
@endsection