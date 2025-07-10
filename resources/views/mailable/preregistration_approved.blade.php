<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
<div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <h2 style="color: #28a745;">✅ Registration Approved</h2>

    <p>Dear {{ \Illuminate\Support\Str::title($user->first_name) }} {{ \Illuminate\Support\Str::title($user->last_name) }},</p>

    <p>We are pleased to inform you that your registration has been <strong>approved</strong>. You can now access your account and use our services.</p>

    <h4>Your Account Details:</h4>
    <ul>
{{--        <li><strong>Username:</strong> {{ $user->email }}</li>--}}
        <!-- Do NOT include the password for security reasons -->
        <li><strong>Company:</strong> {{ $user->business_name }}</li>
{{--        <li><strong>Email:</strong> {{ $user->email }}</li>--}}
    </ul>

    <p>You may now <a href="{{ url('/') }}">log in to your account</a> using your credentials.</p>

    <p>If you did not initiate this registration, please contact us immediately.</p>

    <p>Thank you and welcome aboard!</p>

    <br>
    <p>Best regards,<br>
        <strong>SRA Online Application</strong></p>
{{--        <strong>{{ config('app.name') }}</strong></p>--}}


    <hr style="margin-top: 30px; border: none; border-top: 1px solid #ccc;">
    <p style="font-size: 12px; color: #777;">
        This is a system-generated message. Please do not reply.
    </p>

    <hr style="border: none; border-top: 1px solid #ccc;">

    <div style="text-align: center;">
        <img src="https://sra.gov.ph/constra/images/SRA/SRA_DA%20logo.png" alt="SRA Logo" style="height: 60px;">
        <p style="font-size: 12px; color: #777; margin: 0;">
            Sugar Regulatory Administration<br>
            Sugar Center Bldg., North Avenue, Diliman, Quezon City
        </p>
    </div>
</div>
</body>
</html>
