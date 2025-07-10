<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Taken Back</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
<div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #dc3545;">⚠️ Application Taken Back</h2>

    <p style="text-transform: capitalize;">Dear {{ \Illuminate\Support\Str::title($application->name) }},</p>

    <p>We would like to inform you that your application has been <strong>taken back</strong> for further review or action. This may be due to missing information, the need for clarification, or other administrative reasons.</p>

    <h4>Application Details:</h4>
    <ul>
        <li><strong>Application for:</strong> Application for Clearance to Release Other Sugar Commodity</li>
        <li><strong>Company:</strong> {{$application->company}}</li>
        <li><strong>Commodity:</strong> {{ $application->commodity }}</li>
        <li><strong>Reference No.:</strong> {{ $application->slug }}</li>
        <!-- You can add other relevant details if necessary -->
    </ul>

    @if(!empty($remarks))
        <h4>Remarks:</h4>
        <p style="background: #f8f9fa; padding: 10px; border-left: 4px solid #dc3545;">
            {{ $remarks }}
        </p>
    @endif

    <p>Please check your account or contact our support team for more information on the next steps.</p>

    <p>You can visit your account by clicking the link below:</p>
    <p><a href="{{ url('/') }}">Go to Your Account</a></p>

    <p>If you have any questions or believe this was a mistake, please don't hesitate to reach out to us.</p>

    <br>
    <p>Best regards,<br>
        <strong>SRA Online Application</strong></p>

    <hr style="margin-top: 30px; border: none; border-top: 1px solid #ccc;">
    <p style="font-size: 12px; color: #777;">
        This is a system-generated message. Please do not reply.
    </p>

</div>
</body>
</html>
