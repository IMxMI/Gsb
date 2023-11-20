<?php ?>
<div class="panel panel-warning">
    <div class="panel-heading">Liste des fiches de frais validées<button type="button" class="btn btn-secondary" style="float:inline-end">Secondary</button></div>
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
            foreach ($testFiche as $test) {
                ?>
                <tr idLigne="<?php echo $test['idvisiteur'] . '-' . $test['mois'] ?>">
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
                    <td><center><input type="checkbox" idCheckBox="<?php echo $test['idvisiteur'] . '-' . $test['mois'] ?>"></center></td>
                </tr>
            <?php };
            ?>
        </tbody>
    </table>
</div>