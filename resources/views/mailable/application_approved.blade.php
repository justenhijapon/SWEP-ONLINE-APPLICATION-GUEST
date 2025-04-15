<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
<div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #28a745;">✅ Application Approved</h2>

    <p>Dear {{ $application->name }},</p>

    <p>We are pleased to inform you that your application has been <strong>approved</strong>. You may now proceed with the next steps as indicated in your account dashboard.</p>

    <h4>Application Summary:</h4>
    <ul>
        <li><strong>Reference No.:</strong> {{ $application->slug }}</li>
        <li><strong>Email:</strong> {{ $application->email }}</li>
        <!-- Add more relevant application details if needed -->
    </ul>

    <p>To view the status or take further action, please <a href="{{ url('/') }}">log in to your account</a>.</p>

    <p>If you have any questions or need assistance, feel free to contact our support team.</p>

    <br>
    <p>Best regards,<br>
        <strong>SRA Online Application</strong></p>
</div>
</body>
</html>
