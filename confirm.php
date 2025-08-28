<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        @font-face {
            font-family: 'Calibre';
            font-style: normal;
            font-weight: 500;
            src: local('Calibre'), url('https://fonts.cdnfonts.com/s/22257/CalibreMedium.woff') format('woff');
        }

        @font-face {
            font-family: 'CalibreBold';
            font-style: normal;
            font-weight: 700;
            src: local('Calibre'), url('https://fonts.cdnfonts.com/s/22257/CalibreBold.woff') format('woff');
        }

        body {
            font-family: 'Calibre', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #B8DFCE;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }

        form {
            text-align: center;
            width: 100%;
        }

        h2 {
            font-family: 'CalibreBold', Arial, sans-serif;
            color: #2c3e50;
            text-align: center;
        }

        input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #B8DFCE;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }

        .message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Oswald:wght@500&display=swap" rel="stylesheet">
    <title>Verification du Mot de Passe</title>
</head>

<body>
    <div class="container">
        <form action="enseignant2.php" method="post">
            <h3>Verification du Mot de Passe</h3>
            <input type="password" name="password" placeholder="Mot de passe" required />
            <p class="message">Veuillez entrer le mot de passe dans la boîte.</p>
            <input type="submit" value="Valider">
        </form>
    </div>
</body>

</html>
