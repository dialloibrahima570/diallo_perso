<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mise à jour de votre demande</title>

<style>
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f4f6f9; margin:0; padding:0; color:#1f2933; }
.container { max-width:600px; margin:40px auto; background:#fff; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.1); overflow:hidden; }
.header { background:@if(($requestData instanceof \App\Models\ProjectRequest && $status=='accepted') || ($requestData instanceof \App\Models\TelechargerCV && $status=='approved')) linear-gradient(135deg,#6b7280,#6b7280) @elseif($status=='rejected') linear-gradient(135deg,#6b7280,#6b7280) @else linear-gradient(135deg,#6b7280,#6b7280) @endif; color:#6b7280; text-align:center; padding:26px 20px; }
.header h1 { margin:0; color: #fff; font-size:24px; font-weight:600; }
.body-content { padding:30px 25px; font-size:16px; line-height:1.7; color:#1f2933; }
.body-content h2 { font-size:20px; margin-bottom:15px; color:#111827; }
.body-content p { margin-bottom:14px; }
.project-box { background:#f0fdf4; border-left:4px solid #6b7280; padding:14px 18px; border-radius:8px; margin:18px 0; font-size:15px; }
.footer { background:#f8f9fa; text-align:center; padding:15px; font-size:12px; color:#6b7280; }
@media (max-width:600px){.container{margin:20px 10px;}.body-content{padding:22px 18px;font-size:15px;}.header h1{font-size:22px;}}
</style>
</head>
<body>
<div class="container">

<div class="header">
<h1>{{ config('app.name') }}</h1>
</div>

<div class="body-content">
<h2>Bonjour {{ $requestData->name }}</h2>

@php
$isApproved = ($requestData instanceof \App\Models\ProjectRequest && $status=='accepted') || ($requestData instanceof \App\Models\TelechargerCV && $status=='approved');
@endphp

@if($isApproved)
<p>Votre demande @if($requestData instanceof \App\Models\ProjectRequest) de projet @else de CV @endif a été <strong>approuvée</strong>.</p>

@if($requestData instanceof \App\Models\ProjectRequest && isset($requestData->project))
<div class="project-box">
<p> {{ $requestData->project }}</p>
</div>
@endif

<p>Les liens vous seront envoyés prochainement.</p>

@elseif($status=='rejected')
<p>Votre demande @if($requestData instanceof \App\Models\ProjectRequest) de projet @else de CV @endif a été <strong>refusée</strong>.</p>
@endif

<p>Merci pour votre confiance,<br><strong>{{ config('app.name') }}</strong></p>
</div>

<div class="footer">
© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
</div>

</div>
</body>
</html>
