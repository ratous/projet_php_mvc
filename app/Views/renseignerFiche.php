<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renseigner fiche de frais</title>
    <link rel="stylesheet" href="<?php echo base_url('../public/css/styles.css'); ?>" /> 
</head>
<body>
    
<div class="navbar">
        <a href="getdata?action=Page de navigation - Accueil">Accueil</a>
        <a href="getdata?action=consulter_fiches_de_frais">Consulter</a>
        <a href="getdata?action=renseigner_fiche_de_frais">Renseigner</a>
        <a href="getdata?action=deconnexion">Deconnexion</a>
        <span style="float:right; padding: 14px 20px; color: white;"></span>
    </div>
<img src="../public/css/logo.jfif" alt="Logo" style="float: right; height: 90px;">
<div class="frais-container">
    <h2>Renseigner fiche de frais</h2>
    <form action="postdata" method="post">
        <h3>Choisissez :</h3>
        <label for="choix">Nombre de frais à saisir :</label>
              
        <div id="frais">
            <h3>Frais forfaitaires :</h3>
            <label for="etape">Forfait Etape :</label>
            <input type="text" id="etape" name="etape" value="0">
            
            <label for="kilometres">Frais kilométriques :</label>
            <input type="text" id="kilometres" name="kilometres" value="0">
            
            <label for="nuitees">Nuitée hôtel :</label>
            <input type="text" id="nuitees" name="nuitees" value="0">
            
            <label for="repas">Repas restaurant :</label>
            <input type="text" id="repas" name="repas" value="0">
            <input type="submit" value="Valider">
            </div>
</form>
    <form action="postdata" method="post">
            <!-- Champs pour les frais hors forfait -->
            <h3>Frais hors forfait :</h3>
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>
            
            <label for="libelle">Libellé :</label>
            <input type="text" id="libelle" name="libelle" required>
            
            <label for="montant">Montant :</label>
            <input type="text" id="montant" name="montant" required>
        
        
        <input type="submit" value="Valider">
    </form>
</div>

</body>
</html>
