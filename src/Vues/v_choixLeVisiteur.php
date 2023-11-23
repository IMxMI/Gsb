<?php ?>
<html>

    <br>
    <div class="col-md-4">
        <form action="index.php?uc=etatFrais&action=voirEtatFrais" 
              method="post" role="form">
            <div class="form-group">
                <label for="choixVisiteur" accesskey="v">Choisir le visiteur : </label>
                <select id="choixVisiteur" name="choixVisiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteursASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    </select>
            </div>
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=etatFrais&action=voirEtatFrais" 
              method="post" role="from">
            <div class="from-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
    </div>

</select>

</div>


<br>
<h3>Valider la fiche de frais</h3>
<h4>Eléments forfaitisés</h4>
<form action="" method="get">
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="inputForfaitStage">Forfait Etape</label>
            <input type="text" name="forfaitEtape" class="form-control" id="inputForfaitStage" 
                   value="<?= $infoFraisForfait[0]['quantite'] ?? '0' ?>" 
                   placeholder="<?= $infoFraisForfait[0]['quantite'] ?? '0' ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="inputFraisKm">Frais Kilométrique</label>
            <input type="text" name="forfaitEtape" class="form-control" id="inputFraisKm" 
                   value="<?= $infoFraisForfait[1]['quantite'] ?? '0' ?>"
                   placeholder="<?= $infoFraisForfait[1]['quantite'] ?? '0' ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="inputinputNuitHotel">Nuitée Hôtel</label>
            <input type="text" name="nuitHotel" class="form-control" id="inputinputNuitHotel" 
                   value="<?= $infoFraisForfait[2]['quantite'] ?? '0' ?>"
                   placeholder="<?= $infoFraisForfait[2]['quantite'] ?? '0' ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="inputRepasResto">Repas Restaurant</label>
            <input type="text" name="repasResto" class="form-control" id="inputRepasResto" 
                   value="<?= $infoFraisForfait[3]['quantite'] ?? '0' ?>"
                   placeholder="<?= $infoFraisForfait[3]['quantite'] ?? '0' ?>">
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success">Corriger</button>
<button type="reset" class="btn btn-danger">Réinitialiser</button>

</form>

<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
                <tr>
                    <th class="date"></th>
                    <th class="libelle"></th>  
                    <th class="montant"></th>  
                    <th <button type="submit" class="btn btn-success">Corriger</button>
                        <button type="reset" class="btn btn-danger">Réinitialiser</button>
                    </th> 
                </tr>
                <tr>
                    <th class="date"></th>
                    <th class="libelle"></th>  
                    <th class="montant"></th>  
                    <th <button type="submit" class="btn btn-success">Corriger</button>
                        <button type="reset" class="btn btn-danger">Réinitialiser</button>
                    </th> 
                </tr>


            </thead>  
            <tbody>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $id = $unFraisHorsForfait['id'];
                    ?>           
                    <tr>
                        <td> <?php echo $date ?></td>
                        <td> <?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                        <td>
                            <a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                               onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">
                                Supprimer ce frais
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>  
        </table>
    </div>
</div>





