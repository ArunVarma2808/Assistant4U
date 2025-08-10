<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Assistant4U</title>
    <style>
        body {
            background: #f7fafc;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.10);
            padding: 0 0 32px 0;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(90deg, #4fd1c5 0%, #4299e1 100%);
            padding: 32px 0 18px 0;
            text-align: center;
        }
        .logo {
            width: 56px;
            height: 56px;
            margin-bottom: 10px;
            border-radius: 50%;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .logo img {
            width: 40px;
            height: 40px;
        }
        .header h1 {
            color: #fff;
            font-size: 1.7rem;
            margin: 0 0 4px 0;
            letter-spacing: 0.5px;
        }
        .content {
            color: #2d3748;
            font-size: 1.08rem;
            margin: 0 32px 18px 32px;
            padding-top: 24px;
        }
        .content p {
            margin: 0 0 12px 0;
        }
        .new-password-box {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 22px;
            background: #e2e8f0;
            color: #2d3748;
            font-weight: 600;
            margin: 18px 0;
            font-size: 1.18rem;
            letter-spacing: 0.5px;
            box-shadow: 0 1px 4px rgba(66,153,225,0.07);
        }
        .cta {
            display: block;
            width: fit-content;
            margin: 24px auto 0 auto;
            background: linear-gradient(90deg, #4299e1 0%, #4fd1c5 100%);
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 36px;
            border-radius: 24px;
            font-size: 1.08rem;
            box-shadow: 0 2px 8px rgba(66,153,225,0.10);
            transition: background 0.2s;
        }
        .cta:hover {
            background: linear-gradient(90deg, #4fd1c5 0%, #4299e1 100%);
        }
        .footer {
            text-align: center;
            color: #a0aec0;
            font-size: 0.98rem;
            margin-top: 32px;
            padding-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="https://raw.githubusercontent.com/ArunVarma2808/Assistant4u/refs/heads/main/public/logo.png" alt="Assistant4U Logo" />
            </div>
            <h1>Password Reset Successful</h1>
        </div>
        <div class="content">
            <p style="font-size:1.13rem;">Hello <strong>{{ $user->name ?? 'User' }}</strong>,</p>
            <p>We have received a request to reset your password for your Assistant4U account. Your password has been successfully reset.</p>
            <p>Your new password is:</p>
            <div class="new-password-box">
                {{ $newPassword ?? '********' }}
            </div>
            <p style="margin-top:18px;">For your security, please log in and change this password as soon as possible.</p>
        </div>
        <a href="{{ url('/signin') }}" target="_blank" class="cta">Sign In to Your Account</a>
        <div class="footer">
            If you did not request this password reset, please contact our support team immediately.<br>
            <span style="font-size:0.92em;">&copy; {{ date('Y') }} Assistant4U</span>
        </div>
    </div>
</body>
</html>
