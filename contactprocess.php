<?php
  session_start();


  require_once 'Mailer/PHPMailerAutoload.php'; //directory to the PHP mailer library

  $errors = [];

  if(isset($_POST['name'],$_POST['email'], $_POST['message'])){

    $fields = [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'message' => $_POST['message']
    ];



    // check if the fields are not empty
    foreach($fields as $field => $data){
      if(empty($data)){
        $errors[] = 'The ' . $field . ' field is required.';
      }
    }


    // email address validation
    if (isset($_POST['email']) == true && empty($_POST['email']) == false) {
      $email = $_POST['email'];
      if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $errors[] = 'The email address is invalid.';
      }
    }

    //send email of no errors
    if(empty($errors)){
      $mail = new PHPMailer(true);


      $mail->isSMTP(); // comment out while not using on localhost
      $mail->SMTPDebug = 3; // display error information
      $mail->SMTPAuth = true;



      $mail->Host = 'smtp.gmail.com'; //smtp server
      $mail->Username = 'cafecoriander1@gmail.com'; //email address
      $mail->Password = 'CUPCAKE12345'; //password
      $mail->SMTPSecure ='ssl';
      $mail->Port = 465;

      $mail->isHTML(true);

      $mail->Subject = 'Comment Recieved';
      $mail->Body = 'From : ' . $fields['name'] . ' (' . $fields['email'] . ')<p>' . $fields['message'] . '</p>';

      $mail->FromName = 'Contact'; //sender

      $mail->AddAddress('cafecoriander1@gmail.com', 'Cafe Coriander'); //reciever

      if($mail-> send()) {
        header('Location: thanks.php'); // location of a confirmation message after the email is sent

      } else {
        $errors[] = 'Sorry, could not send email. Try again';
      }
    }

  } else {
    $errors[] = 'Something went wrong.';
  }

//send email to the sender
    if(empty($errors)){
      $mail = new PHPMailer(true);


      $mail->isSMTP(); // comment out while not using on localhost
      $mail->SMTPDebug = 3; // display error information
      $mail->SMTPAuth = true;



      $mail->Host = 'smtp.gmail.com'; //smtp server
      $mail->Username = 'cafecoriander1@gmail.com'; //email address
      $mail->Password = 'CUPCAKE12345'; //password
      $mail->SMTPSecure ='ssl';
      $mail->Port = 465;

      $mail->isHTML(true);

      $mail->Subject = 'Thank you.';
      $mail->Body = 'Your comments have been recieved by us at Cafe Coriander. We would like to thank you for your feedback. <br> Have a great day. <br> Cafe Coriander';

      $mail->FromName = 'Contact'; //sender

      $mail->AddAddress('' . $fields['email'] . '', 'Cafe Coriander'); //reciever

      if($mail-> send()) {
        header('Location: thanks.php'); // location of a confirmation message after the email is sent

      } else {
        $errors[] = 'Sorry, could not send email. Try again';
      }
    }

  
  header( 'Location: contact.php')
 ?>
