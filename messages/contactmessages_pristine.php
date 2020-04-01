<?php

 include('../config/config.php');
echo"on contact page";
 header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
 header('Pragma: no-cache');
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Origin: http://localhost:3000/#/contact");  
// header("Access-Control-Allow-Origin: Content-type: text/html; charset=UTF-8\r\n");
//header(" Access-Control-Allow-Methods: GET,HEAD,PUT,PATCH,POST,DELETE");
//header("Vary: Access-Control-Request-Headers");
//header("Access-Control-Allow-Headers: Content-Type, Accept");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

if (empty($_POST['fname']) 
        && empty($_POST['lname'])
        && empty($_POST['number'])  
        && empty($_POST['message'])
        )die();

if (isset($_POST['fname'])) {
   $fname = $_POST['fname']; 
}
if (isset($_POST['lname'])) {
   $lname = $_POST['lname']; 
}
if (isset($_POST['email'])) {
   $email = $_POST['email']; 
}
if (isset($_POST['number'])) {
   $number = $_POST['number']; 
}
if (isset($_POST['message'])) {
   $message = $_POST['message']; 
}
   
          $emailBody ="";
 	  $Email ="";
 	  $Phone ="";
          $RecipientEmail = "vanessa.bonogo@gmail.com";
 
        
$sql = "INSERT INTO contactmessages (FirstName, LastName, Email, Phone, Subject, Date) 
        VALUES (  $fname ,  $lname, $email, $number, $message, now())";
 echo "query created";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";    
   // $result = mysqli_query($connect, $query);
      $CCEmail ="modpleh@yahoo.co.uk";
      $Email .= $_POST['email'];
      $Phone .= $_POST['number'];
      $Message .=$_POST['message'];
      $emailBody .= $_POST['message']." "."<br>Seller email: ". $Email." "."Customer telephone number: ".$Phone.'<br>';
     
  
     
   
         $to = $RecipientEmail;
         $subject = "I would like to enquiry about";
         
         $message = "<b>This is HTML message.</b>";
         $message .= $emailBody;
         
         $headers = "From: ".$_POST['email']. "\r\n";
         $header .= "Cc:mpleh@hotmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
            echo $row_sendemail[0].$row_selleremail [0];
         }else {
            echo "Message could not be sent...";
         }
     
     
     
   } 



echo "On contact page";

$conn->close();
