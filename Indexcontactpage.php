<?php include('contact.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/contact.css">
    <title>Contact Us</title>
</head>                 
<body>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method = "POST" id="contact">
        <img src="images/group.png" alt="logo" class="logo">
        <img src="images/2783703.png" alt="Image" class="image">
        <div class="contact-us">
            <h1>CONTACT US</h1>
            <p class="intro">We're happy to answer any question you have and we also welcome any suggestion. 
            Just send us a message in the form below with any question or suggestion you may have.</p>

            <label class="your-name">
                YOUR NAME
            </label>
            <input name = "name" type="text" id="name">
            <span class= "error"><?= $name_error ?></span>

            <label class="your-email">
                YOUR EMAIL
            </label>
            <input name = "email" type="text" id="email">
            <span class= "error"><?= $email_error ?></span>

            <label class="your-subject">
                YOUR SUBJECT
            </label>
            <input name = "subject" type="text" id="subject">

            <label class="your-message">
                YOUR MESSAGE
            </label>
                <textarea name="message" type="text" id="message" cols="30" rows="10"></textarea>
            <div class = "success"><?= $success; ?></div>
            </form>
    
            <button type="submit" id="submit" data-submit="...Sending">SEND</button>
            <div class = "<? $success ?>"></div>
        </div>
        <div class= "status">
        </div>
        <h2 id="my-email">EMAIL</h2>
            <p class="my-email">temmieonifade@gmail.com</p>
            <i class="line-1"></i>
        <h2 id="my-phone">PHONE</h2>
            <p class="my-phone">+2349033582405</p>
            <i class="line-2"></i>
    </html>
