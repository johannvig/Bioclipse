<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = "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";
    $url = 'https://api.openai.com/v1/chat/completions';

    // Récupération des messages du POST
    $messages = json_decode(urldecode($_POST['messages']), true);

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => $messages,
        'max_tokens' => 75 // Limite approximative pour 300 caractères
    ];

    // Initialisation de cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    }
    curl_close($ch);

    $responseData = json_decode($response, true);
    if (isset($responseData['choices'][0]['message']['content'])) {
        echo $responseData['choices'][0]['message']['content'];
    } else {
        echo "Erreur lors de la réception de la réponse de l'API.";
    }
}
?>
