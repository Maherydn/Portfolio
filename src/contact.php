<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Valider les données
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Destinataire
        $to = "maherydn@gmail.com";
        
        // Sujet de l'e-mail
        $subject = "Nouveau message de contact de $name";

        // Contenu du message
        $messageContent = "
        <html>
        <head>
            <title>Nouveau message de contact</title>
        </head>
        <body>
            <h2>Nouveau message de $name</h2>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        </body>
        </html>
        ";

        // En-têtes de l'e-mail
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . $email . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";

        // Envoi de l'e-mail
        if (mail($to, $subject, $messageContent, $headers)) {
            echo "Merci, votre message a été envoyé.";
        } else {
            echo "Désolé, une erreur s'est produite. Veuillez réessayer.";
        }
    } else {
        echo "Veuillez remplir tous les champs correctement.";
    }
}
?>
