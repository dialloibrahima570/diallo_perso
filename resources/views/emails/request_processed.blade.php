<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demande traitée</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        color: #1f2933;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    h1 {
        color: #e63946;
        font-size: 24px;
        margin-bottom: 20px;
    }
    p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    a.button {
        display: inline-block;
        padding: 10px 20px;
        margin: 15px 0;
        background-color: #22c55e;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background 0.3s;
    }
    a.button:hover {
        background-color: #16a34a;
    }
    .footer {
        font-size: 12px;
        color: #6b7280;
        text-align: center;
        margin-top: 30px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Bonjour {{ $requestItem->name }} !</h1>

        @if($requestItem->status === 'approved')
            <p>Votre demande de <strong>{{ ucfirst($requestItem->type) }}</strong> a été <span style="color:#22c55e;font-weight:bold;">approuvée ✅</span>.</p>
            @if($requestItem->type === 'cv')
                <p>Téléchargez votre CV ici :</p>
                <a href="{{ url('/storage/cv/mon_cv.pdf') }}" class="button">Télécharger mon CV</a>
            @elseif($requestItem->type === 'project')
                <p>Votre projet est disponible ici :</p>
                <a href="{{ url('/storage/projects/' . $requestItem->project_name) }}" class="button">Télécharger le projet</a>
            @endif
        @else
            <p style="color:#e63946;font-weight:bold;">Votre demande a été refusée ❌</p>
        @endif

        <p>Merci pour votre intérêt et votre confiance.</p>

        <div class="footer">
            © {{ date('Y') }} Mon Portfolio
        </div>
    </div>
</body>
</html>
