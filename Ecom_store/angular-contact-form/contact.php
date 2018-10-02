<?php

/**
 * Descript: Display the entered data as well send an email to entered email address.
 * @author Prem Tiwari
 * 
 */
$post_data = file_get_contents("php://input");
$data = json_decode($post_data);

//Just to display the form values
echo "Name : " . $data->name;
echo "Email : " . $data->email;
echo "Message : " . $data->message;

// sned an email
$to = $data->email;

$subject = 'Test email from freewebmentor.com to test angularjs contact form';

$message = $data->message;

$headers = 'From: ' . $data->name . 'prem@freewebmentor.com' . "\r\n" .
        'Reply-To: prem@freewebmentor.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

//php mail function to send email on your email address
mail($to, $subject, $message, $headers);

?>