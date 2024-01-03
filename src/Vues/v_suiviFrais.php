<?php ?>
<script type="text/javascript" src="js/suiviFrais/tabSuivi.js"></script>
<script type="text/javascript" src="js/creationXHR.js"></script>
<div class="panel panel-warning">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-bookmark"></span>  Liste des fiches de frais validées
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Visiteurs <span class="glyphicon glyphicon-user"></span></th>
                <th>Mois</th>
                <th>Total forfait <span class="glyphicon glyphicon-euro"></span></th>
                <th>Total hors forfait<span class="glyphicon glyphicon-euro"></span></th>
                <th>Montant validé<span class="glyphicon glyphicon-euro"></span></th>
                <th><center>Mise en paiement</center></th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ficheFraisValid as $ficheFV) {
                ?>
                <tr idLigneVisiteur="<?php echo $ficheFV['idvisiteur'] ?>" idLigneMois="<?php echo $ficheFV['mois'] ?>">
                    <td><?php
                        echo $ficheFV['nom'] . ' ';
                        echo $ficheFV['prenom'];
                        ?></td>
                    <td><?php
                        echo $ficheFV['mois'];
                        ?></td>
                    <td><?php
                        if (isset($ficheFV['montantFrais'])) {
                            echo $ficheFV['montantFrais'];
                        };
                        ?></td><td>
                        <?php
                        if (isset($ficheFV['montantHorsFrais'])) {
                            echo $ficheFV['montantHorsFrais'];
                        };
                        ?></td>
                    <td><?php
                        if (isset($ficheFV['montantvalide'])) {
                            echo $ficheFV['montantvalide'] . '€';
                        };
                        ?></td>


                    <td><center><input type="checkbox" name="checkbox" class="Checkbox" idCheckBox="<?php echo $ficheFV['idvisiteur'] . '-' . $ficheFV['mois'] ?>"></center></td>

            </tr>
        <?php };
        ?>
        </tbody>
    </table>
</div>


<div class="card panel panel-warning">
    <div class="card-btn">
        <button id="buttonSelectionAll" type="button" class="btn btn-secondary btn-sm btn-nav" style="position: relative; top: -5px; width: 150px">Tout sélectionner</button>
        <button class="btn btn-secondary btn-sm btn-nav" id="sendData" style="position: relative; width: 150px">Send</button>
    </div>
    <div class="card-info">
        <p>Aucun éléments sélectionner ...</p>
    </div>
</div>