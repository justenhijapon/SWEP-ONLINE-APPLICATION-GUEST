<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Taken Back</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
<div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #dc3545;">⚠️ Application Taken Back</h2>

    <p style="text-transform: capitalize;">Dear {{ $application->name }},</p>

    <p>We would like to inform you that your application has been <strong>taken back</strong> for further review or action. This may be due to missing information, the need for clarification, or other administrative reasons.</p>

    <h4>Application Details:</h4>
    <ul>
        <li><strong>Email:</strong> {{ $application->email }}</li>
        <!-- You can add other relevant details if necessary -->
    </ul>

    <p>Please check your account or contact our support team for more information on the next steps.</p>

    <p>You can visit your account by clicking the link below:</p>
    <p><a href="{{ url('/') }}">Go to Your Account</a></p>

    <p>If you have any questions or believe this was a mistake, please don't hesitate to reach out to us.</p>

    <br>
    <p>Best regards,<br>
        <strong>SRA Online Application</strong></p>
</div>
</body>
</html>
