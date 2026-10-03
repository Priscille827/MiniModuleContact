<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de demande</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111; line-height:1.5;">
    <h2>Bonjour {{ $demande->nom }},</h2>

    <p>Nous avons bien reçu votre demande et nous vous en remercions.</p>

    <p>
        Votre numéro de suivi est :
        <strong style="color:#2563eb;">{{ $demande->numero_demande }}</strong>
    </p>

    <p><strong>Récapitulatif :</strong></p>
    <ul>
        <li><strong>Service :</strong> {{ $demande->service->nom ?? 'N/A' }}</li>
        <li><strong>Message :</strong> {{ $demande->message }}</li>
        <li><strong>Reçue le :</strong> {{ $demande->created_at->format('d/m/Y à H:i') }}</li>
    </ul>

    <p>Nous reviendrons vers vous dans les plus brefs délais.</p>

    <p>Cordialement,<br>L'équipe Benin Digital Hub</p>
</body>
</html>