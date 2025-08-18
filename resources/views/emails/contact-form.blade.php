<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>New Contact Form Submission</title>
    <style>
        /* --- Base Styles --- */
        :root {
            --background-light: #ffffff;
            --text-light: #212529;
            --background-dark: #1a202c;
            --text-dark: #e2e8f0;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            background-color: var(--background-light);
            color: var(--text-light);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 15px;
        }

        a {
            color: #3490dc;
        }

        hr {
            border: 0;
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        .message-content {
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 8px;
        }

        /* --- Dark Mode Styles --- */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: var(--background-dark);
                color: var(--text-dark);
            }
            hr {
                border-top-color: #4a5568;
            }
            .message-content {
                background-color: #2d3748;
            }
        }
    </style>
</head>
<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <div class="email-container">
                    <h2>New Message from Portfolio</h2>
                    <p><strong>From:</strong> {{ $data['name'] }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
                    <hr>
                    <div class="message-content">
                        {{-- Using nl2br to preserve line breaks and e() to escape content for security --}}
                        <p>{!! nl2br(e($data['message'])) !!}</p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
