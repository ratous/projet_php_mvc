<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="<?php echo base_url('/public/css/stconnexion.css'); ?>" />
</head>
<body>
  <div class="navbar">
    <a href="getdata?index">Accueil</a>
  </div>

  <div class="login-container">
        <h2>Connexion</h2>
        <form action="postdata" method="post">
            <label for="login">Nom d'utilisateur :</label>
            <input type="text" id="login" name="login" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required>

            <input type="submit" name="kaka" value="Se connecter">
        </form>

        <form action="mailto:aidegsb@gsb.com" method="post" enctype="text/plain">
            <input type="submit" value="Demander de l'aide">
        </form>
  </div>
</body>
</html>