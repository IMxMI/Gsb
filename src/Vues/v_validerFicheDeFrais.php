<?php

/**
 * Vue Liste des frais au forfait
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 * @link      https://getbootstrap.com/docs/3.3/ Documentation Bootstrap v3
 */

// Inclure le fichier contenant les fonctions pour accéder à la base de données
require_once 'fonctions.inc.php';

// Récupérer la liste des visiteurs depuis la base de données
$lesVisiteurs = getLesVisiteurs(); //

if (isset($_POST['nomVisiteur'])) {
    // L'utilisateur a saisi un nom de visiteur
    $nomVisiteur = $_POST['nomVisiteur'];
} else {
    // Utilisation d'un visiteur par défaut si aucun nom n'a été saisi
    $nomVisiteur = $lesVisiteurs[0]['nom']; // Remplacez 0 par l'index du visiteur par défaut
}

// Récupérer la date du jour
$dateDuJour = date('Y-m-d');

// Récupérer les frais forfait du visiteur pour la date du jour
$lesFraisForfait = getLesFraisForfait($nomVisiteur, $dateDuJour); // Remplacez cette fonction par celle correspondante


?>
<div class="row">    
    <h2>Valider la fiche de frais  </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>  <label for="nomVisiteur">Nom du Visiteur</label>
                <select id="nomVisiteur" name="nomVisiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $visiteur) {
                        $nom = $visiteur['nom'];
                        $selected = ($nom === $nomVisiteur) ? 'selected' : '';
                        echo "<option value='$nom' $selected>$nom</option>";
                    }
                    ?>
                </select>
                
                
                <button class="btn btn-success" type="submit">Ajouter</button>
                <button class="btn btn-danger" type="reset">Effacer</button>
            </fieldset>
        </form>
    </div>
</div>
