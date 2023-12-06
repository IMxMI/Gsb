<?php ?>
<script type="text/javascript" src="js/suiviFrais/tabSuivi.js"></script>
<div class="panel panel-warning">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-bookmark"></span>  Liste des fiches de frais validées
        <button id="buttonTest" type="button" class="btn btn-secondary btn-sm btn-nav" style="float:inline-end; position: relative; top: -5px; width: 150px">Tout sélectionner
        </button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Visiteurs</th>
                <th>Mois</th>
                <th>Total forfait</th>
                <th>Total hors forfait</th>
                <th>Montant validé</th>
                <th><center>Mise en paiement</center></th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($ficheFraisValid as $ficheFV) {
                ?>
                <tr idLigne="<?php echo $ficheFV['idvisiteur'] . '-' . $ficheFV['mois'] ?>">
                    <td><?php
                        echo $ficheFV['nom'] . ' ';
                        echo $ficheFV['prenom'];
                        ?></td>
                    <td><?php
                        echo $ficheFV['mois'];
                        ?></td>
                    <td><?php
                        if (isset($ficheFV['montantFrais'])) {
                            echo $ficheFV['montantFrais'] . "€";
                        };
                        ?></td>
                    <td>
                        <?php
                        if (isset($ficheFV['montantHorsFrais'])) {
                            echo $ficheFV['montantHorsFrais'] . "€";
                        };
                        ?></td>
                    <td><?php
                        if (isset($ficheFV['montantvalide'])) {
                            echo $ficheFV['montantvalide'] . '€';
                        };
                        ?></td>


                    <td><center><input type="checkbox" name="checkbox" idCheckBox="<?php echo $ficheFV['idvisiteur'] . '-' . $ficheFV['mois'] ?>"></center></td>

            </tr>
        <?php };
        ?>
        </tbody>
    </table>
</div>