<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT API Test</title>
    <link rel="stylesheet" href="styles/chatbot/style.css">
</head>
<body>
<div id="chat">
    <div id="chat-indicator" class="show">?</div>
    <div id="reponse"></div>
    <form id="chatForm">
        <input type="text" name="message" placeholder="Ecrire au bot ...">
        <input type="submit" value="Envoyer">
    </form>
</div>
<script>
    var messagesHistory = [
    {
        role: 'system',
        content: "Bonjour, je suis le chatbot de Bioclipse, conçu pour vous aider à naviguer sur notre plateforme. Chez Bioclipse, nous connectons les consommateurs avec des artisans locaux tels que bouchers, boulangers, poissonniers, maraîchers, laitiers, et fromagers. Vous pouvez explorer et réserver des produits directement sur notre site. Cependant, veuillez noter que le paiement se fait en personne, directement avec le producteur au moment de la récupération de vos produits. En plus de la réservation, notre site offre une fonctionnalité de messagerie interne. Cette messagerie est votre outil pour communiquer facilement avec les producteurs. Vous pouvez l'utiliser pour obtenir des conseils sur les produits, discuter de votre commande, ou partager vos retours et expériences. Notre objectif est de faciliter une expérience d'achat personnalisée et engageante, soutenant à la fois nos clients et nos producteurs locaux. Si vous avez des questions sur le fonctionnement de notre site, ou si vous avez besoin d'aide pour une réservation ou l'utilisation de la messagerie, je suis là pour vous aider."
    }
];

    var chatBubble = document.getElementById('chat');
    chatBubble.addEventListener('click', function(event) {
        this.classList.toggle('expanded');
        updateChatInterface();
    });

    document.querySelectorAll('#chat form, #chat input').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });

    document.querySelector('#chatForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var messageText = document.querySelector('#chat input[name="message"]').value;

        if (messageText.trim() !== '') {
            var userMessage = { role: 'user', content: messageText };
            messagesHistory.push(userMessage);
            updateChatInterface();

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'lib/scripts/chatbot/traitement.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    var assistantMessage = { role: 'assistant', content: response };
                    messagesHistory.push(assistantMessage);
                    updateChatInterface();
                }
            };
            xhr.send('messages=' + encodeURIComponent(JSON.stringify(messagesHistory)));
            document.querySelector('#chat input[name="message"]').value = '';
        }
    });

    function updateChatInterface() {
    var chatInterface = document.querySelector('#chat #reponse');
    chatInterface.innerHTML = ''; 

    messagesHistory.slice(1).forEach(function(message) {
        var messageContainer = document.createElement('div'); 
        messageContainer.className = 'message-container ' + (message.role === 'user' ? 'conteneur_user' : '');

        var messageDiv = document.createElement('div');
        messageDiv.className = 'message ' + message.role;
        messageDiv.textContent = message.content;

        messageContainer.appendChild(messageDiv); 
        chatInterface.appendChild(messageContainer); 
    });

    chatInterface.scrollTop = chatInterface.scrollHeight; 
}


</script>
<script src="lib/scripts/chatbot/chatbot.js"></script>
</body>
</html>
