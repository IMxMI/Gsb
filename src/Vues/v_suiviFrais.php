<?php ?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td scope="col">Visiteurs</td>
            <td scope="col">Mois</td>
            <td scope="col">Total forfait</td>
            <td scope="col">Total hors forfait</td>
            <td scope="col">Montant validé</td>
            <td scope="col">Mise en paiement</td>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($testFiche as $test) {
            ?>
            <tr>
                <td><?php
                    echo $test['nom']. ' ';
                    echo $test['prenom'];
                    ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php };
        ?>
    </tbody>
</table>

