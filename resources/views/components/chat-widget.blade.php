<!-- Chat Widget -->
<div class="chat-widget">
    <div class="chat-button" onclick="toggleChat()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </div>

    <div class="chat-window">
        <div class="chat-header">
            <h3 class="text-lg font-semibold">Live Chat Support</h3>
            <button onclick="toggleChat()" class="text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div id="chat-form-container">
            <form id="chat-form" class="p-4">
                <div class="mb-4">
                    <input type="text" id="name" name="name" placeholder="Your Name" required class="w-full mb-2">
                    <input type="email" id="email" name="email" placeholder="Your Email" required class="w-full">
                </div>
                <button type="submit" class="w-full py-2 px-4 rounded">Start Chat</button>
            </form>
        </div>

        <div id="chat-messages" class="chat-messages" style="display: none;">
            <!-- Messages will be inserted here -->
        </div>

        <div id="chat-input" class="chat-input" style="display: none;">
            <div class="flex gap-2">
                <input type="text" id="message-input" placeholder="Type your message..." class="flex-grow">
                <button onclick="sendMessage()" class="px-4 py-2 rounded">Send</button>
            </div>
        </div>
    </div>
</div>

<style>
.chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.chat-button {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: var(--primary-accent);
    color: var(--text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.chat-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.4);
    background-color: #0A1F3D;
}

.chat-window {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    height: 500px;
    background: var(--secondary-bg);
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    display: none;
    flex-direction: column;
    border: 1px solid var(--border-color);
}

.chat-header {
    background: var(--primary-accent);
    color: var(--text-primary);
    padding: 1rem;
    border-radius: 12px 12px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'Poppins', sans-serif;
}

.chat-messages {
    flex-grow: 1;
    padding: 1rem;
    overflow-y: auto;
    background-color: var(--primary-bg);
}

.chat-input {
    padding: 1rem;
    border-top: 1px solid var(--border-color);
    background-color: var(--secondary-bg);
}

.message {
    margin-bottom: 1rem;
    max-width: 80%;
    font-family: 'Roboto', sans-serif;
}

.message.user {
    margin-left: auto;
    background: var(--primary-accent);
    color: var(--text-primary);
    padding: 0.75rem;
    border-radius: 12px 12px 0 12px;
}

.message.admin {
    background: var(--secondary-bg);
    color: var(--text-primary);
    padding: 0.75rem;
    border-radius: 12px 12px 12px 0;
    border: 1px solid var(--border-color);
}

#chat-form input {
    background-color: var(--secondary-bg);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    padding: 0.625rem;
    border-radius: 5px;
    margin-bottom: 0.5rem;
}

#chat-form input::placeholder {
    color: #AAAAAA;
}

#chat-form button,
.chat-input button {
    background-color: var(--primary-accent);
    color: var(--text-primary);
    text-transform: uppercase;
    font-weight: 700;
    transition: background-color 0.3s ease;
}

#chat-form button:hover,
.chat-input button:hover {
    background-color: #0A1F3D;
}

#message-input {
    background-color: var(--primary-bg);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    padding: 0.625rem;
    border-radius: 5px;
}

#message-input::placeholder {
    color: #AAAAAA;
}

/* Responsive Design */
@media (max-width: 640px) {
    .chat-window {
        width: 100%;
        height: 100%;
        bottom: 0;
        right: 0;
        border-radius: 0;
    }

    .chat-header {
        border-radius: 0;
    }

    .chat-button {
        width: 50px;
        height: 50px;
    }
}
</style>

<script>
let chatSession = null;
let isPolling = false;

function toggleChat() {
    const chatWindow = document.querySelector('.chat-window');
    chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
}

document.getElementById('chat-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    await startChat();
});

async function startChat() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    if (!name || !email) {
        alert('Please fill in all fields');
        return;
    }

    try {
        const response = await fetch('/chat/initiate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name, email })
        });

        if (!response.ok) throw new Error('Failed to start chat');

        const data = await response.json();
        chatSession = data.session_id;

        document.getElementById('chat-form-container').style.display = 'none';
        document.getElementById('chat-messages').style.display = 'block';
        document.getElementById('chat-input').style.display = 'block';

        startPolling();
        
        // Add system message
        addMessage({
            message: `Welcome ${name}! How can we help you today?`,
            is_admin: true,
            created_at: new Date().toISOString()
        });
    } catch (error) {
        console.error('Error starting chat:', error);
        alert('Failed to start chat. Please try again.');
    }
}

async function sendMessage() {
    const input = document.getElementById('message-input');
    const message = input.value.trim();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    if (!message || !chatSession) return;

    try {
        const response = await fetch('/chat/user/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                session_id: chatSession,
                message: message,
                user_name: name,
                user_email: email
            })
        });

        if (!response.ok) throw new Error('Failed to send message');

        input.value = '';
        
        // Add message to chat immediately
        addMessage({
            message: message,
            is_admin: false,
            created_at: new Date().toISOString()
        });
    } catch (error) {
        console.error('Error sending message:', error);
        alert('Failed to send message. Please try again.');
    }
}

function addMessage(message) {
    const messagesContainer = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${message.is_admin ? 'admin' : 'user'}`;
    
    const time = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messageDiv.innerHTML = `
        <div class="message-content">${message.message}</div>
        <div class="message-time text-xs opacity-75">${time}</div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

async function pollMessages() {
    if (!chatSession || !isPolling) return;

    try {
        const response = await fetch(`/chat/messages?session_id=${chatSession}`);
        if (!response.ok) throw new Error('Failed to fetch messages');

        const messages = await response.json();
        
        // Clear existing messages
        document.getElementById('chat-messages').innerHTML = '';
        
        // Add all messages
        messages.forEach(addMessage);
    } catch (error) {
        console.error('Error polling messages:', error);
        stopPolling();
    }
}

function startPolling() {
    if (!isPolling) {
        isPolling = true;
        pollMessages();
        setInterval(pollMessages, 3000);
    }
}

function stopPolling() {
    isPolling = false;
}

// Handle Enter key in message input
document.getElementById('message-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});
</script> 
