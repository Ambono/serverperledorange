<?php 
include_once('../config/config.php');
// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);
$conn = mysqli_connect($servername, $username, $password, $dbname);
$con = mysqli_connect($servername, $username, $password, $dbname);  
$_SESSION['token_temp_user'] = session_id();



 
$data = json_decode(file_get_contents("php://input"), true);
print_r("<br> start printing data: ". $data.'<br>');

 
$fname = mysqli_real_escape_string($conn, $data['fname']);
$lname = mysqli_real_escape_string($conn, $data['lname']);
$email = mysqli_real_escape_string($conn, $data['email']);
$number = mysqli_real_escape_string($conn, $data['number']);
$message = mysqli_real_escape_string($conn, $data['message']);

 echo "received this data: " . $fname .' '. $lname.' '.$number.' '.$email.' '.$message.'<br>'; 
 
          $emailBody ="";
 	  $Email ="";
 	  $Phone ="";
  
           $RecipientEmail = "modpleh@yahoo.co.uk";
          $emailmessage ="";
          $headers="";
 
$sql = "INSERT INTO contactmessages (FirstName, LastName, Email, Phone, Subject, Date) 
        VALUES (  '$fname', '$lname', '$email', '$number', '$message' , now())";
  
 echo "query created";
if ($conn->query($sql) === TRUE) {print_r('job done');

      $CCEmail ="modpleh@yahoo.co.uk";
      $Email .= $email;
      $Phone .= $number;
      $emailmessage .=$message;
      $emailBody .= $emailmessage." "."<br>Seller email: ". $Email." "."Customer telephone number: ".$Phone.'<br>';
      
         $to = $RecipientEmail;
         $subject = "I would like to enquiry about";
         
         $message = "<b>This is HTML message.</b>";
         $message .= $emailBody;
         
         $headers = "From: ".$Email. "\r\n";
         $headers .= "Cc:mpleh@hotmail.com \r\n";
         $headers .= "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$headers);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
            echo $row_sendemail[0].$row_selleremail [0];
         }else {
            echo "Message could not be sent...";
         }
     
}

//print json_encode($data);
//$connect->close();
 

