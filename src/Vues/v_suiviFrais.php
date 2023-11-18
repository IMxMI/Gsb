<?php ?>
<table>
    <thead>
        <tr>
            <td>Visiteurs</td>
            <td>Mois</td>
            <td>Total forfait</td>
            <td>Total hors forfait</td>
            <td>Montant validé</td>
            <td>Mise en paiement</td>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach ($testFiche as $test) {
            ?>
            <tr>
                <td><?php
                    echo $test['nom'];
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

