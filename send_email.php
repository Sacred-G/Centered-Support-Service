<?php
header('Content-Type: application/json');

// Replace with your email address
$recipient_email = "your-email@example.com";

// Get form data
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Create email content
$subject = "New Contact Form Submission from $name $surname";
$email_content = "Name: $name $surname\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Message:\n$message\n";

// Email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
$success = mail($recipient_email, $subject, $email_content, $headers);

// Return response
echo json_encode([
    'success' => $success,
    'message' => $success ? 'Thank you for your message. We will get back to you soon!' : 'Sorry, there was an error sending your message.'
]);
?>
