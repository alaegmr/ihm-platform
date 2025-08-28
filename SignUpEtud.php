<?php
//connecxion db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihm"; // le nom de votre base de données
// Create connection
$conn = new mysqli($servername, $username, $password);

// Sélectionner la base de données avec a fct mysqli_select_db
if (!mysqli_select_db($conn, $dbname)) {
    die("La sélection de la base de données a échoué: " . mysqli_error($conn));
}

//The variable name in the PHP code should match the name attribute in the input element.
if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $nom = $_POST["lastname"];
    $prenom = $_POST["firstname"];
    $username = $_POST["username"];
    $niveau = $_POST["niveau"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"]; // Utilisez password_hash pour sécuriser le mot de passe
    $password2 = $_POST["password2"];
    // Vérification de l'existence de l'email dans la base de données
    $sql = "SELECT * FROM etudiants WHERE email_etud='$email'";
    $result = mysqli_query($conn, $sql);

    if ($password2 != $password1) {
        echo "<div class='msg'>Les deux champs de mot de passe ne correspondent pas... Veuillez réessayer.";
    } else if (mysqli_num_rows($result) > 0) {
        echo "<div class='msg'>Cet email est déjà utilisé... Veuillez saisir un nouvel email.";
    } else {
        // L'email n'existe pas encore dans la base de données, l'insérer
        $req = "INSERT INTO etudiants (nom_etud, prenom_etud, username_etud, niveau_etud, email_etud, password1, password2) VALUES ('$nom', '$prenom', '$username', '$niveau', '$email', '$password1', '$password2')";

        if ($conn->query($req) === TRUE) {
            header('Location: Login.php');
            exit(); // Ensure that the script stops execution after the header
        } else {
            echo "Inscription échouée " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Oswald:wght@500&display=swap" rel="stylesheet">

    <title>Inscription - IHM Plateforme</title>
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
            margin: 0;
            padding: 0;
            font-family: 'Calibre', Arial, sans-serif;
            background-color: #ecf0f1;
            color: #000000;
            font-family: 'Calibre', Arial, sans-serif; /* Ajout de la police personnalisée */

        }

        header {
            background-color: #B8DFCE;
            color: #000000;
            padding: 0.5px;
            text-align: left;
        }

        header h1 {
            margin-left: 25px;
            font-size: 30px;
        }

        form {
            width: 600px;
            margin: 50px auto;
            margin-top: 35px;
            padding: 40px;
            background-color: #ecf0f1;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 15px;
        }

        label {
            display: block;
            margin: 15px 0;
            font-weight: bold;
            margin-left: 25px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-left: 23px;    
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #B8DFCE;
            border-radius: 4px;
        }

        button {
            width: 70%;
            background-color: #B8DFCE;
            color: #000000;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 15px auto 0;
        }

        button:hover {
            background-color: #2980b9;
        }

        .title {
            color: #000000;
            text-decoration: underline;
            margin-top: 30px; /* Ajusté pour descendre davantage le titre */
        }
        .title h2{
            text-align: center;
            margin-top: -15px;
        }
        .msg{
            color:green;
                    float:right;
                    margin-right:50px;
        }
        .sign_link{
    margin-left:180px;
}
#g:hover{
    background-color: #0D6E3D; /* Change the background color on hover */

}
    </style>
</head>
<body>
    <header>
        <h1>IHM Plateforme</h1>
    </header>
    <div class="title">
        <h1 style="text-align: center;">Inscription à la plateforme</h1>
        <br>
        <h2>"Etudiant"</h2>
    </div>
    <div class="boxe">
        <form method="post">
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>

            <label for="niveau">Niveau :</label>
            <input type="text" id="niveau" name="niveau" required>

            <label for="password1">Mot de passe :</label>
            <input type="password" id="password1" name="password1" required>

            <label for="password2">Confirmer le mot de passe :</label>
            <input type="password" id="password2" name="password2" required>

            <button type="submit" name="submit" id='g'>Inscription</button>
            <div class="sign_link">
				<br>
				<br>
				Vous avez déjà un compte?  <a href="Login.php" style="color: #3498db;">Se Connecter</a>
			</div>
        </form>
    </div>
</body>
</html>
