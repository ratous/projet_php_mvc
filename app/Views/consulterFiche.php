<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>ConsultationFichesdeFrais</title>
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
    <h1>Consultation fiche de frais</h1>

    <form method="POST" action="postdata">
        <select id="mois" name="mois">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
        <input type="submit" name="Consulter" value="Consulter">
    </form>

    <div class="principale">

        <!-- Table pour les frais forfaitaires -->
        <h4>Les frais forfait du mois</h4>
        <table border='1'>
            <tr>
                <th>ID du visiteur</th>
                <th>Mois</th>
                <th>ID Frais</th>
                <th>Quantité</th>
            </tr>
            <?php if (!empty($fiches)): ?>
                <?php foreach ($fiches as $fraisForfait): ?>
                    <tr>
                        <td><?php echo $fraisForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisForfait->mois; ?></td>
                        <td><?php echo $fraisForfait->idFraisForfait; ?></td>
                        <td><?php echo $fraisForfait->quantite; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Aucun frais forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Table pour les frais hors forfait -->
        <h4>Les frais hors forfait du mois</h4>
        <table border='1'>
            <tr>
                <th>ID Fiche</th>
                <th>ID Visiteur</th>
                <th>Mois</th>
                <th>Description</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
            <?php if (!empty($donnees1)): ?>
                <?php foreach ($donnees1 as $fraisHorsForfait): ?>
                    <tr>
                        <td><?php echo $fraisHorsForfait->id; ?></td>
                        <td><?php echo $fraisHorsForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisHorsForfait->mois; ?></td>
                        <td><?php echo $fraisHorsForfait->libelle ?></td>
                        <td><?php echo $fraisHorsForfait->date; ?></td>
                        <td><?php echo $fraisHorsForfait->montant; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun frais hors forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
	</table>

       
<!--    <style>
        body {
            background-image: url('../public/css/logo.jfif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Cette propriété permet de fixer l'image en arrière-plan */
        }
     </style>
--> 


</body>
</html>
