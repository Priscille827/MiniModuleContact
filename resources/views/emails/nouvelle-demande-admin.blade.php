<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle demande</title>
</head>
<body style="font-family: Arial, sans-serif; color:#111; line-height:1.5;">
    <h2>🔔 Nouvelle demande reçue</h2>

    <p>Une nouvelle demande vient d'être soumise sur le site.</p>

    <table cellpadding="6" style="border-collapse: collapse;">
        <tr>
            <td><strong>Numéro :</strong></td>
            <td>{{ $demande->numero_demande }}</td>
        </tr>
        <tr>
            <td><strong>Nom :</strong></td>
            <td>{{ $demande->nom }}</td>
        </tr>
        <tr>
            <td><strong>E-mail :</strong></td>
            <td>{{ $demande->email }}</td>
        </tr>
        <tr>
            <td><strong>Service :</strong></td>
            <td>{{ $demande->service->nom ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Reçue le :</strong></td>
            <td>{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
        </tr>
    </table>

    <p style="margin-top:1rem;"><strong>Message :</strong></p>
    <blockquote style="border-left:3px solid #2563eb; padding-left:1rem; color:#333;">
        {{ $demande->message }}
    </blockquote>

    <p style="margin-top:1.5rem;">
        <a href="{{ url('/admin/dashboard') }}"
           style="background:#2563eb; color:#fff; padding:.6rem 1rem; text-decoration:none; border-radius:6px;">
            Voir dans le tableau de bord
        </a>
    </p>

    <p style="color:#666; font-size:.85rem; margin-top:1.5rem;">
        Benin Digital Hub — Notification automatique
    </p>
</body>
</html>