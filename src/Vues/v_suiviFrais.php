<?php ?>
<script type="text/javascript" src="js/suiviFrais/tabSuivi.js"></script>
<script type="text/javascript" src="js/creationXHR.js"></script>
<label for="itemsPerPage">Nombre d'éléments</label>
<select id='itemsPerPage'>
    <option value='20'>20</option>
    <option value='50'>50</option>
    <option value='100'>100</option>
    <option value='All'>All</option>
</select>
<div class="panel panel-warning">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-bookmark"></span>  Liste des fiches de frais validées
    </div>
    <table id="mxtable" class="mxtable table table-striped table-hover">
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
                            echo $ficheFV['montantFrais'] . '€';
                        };
                        ?></td><td>
                        <?php
                        if (isset($ficheFV['montantHorsFrais'])) {
                            echo $ficheFV['montantHorsFrais'] . '€';
                        };
                        ?></td>
                    <td montant="<?php
                    if (isset($ficheFV['montantvalide'])) {
                        echo $ficheFV['montantvalide'];
                    };
                    ?>"><?php
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
        <div id="pagination-container" class="text-center">
        <button onclick="prevPage()" class="btn btn-default">Précédent</button>
        <span id="currentPage" class="page-indicator">1</span>
        <button onclick="nextPage()" class="btn btn-default">Suivant</button>
    </div>
</div>
</div>
<div class="card panel panel-warning">
    <div class="card-btn">
        <button id="buttonSelectionAll" type="button" class="btn-MP btn btn-info btn-sm btn-nav">Tout sélectionner</button>
        <button class=" btn-MP btn btn-secondary btn-sm btn-nav" id="sendData">Send</button>
    </div>
    <div id="card-info" totalMontant="<?php
    if (isset($cptFicheFV)) {
        echo $cptFicheFV;
    }
    ?>" class="card-info">
        <p id="text-info">
            <?php
            if (isset($cptFicheFV)) {
                if ($cptFicheFV <= 50) {
                    echo $cptFicheFV;
                } else {
                    echo '50/' . $cptFicheFV;
                }
            }
            ?> fiches de frais.</p>
    </div>
</div>