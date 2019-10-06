<?php

//define variables and set to empty values
$name_error = $email_error = "";
$name = $email = $subject = $message = $success = "";

//form is submitted with POST method
if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $name_error = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        //check if name only contains lettersand whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $name_error = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        //check if email is well-formed
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
    }
        if (empty($_POST["subject"])) {
            $subject = "";
        } else {
            $subject = test_input($_POST["subject"]);
        } 

        if (empty($_POST["message"])) {
            $message = "";
        } else {
            $message = test_input($_POST["message"]);
        }

        if ($name_error == '' and $email_error == ''){
            $message_body='';
            unset($_POST['submit']);
            foreach($_POST as $key => $value){
                $message_body= "$key: $value\n";
            }
            $from = 'temmieonifade@gmail.com';
            $to = 'temmieonifade@gmail.com';
            $subject = 'Contact Form Submit';
            $headers = 'From : webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com';
            $headers = "From:" . $from;
            if (mail($to, $subject, $message, $headers)){
                $success = "Message sent, thank you for contacting us!";
                $name = $email = $subject = $message = '';

            }
        }
    }

    function test_input($data)  {
        $data =  trim($data);
        $data =  stripslashes($data);
        $data =  htmlspecialchars($data);
        return $data;
    }
