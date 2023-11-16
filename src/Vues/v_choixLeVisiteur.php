<?php ?>
<html>

    <br>
    <div class="col-md-4">
        <form action="index.php?uc=etatFrais&action=voirEtatFrais" 
              method="post" role="form">
            <div class="form-group">
                <label for="choixVisiteur" accesskey="v">Choisir le visiteur : </label>
                <select id="choixVisiteur" name="choixVisiteur" class="form-control"></select>

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

            <br>
            <h2>Valider la fiche de frais</h2>
            <h3>Eléments forfaitisés</h3>
            </html>

    </div>
   <input id="ok" type="submit" value="Corriger" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Rénitialiser" class="btn btn-danger" 
                   role="button">

</form>
        
        
        
        


