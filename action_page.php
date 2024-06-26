<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['Name']);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['Message']);

    // Email details
    $to = "amandarosafj@live.com";
    $subject = "New message from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    // Email content
    $email_content = "
    <html>
    <head>
      <title>New message from $name</title>
    </head>
    <body>
      <h2>New message from the contact form</h2>
      <p><strong>Name:</strong> $name</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Message:</strong> $message</p>
    </body>
    </html>
    ";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid request method.";
}
?>
