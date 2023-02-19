<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>{{ $contact['subject'] ?? '' }}</title>
        <style>
            /* Ajoutez votre propre style ici */
        </style>
    </head>
    <body>
        <div>
            <h2>Salut,</h2>
            <p>Vous recevez cet e-mail depuis votre site de l'utilisateur :  {{ $contact['email'] ?? '' }}.</p>
            <p>Voici le message:</p>
            <p>{{ $contact['contenu'] ?? '' }}</p>
            <p>Merci de nous contacter!</p>
        </div>
    </body>
</html>