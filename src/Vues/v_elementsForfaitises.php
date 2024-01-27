<div class="row mx-auto">
    <div class="col-md-12">

        <h1>Valider la fiche de frais</h1>
        <h3>Eléments forfaitisés</h3>
        <div class="row">
            <div class="col-md-4">
                <form method="post" 
                      action="index.php?uc=validerfrais&action=majFraisForfait" 
                      role="form">
                        <?php
                        foreach ($lesFraisForfait as $unFrais) {
                            $idFrais = $unFrais['idfrais'];
                            $libelle = htmlspecialchars($unFrais['libelle']);
                            $quantite = $unFrais['quantite'];
                            ?>
                            <div class="form-group">
                                <label for="idFrais"><?php echo $libelle ?></label>
                                <input type="text" id="idFrais" 
                                       name="lesFrais[<?php echo $idFrais ?>]"
                                       size="10" maxlength="5" 
                                       value="<?php echo $quantite ?>" 
                                       class="form-control col-md-auto"
                                       style="max-width: 150px;">
                            </div>
                            <?php
                        }
                        ?>
                        <button class="btn btn-success" type="submit">Corriger</button>
                        <button class="btn btn-danger" type="reset">Réinitialiser</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
