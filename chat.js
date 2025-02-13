document.addEventListener('DOMContentLoaded', function() {
    const chatBox = document.getElementById('chat-box');
    const messageForm = document.querySelector('form');
    const messageInput = document.querySelector('input[type="text"]');

    // Scroll chat box to the bottom
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Send a new message
    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const message = messageInput.value.trim();

        if (message) {
            // Send the message to the server using AJAX (POST request)
            fetch('chat.php', {
                method: 'POST',
                body: new URLSearchParams({
                    message: message
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'Message sent') {
                    // Clear the input field after sending the message
                    messageInput.value = '';
                    // Append the message to chat-box (For demo purposes)
                    const newMessage = document.createElement('p');
                    newMessage.innerHTML = `<strong>You:</strong> ${message} <span>${new Date().toLocaleTimeString()}</span>`;
                    chatBox.appendChild(newMessage);
                    scrollToBottom(); // Scroll down to the latest message
                } else {
                    alert('Error sending message.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Initially scroll to the bottom to load recent messages
    scrollToBottom();
});
