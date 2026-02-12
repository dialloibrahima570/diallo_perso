<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Votre CV est prêt</title>

<style>
body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f4f6f9;margin:0;padding:0;color:#1f2933}
.container{max-width:600px;margin:40px auto;background:#fff;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,.1);overflow:hidden}
.header{background:linear-gradient(135deg,#6b7280,#6b7280);padding:26px 20px;text-align:center}
.header h1{margin:0;color:#fff;font-size:24px;font-weight:600}
.body{padding:30px 25px;font-size:16px;line-height:1.7}
.box{background:#f0fdf4;border-left:4px solid #6b7280;padding:14px 18px;border-radius:8px;margin:18px 0}
.btn{display:inline-block;padding:12px 22px;background:#8c8ca4;color:#e12727;border-radius:8px;text-decoration:none;font-weight:500}
.footer{background:#f8f9fa;text-align:center;padding:15px;font-size:12px;color:#6b7280}
</style>
</head>

<body>
<div class="container">

<div class="header">
<h1>{{ config('app.name') }}</h1>
</div>

<div class="body">
<h2>Bonjour</h2>

@if(!empty($messageText))
<p><strong>Message du responsable :</strong></p>
<div class="box">
{{ $messageText }}
</div>
@endif

<p>Votre CV est prêt. Vous pouvez le télécharger via le lien ci-dessous :</p>

<p>
<a href="{{ $link }}" class="btn">Télécharger le CV</a>
</p>

<p style="font-size:13px;color:#6b7280;margin-top:20px">
Ce lien est sécurisé et expirera dans 30 minutes.
</p>

<p>Merci pour votre confiance,<br><strong>{{ config('app.name') }} -ibrahima</strong></p>
</div>

<div class="footer">
© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
</div>

</div>
</body>
</html>
