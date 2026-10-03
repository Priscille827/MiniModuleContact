<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Demande traitée</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111; line-height:1.5;">
    <h2>Bonjour {{ $demande->nom }},</h2>

    <p>
        Bonne nouvelle : votre demande
        <strong>{{ $demande->numero_demande }}</strong>
        a été <strong style="color:#16a34a;">traitée</strong>.
    </p>

    <p>
        Si vous avez la moindre question, n'hésitez pas à répondre à cet e-mail
        en rappelant votre numéro de demande.
    </p>

    <p>Cordialement,<br>L'équipe Benin Digital Hub</p>
</body>
</html>