<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Réponse à votre message</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 0;
        color: #1f2933;
    }
    .container {
        max-width: 600px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .header {
        background-color: #e63946;
        color: #fff;
        text-align: center;
        padding: 25px 20px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
    }
    .body-content {
        padding: 30px 25px;
        font-size: 16px;
        line-height: 1.6;
        color: #1f2933;
    }
    .body-content p {
        margin-bottom: 15px;
    }
    .button {
        display: inline-block;
        padding: 12px 25px;
        margin: 15px 0;
        background-color: #22c55e;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background 0.3s;
    }
    .button:hover {
        background-color: #16a34a;
    }
    .footer {
        background-color: #f8f9fa;
        text-align: center;
        padding: 15px;
        font-size: 12px;
        color: #6b7280;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="body-content">
            <p>Bonjour <strong>{{ $name }}</strong>,</p>

            <p>{!! nl2br(e($messageText)) !!}</p>

        </div>

        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
        </div>
    </div>
</body>
</html>
