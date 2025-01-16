<?php 
session_start();
include 'forgetPass.php';

?>
<html>
   
   <head>
      <title>Sending HTML email using PHP</title>
   </head>
   
   <body>
      
      <?php
         $to = $_SESSION['email'];
         $subject = "New Password";
         
         $message = "<b>This is your new password.</b>";
         $message .= "<h1>".$_SESSION['password']."</h1>";
         $message .= "<a href='login.php'>איפוס סיסמה </a>";
         
         $header = "From:mayan.yehuda@gmail.com \r\n";
        // $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>
