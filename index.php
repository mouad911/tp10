<?php

function validerEtChiffrerMotDePasse($motDePasse)
{
    if (strlen($motDePasse) < 6 || strlen($motDePasse) > 10) {
        return "Erreur : Mot de passe    entre 6 et 10 caractères!.";
    }
    $salt = "ABCD123@";

    $motDePasseAvecSalt = $motDePasse . $salt;

    $motDePasseChiffre = hash('sha256', $motDePasseAvecSalt);

    $message = "Mot de passe chiffré : " . $motDePasseChiffre;
    if ($motDePasse === "MotDePasseCorrect") {
        $message = "Mot de passe correct : " . $motDePasseChiffre;
    }

    return $message;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $motDePasse = $_POST["mot_de_passe"];
    $resultat = validerEtChiffrerMotDePasse($motDePasse);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valid mot de passe</title>
</head>
<body>
    <h1>mot de passe</h1>
    <?php if (isset($resultat)) : ?>
        <p><?php echo $resultat; ?></p>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="mot_de_passe"> entrer Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <button type="submit">Accepter</button>
    </form>
</body>
</html>