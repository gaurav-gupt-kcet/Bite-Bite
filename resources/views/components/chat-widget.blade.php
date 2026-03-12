<!-- Chat Widget -->
<style>
/* Chat Widget Styles */
.chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

.chat-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.5);
}

.chat-window {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    max-width: calc(100vw - 40px);
    height: 450px;
    max-height: calc(100vh - 120px);
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index: 9999;
}

.chat-window.show {
    display: flex;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chat-header {
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    color: white;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-header h6 {
    margin: 0;
    font-weight: 600;
}

.chat-close {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s;
}

.chat-close:hover {
    background: rgba(255,255,255,0.2);
}

.chat-messages {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    background: #f8f9fa;
}

.message {
    margin-bottom: 15px;
    max-width: 85%;
}

.message.bot {
    margin-right: auto;
}

.message.user {
    margin-left: auto;
    text-align: right;
}

.message-bubble {
    padding: 10px 14px;
    border-radius: 15px;
    font-size: 14px;
    line-height: 1.4;
}

.message.bot .message-bubble {
    background: #e9ecef;
    color: #333;
    border-bottom-left-radius: 3px;
}

.message.user .message-bubble {
    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
    color: white;
    border-bottom-right-radius: 3px;
}

.message-time {
    font-size: 11px;
    color: #999;
    margin-top: 5px;
}

.quick-replies {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.quick-reply-btn {
    background: white;
    border: 2px solid #ff6b35;
    color: #ff6b35;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.quick-reply-btn:hover {
    background: #ff6b35;
    color: white;
}

.chat-input-area {
    padding: 15px;
    border-top: 1px solid #e0e0e0;
    background: white;
}

.chat-input-area input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    outline: none;
    transition: border-color 0.3s;
}

.chat-input-area input:focus {
    border-color: #ff6b35;
}

.chat-send-btn {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #ff6b35;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
}

.customer-care-btn {
    width: 100%;
    background: #dc3545;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s;
}

.customer-care-btn:hover {
    background: #c82333;
    transform: translateY(-2px);
}

/* Typing indicator */
.typing-indicator {
    display: inline-flex;
    gap: 4px;
    padding: 10px 14px;
    background: #e9ecef;
    border-radius: 15px;
    border-bottom-left-radius: 3px;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    background: #999;
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-5px); }
}

/* Responsive */
@media (max-width: 480px) {
    .chat-widget {
        bottom: 15px;
        right: 15px;
    }
    
    .chat-toggle-btn {
        width: 55px;
        height: 55px;
        font-size: 22px;
    }
    
    .chat-window {
        bottom: 80px;
        right: 10px;
        left: 10px;
        width: auto;
        height: calc(100vh - 100px);
    }
}
</style>

<!-- Chat Toggle Button -->
<div class="chat-widget">
    <button class="chat-toggle-btn" onclick="toggleChat()">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
</div>

<!-- Chat Window -->
<div class="chat-window" id="chatWindow">
    <div class="chat-header">
        <h6><i class="bi bi-headset"></i> Bite Bite Support</h6>
        <button class="chat-close" onclick="toggleChat()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="chat-messages" id="chatMessages">
        <div class="message bot">
            <div class="message-bubble">
                <strong>Namaste! 🙏</strong><br>
                Welcome to Bite Bite! How can I help you today?
            </div>
            <div class="message-time">Just now</div>
        </div>
        <div class="quick-replies">
            <button class="quick-reply-btn" onclick="sendMessage('Order Status')">📦 Order Status</button>
            <button class="quick-reply-btn" onclick="sendMessage('Delivery Time')">🚚 Delivery Time</button>
            <button class="quick-reply-btn" onclick="sendMessage('Products')">🍬 Products</button>
            <button class="quick-reply-btn" onclick="sendMessage('Payment Issue')">💳 Payment Issue</button>
        </div>
    </div>
    <div class="chat-input-area">
        <div style="position: relative;">
            <input type="text" id="chatInput" placeholder="Type your message..." onkeypress="handleKeyPress(event)">
            <button class="chat-send-btn" onclick="sendUserMessage()">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
        <button class="customer-care-btn" onclick="contactCustomerCare()">
            <i class="bi bi-telephone-fill"></i> Contact Customer Care
        </button>
    </div>
</div>

<script>
function toggleChat() {
    const chatWindow = document.getElementById('chatWindow');
    chatWindow.classList.toggle('show');
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        sendUserMessage();
    }
}

function sendMessage(query) {
    addUserMessage(query);
    showTypingIndicator();
    
    setTimeout(() => {
        removeTypingIndicator();
        const responses = getBotResponse(query);
        addBotMessage(responses.message);
        if (responses.showCareButton) {
            showCustomerCareButton();
        }
    }, 1000);
}

function sendUserMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (message) {
        sendMessage(message);
        input.value = '';
    }
}

function addUserMessage(text) {
    const messages = document.getElementById('chatMessages');
    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messages.innerHTML += `
        <div class="message user">
            <div class="message-bubble">${text}</div>
            <div class="message-time">${time}</div>
        </div>
    `;
    scrollToBottom();
}

function addBotMessage(text) {
    const messages = document.getElementById('chatMessages');
    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messages.innerHTML += `
        <div class="message bot">
            <div class="message-bubble">${text}</div>
            <div class="message-time">${time}</div>
        </div>
    `;
    scrollToBottom();
}

function showTypingIndicator() {
    const messages = document.getElementById('chatMessages');
    messages.innerHTML += `
        <div class="message bot" id="typingIndicator">
            <div class="typing-indicator">
                <span></span><span></span><span></span>
            </div>
        </div>
    `;
    scrollToBottom();
}

function removeTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    if (indicator) {
        indicator.remove();
    }
}

function getBotResponse(query) {
    const q = query.toLowerCase();
    
    // Order related
    if (q.includes('order') || q.includes('status')) {
        return {
            message: "📦 For order status, please provide your Order ID. You can find it in your order confirmation email or in your account's order history.",
            showCareButton: true
        };
    }
    
    // Delivery related
    if (q.includes('delivery') || q.includes('time') || q.includes('shipping')) {
        return {
            message: "🚚 We deliver fresh sweets within 2-4 hours in local areas. For outstation deliveries, it takes 3-5 business days. Free delivery on orders above ₹500!",
            showCareButton: false
        };
    }
    
    // Products related
    if (q.includes('product') || q.includes('sweets') || q.includes('mithai')) {
        return {
            message: "🍬 We have a wide variety of traditional Indian sweets including Kaju Katli, Gulab Jamun, Rasgulla, Motichoor Laddu, and many more! Browse our products page to see the full range.",
            showCareButton: false
        };
    }
    
    // Payment related
    if (q.includes('payment') || q.includes('refund') || q.includes('money')) {
        return {
            message: "💳 We accept all major payment methods including Credit/Debit cards, UPI, Net Banking, and Cash on Delivery. For payment issues, please try clearing cache or use a different payment method.",
            showCareButton: true
        };
    }
    
    // Price related
    if (q.includes('price') || q.includes('cost') || q.includes('rate')) {
        return {
            message: "💰 Our sweets range from ₹299 to ₹999 depending on the item and quantity. We also have special combo packs and festival offers!",
            showCareButton: false
        };
    }
    
    // Contact related
    if (q.includes('contact') || q.includes('phone') || q.includes('call')) {
        return {
            message: "📞 You can reach our customer care at +91 98765 43210. We're available from 9 AM to 9 PM, 7 days a week.",
            showCareButton: false
        };
    }
    
    // Greeting
    if (q.includes('hello') || q.includes('hi') || q.includes('hey') || q.includes('namaste')) {
        return {
            message: "Namaste! 🙏 How can I help you today? You can ask about our products, delivery, payment, or any other query.",
            showCareButton: false
        };
    }
    
    // Default
    return {
        message: "Thank you for your message! For immediate assistance, you can contact our customer care. If this is urgent, please click the 'Contact Customer Care' button below.",
        showCareButton: true
    };
}

function showCustomerCareButton() {
    const messages = document.getElementById('chatMessages');
    messages.innerHTML += `
        <button class="customer-care-btn" onclick="contactCustomerCare()">
            <i class="bi bi-telephone-fill"></i> Contact Customer Care
        </button>
    `;
    scrollToBottom();
}

function contactCustomerCare() {
    const messages = document.getElementById('chatMessages');
    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messages.innerHTML += `
        <div class="message bot">
            <div class="message-bubble">
                <strong>Connecting to Customer Care...</strong><br><br>
                📞 <strong>Customer Care Number:</strong> <a href="tel:+919876543210">+91 98765 43210</a><br>
                ⏰ Available: 9 AM - 9 PM (7 days a week)<br><br>
                You can also email us at: support@shuddhswad.com
            </div>
            <div class="message-time">${time}</div>
        </div>
    `;
    scrollToBottom();
}

function scrollToBottom() {
    const messages = document.getElementById('chatMessages');
    messages.scrollTop = messages.scrollHeight;
}
</script>