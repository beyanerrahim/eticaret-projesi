<?php

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";

    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "eticaret987@gmail.com";
    $mail->Password = "eticaret6543";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";

    //email setting
    $mail->isHTML(true);
    $mail->addAddress("eticaret987@gmail.com",'eticaret');
    $mail->setFrom($email ,$name);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if($mail->send()){
          $status = "success";
          $response = "Email is sent!";
    }else{
        $status ="failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }
        
    

    exit(json_encode(array("status" => $status , "response" => $response)));
}



// <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
// <script type="text/javascript">
//        function sendEmail(){
//            var name = $("#name");
//            var email = $("#email");
//            var subject = $("#subject");
//            var body = $("#body");
           
//            if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)){
//                $.ajax({
//                      url:'sendEmail.php',
//                      method:'POST',
//                      dataType:'json',
//                      data:{
//                          name: name.val(),
//                          email: email.val(),
//                          subject: subject.val(),
//                          body: body.val()
//                      }, success:function(response){
//                          $('#myForm')[0].reset();
//                          $('.sent-not').text("Message sent successfully.");


//                      }
//                });
//            }

//        }
//        function isNotEmpty(caller){
//            if(caller.val() == ""){
//                caller.css('border','1px solid red');
//                return false;
//            }else{
//                caller.css('border','');
//                return true;
//            }

//        }
// </script>
?>
