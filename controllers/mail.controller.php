<?php

use PHPMailer\PHPMailer\PHPMailer; 
require_once "views/vendor/autoload.php";
require "views/config/mail_config.php";

class MailController { 
    public function ctrlCreateMail() {
        if(isset($_POST['send_mail']) && !empty($_POST['email'])) { 
            $name = $_POST['name'];
            $senderemail = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

           
            

            $mail = new PHPMailer();

                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host = MailConfig::SMTP_HOST;                            // Specify main and backup SMTP servers
                $mail->Username = MailConfig::SMTP_USER;                   // SMTP username
                $mail->Password = MailConfig::SMTP_PASSWORD;                    // SMTP password
                $mail->Port = MailConfig::SMTP_PORT;                            // TCP port to connect to
                $mail->SMTPAuth = true;                                     // Enable SMTP authentication
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->CharSet = 'UTF-8';                                   // Sets the character set
                $mail->isHTML(true);
//              $mail->SMTPDebug = 2;                                       // Enable verbose debug output

                // $mail->setFrom("joesoftmwai@gmail.com", "Mwai Joseph");
                
                /* Set the mail sender. */
                // $mail->setFrom($senderemail);

                /* Add a recipient. */
                // $mail->addAddress('joesoftmwai@gmail.com', 'Emperor');                                  //receives address from the form
                $mail->setFrom($senderemail, 'System');
                $mail->addReplyTo('joesoftmwai@gmail.com', 'System');
                $mail->addAddress('joesoftmwai@gmail.com', 'Customer');
                
                $mail->Subject = $subject;
                $mail->Body = '<p> Handle PHPMailer One Way Error ' .$senderemail. ' Messages ' .$message. ' </p>';

                if ($mail->send()) {

                    echo "<script>
                        Swal.fire({
                            type: 'success',
                            title: 'Email sent successfully',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'index.php'
                               }
                            });

                        </script>";
                } else {
            
                    echo "<script>
                        Swal.fire({
                            type: 'error',
                            title: 'Error occurred while processing your requets',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
                }

        }
    }
 }