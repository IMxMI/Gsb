<?php

/**
 * Vue État de Frais
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

?>
        <link href="./styles/bootstrap/bootstrap-comptable.css" rel="stylesheet" type="text/css"/>
<hr>
<div class="row">
    
    <!-- RAJOUTER OPTION DE CHOISIR TOUS LES VISITEURS ET TOUS LES MOIS-->
    
    <div class="col-md-4">
        <form action="index.php?uc=validerFrais&action=afficheFrais"
              method="post" role="form">
            <div class="choix">
                <label for="leVisiteur" accesskey="n">Choisir le Visiteur : </label>
                <select id="leVisiteur" name="leVisiteur" class="form-control">
                    <option value="none">Choisir...</option>
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                    }
                    ?>    

                </select>
            </div>


            <div class="choix">
                <label for="leMois" accesskey="n">Mois : </label>
                <select id="leMois" name="leMois" class="form-control">
                    <option value="none">Choisir...</option>
                        <?php
                    $lesMois = $pdo->getLesMoisDisponibles($id);
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    ?>    

                </select>
            </div>
            
            <input id="ok" type="submit" value="Valider" class="btn btn-success"
                   role="button">
        </form>
    </div>
</div>