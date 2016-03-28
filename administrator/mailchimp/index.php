<?php
require 'Mandrill.php';

/*$mandrill = new Mandrill('AkhY-gMNhLX74y4OpGhTdQ'); 

// If are not using environment variables to specific your API key, use:
// $mandrill = new Mandrill("YOUR_API_KEY")

$message = array(
    'subject' => 'My New Message',
    'from_email' => 'mabdelrazek@mediaandmore-eg.com',
    'html' => '<p>this is a test message with Mandrill\'s PHP wrapper!.</p>',
    'to' => array(array('email' => 'mohamed_abdo86@hotmail.com', 'name' => 'Mohamed @ Media and More')),
    'merge_vars' => array(array(
        'rcpt' => 'recipient1@domain.com',
        'vars' =>
        array(
            array(
                'name' => 'FIRSTNAME',
                'content' => 'Mohamed '),
            array(
                'name' => 'LASTNAME',
                'content' => 'Abderlazek')
    ))));

$template_name = 'Stationary';

$template_content = array(
    array(
        'name' => 'main',
        'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
    array(
        'name' => 'footer',
        'content' => 'Copyright 2012.')

);

print_r($mandrill->messages->sendTemplate($template_name, $template_content, $message));*/
// Simply Send Email Via Mandrill...

//require_once 'Mandrill.php';
$mandrill = new Mandrill('AkhY-gMNhLX74y4OpGhTdQ');

$message = new stdClass();
$message->html = "html message";
$message->text = "text body";
$message->subject = "Sending Mail from Server with mandrill";
$message->from_email = "mabdelrazek@mediaandmore-eg.com";
$message->from_name  = "Me @ Media and More";
$message->to = array(array("email" => "mohamed_abdo86@hotmail.com"));
$message->track_opens = true;

$response = $mandrill->messages->send($message);
?>