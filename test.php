<?php
require_once "Mail.php";
$from = "Sandra Sender <priyansh.jain0246@gmail.com>";
$to = "Ramona Recipient <priyanshjain412@gmail.com>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
$host = "ssl://smtp.gmail.com";
$username = "priyansh.jain0246@gmail.com";
$password = "Priyansh@412";
$headers = array('From' => $from,
    'To' => $to,
    'Subject' => $subject);
$smtp = Mail::factory('smtp',
    array('host' => $host,
        'auth' => true,
        'username' => $username,
        'password' => $password));
$mail = $smtp->send($to, $headers, $body);
if (PEAR::isError($mail)) {
    echo ("<p>" . $mail->getMessage() . "</p>");
} else {
    echo ("<p>Message successfully sent!</p>");
}
