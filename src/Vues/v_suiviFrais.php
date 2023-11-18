<?php ?>
<div class="panel panel-warning">
    <div class="panel-heading">Liste des fiches de frais validées</div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Visiteurs</th>
                <th>Mois</th>
                <th>Total forfait</th>
                <th>Total hors forfait</th>
                <th>Montant validé</th>
                <th>Mise en paiement</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($testFiche as $test) {
                ?>
                <tr id="<?php echo $test['idvisiteur'] . '-' . $test['mois'] ?>">
                    <td><?php
                        echo $test['nom'] . ' ';
                        echo $test['prenom'];
                        ?></td>
                    <td><?php
                        echo $test['mois'];
                        ?></td>
                    <td>A REMPLIR</td>
                    <td>A REMPLIR</td>
                    <td><?php
                        echo $test['montantvalide'] . '€';
                        ?></td>
                    <td></td>
                </tr>
            <?php };
            ?>
        </tbody>
    </table>
</div>