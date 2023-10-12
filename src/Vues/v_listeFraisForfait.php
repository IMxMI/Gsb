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
//permet d'importer la classe 'visiteur'
require_once ('modele/Visiteur.php');
//Récupération du visiteur connecté
$visiteur = Visiteur::getVisiteurConnecte();

//vérification de la date du jour
$aujourdhui = date('Y-m-d');
$numMois = date('m');
$numAnnee = date('Y');
?>
<div class="row"> 
    ><!-- Si le visiteur est connecté en tant que comptable, le message "Valider la fiche de frais" est affiché. -->
    <?php if ($visiteur['statut'] == 'comptable') { ?>
    <-<!-- Si le visiteur est connecté en tant que visiteur, le message "Renseigner ma fiche de frais du mois" est affiché.
 -->
    <h2>Valider la fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?>
    </h2>
    <?php } else { ?>
        <h2>Renseigner ma fiche de frais du mois 
            <?php echo $numMois . '-' . $numAnnee ?>
        </h2>
<?php ?>
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
    $quantite = $unFrais['quantite'];
    ?>
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
                ?>
                <?php if ($aujourdhui == $numMois . '-' . $numAnnee) { ?>
                    <input type="hidden" name="dateFrais" value="<?php echo $aujourdhui ?>">
                    <input type="hidden" name="mois" value="<?php echo $numMois ?>">
                <?php } else { ?>
                    <input type="date" name="dateFrais" required>
                    <input type="text" name="mois" required>
                <?php } ?>
        //permet de pré-remplir le champs 'nom' avec le nom visiteur
                <input type='hidden' name="nom" value="<?php echo $visiteur['nom'] ?>">
                <button class="btn btn-success" type="submit">Ajouter</button>
                <button class="btn btn-danger" type="reset">Effacer</button>
            </fieldset>
        </form>
    </div>
</div>
