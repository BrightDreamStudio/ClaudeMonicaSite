<?php

// Adresse destinataire (vous)
$to = "contact@monicahards.com";
$from = "noreply@monicahards.com";

// Récupération des données du formulaire
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($_POST['subject'] ?? '');
$message = "Adresse de l'expéditeur : $email\n\n" . htmlspecialchars($_POST['message'] ?? '');
$lang = $_SERVER['HTTP_REFERER'] ?? '/';

// Vérification du honeypot
if (!empty($_POST['website'])) {
    // Si le champ caché est rempli, on considère que c'est un bot
    header("Location: " . $lang . "?status=spam");
    exit();
}

// Vérification du CAPTCHA
$recaptcha_secret = "6Lc-2zgrAAAAACaW1rBaKQcu5AMLzaLKgAUsUuTp";
$recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_data = json_decode($verify);

if (!$response_data->success) {
    header("Location: " . $lang . "?status=captcha_error");
    exit();
}

// Construction des headers
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";

// Envoi du mail
$success = mail($to, $subject, $message, $headers);

if ($success) {
    header("Location: " . $lang . "?status=success");
} else {
    header("Location: " . $lang . "?status=error");
}
exit();

?>