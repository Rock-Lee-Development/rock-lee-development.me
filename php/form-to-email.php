<?php
/**
 * Created by PhpStorm.
 * User: Ian
 * Date: 3/7/2018
 * Time: 5:26 PM
 */
if(!isset($_POST["submit"]))
{
	//The page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

$name = 'Ian';
$visitor_email = 'timberland.wolves@gmail.com';
$message = 'test test test!';

//Validate first
if(empty($name)||empty($visitor_email))
{
	echo "Name and email are mandatory!";
	exit;
}

$email_from = 'ibf453@localhost';// <==Put your email address here
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name.\n".
	"email address: $visitor_email\n".
	"Here is the message:\n $message".
	
$to = "ibf453@localhost";// <==Put your email address here
$headers = "From: $email_from \r\n";

//Send the email!
mail($to,$email_subject,$email_body,$headers);
//Done. Redirect to thank-you page.
$url='../thank_you_page.html';
echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
?>