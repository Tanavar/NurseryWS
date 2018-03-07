<?
$to      = 'hit-rebecca@hotmail.co.uk';
$subject = $_POST["subject"];
$message = $_POST["message"];
$headers = 'From: ' . $_POST["email"] . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

//mail($to, $subject, $message, $headers);

header("Location: " . $_SERVER["HTTP_REFERER"]);

?>