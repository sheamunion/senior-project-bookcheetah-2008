<?php

$recipients = 'smunion@gmail.com';
$name = 'Shea';
$message = '<p> Hello '.$name.'!</p><p style="font-weight:bold;">How are you?</p>';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: BOOKCHEETAH' . "\r\n";

mail($recipients, 'Someone wants to buy your book!', $message, $headers);
?>