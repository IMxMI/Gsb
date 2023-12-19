<?php ?>
<script type="text/javascript" src="js/suiviFrais/tabSuivi.js"></script>
<script type="text/javascript" src="js/creationXHR.js"></script>
<button id="sendData"> SEND </button>
<div class="panel panel-warning">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-bookmark"></span>  Liste des fiches de frais validées
        <button id="buttonTest" type="button" class="btn btn-secondary btn-sm btn-nav" style="float:inline-end; position: relative; top: -5px; width: 150px">Tout sélectionner
        </button>
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