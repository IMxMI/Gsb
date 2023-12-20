<div class="row">
    <div class="container mx-auto">
        <div class="col-md-4">
            <form action="index.php?uc=validerFrais&action=selectionnerMoisVisiteur" 
                  method="post" role="form">
                <div class="form-group">
                    <label for="unVisiteur" accesskey="v">Choisir le visiteur : </label>
                    <select id="unVisiteur" name="unVisiteur" class="form-control">
                        <option value="none">Choisir...</option>
                        <?php
                        foreach ($lesVisiteurs as $unVisiteur) {
                            $id = $unVisiteur['id'];
                            $nom = $unVisiteur['nom'];
                            $prenom = $unVisiteur['prenom'];
                            if ($id == $visiteursASelectionner) {
                                ?>
                                <option value="<?php echo $id ?>">
                                    <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            }
                            ?>    
                        </select>
                    </div>

            </div>

            <div class="from-group">
                <label for="leMois" accesskey="n">Mois : </label>
                <select id="leMois" name="leMois" class="form-control">
                    <option value="none">Choisir...</option>
                    <?php
                    $lesMois = $pdo->getLesMoisDisponibles($id);
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        ?>
                        <option value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                        <?php
                    }
                    ?>    

            </select>


        </div>
    </div>

    <div class="col-md-4">
        <br>
        <input id="ok" type="submit" value="Valider" class="btn btn-success" 
               role="button">
        <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
               role="button">
        </form>
    </div>
</div>
</div>