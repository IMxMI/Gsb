
<h1>Valider la fiche de frais</h1>
<h3>Eléments forfaitisés</h3>
<div class="row">
    <div class="form-group col-sm-3">
        <label for="inputForfaitStage">Forfait Etape</label>
        <input type="text" name="forfaitEtape" class="form-control" 
               id="inputForfaitStage" 
               value="<?= $infoFraisForfait[0]['quantite'] ?? '0' ?>" 
               placeholder="<?= $infoFraisForfait[0]['quantite'] ?? '0' ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label for="inputFraisKm">Frais Kilométrique</label>
        <input type="text" name="forfaitEtape" class="form-control" id="inputFraisKm" 
               value="<?= $infoFraisForfait[1]['quantite'] ?? '0' ?>"
               placeholder="<?= $infoFraisForfait[1]['quantite'] ?? '0' ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label for="inputinputNuitHotel">Nuitée Hôtel</label>
        <input type="text" name="nuitHotel" class="form-control" id="inputinputNuitHotel" 
               value="<?= $infoFraisForfait[2]['quantite'] ?? '0' ?>"
               placeholder="<?= $infoFraisForfait[2]['quantite'] ?? '0' ?>">
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-3">
        <label for="inputRepasResto">Repas Restaurant</label>
        <input type="text" name="repasResto" class="form-control" id="inputRepasResto" 
               value="<?= $infoFraisForfait[3]['quantite'] ?? '0' ?>"
               placeholder="<?= $infoFraisForfait[3]['quantite'] ?? '0' ?>">
    </div>
</div>

</div>
<button type="submit" class="btn btn-success">Corriger</button>
<button type="reset" class="btn btn-danger">Réinitialiser</button>

</form>

<hr>
<div class="row">
    <div class="panel-info-comptable">
        <div class="panel-heading panel-heading-comptable panel-heading-elementHorsForfait">Descriptif des éléments hors forfait</div>
        <form>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lesFraisHorsForfait as $unFraisHorsForfait) { ?>
                        <tr>
                            <td>
                                <input type="date" name="lesFraisHF[<?php echo $unFraisHorsForfait['id'] ?>][date]" size="10" value="<?php echo Outils\Utilitaires::dateFrancaisVersAnglais($unFraisHorsForfait['date']) ?>" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="lesFraisHF[<?php echo $unFraisHorsForfait['id'] ?>][libelle]" size="10" value="<?php echo htmlspecialchars($unFraisHorsForfait['libelle']) ?>" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="lesFraisHF[<?php echo $unFraisHorsForfait['id'] ?>][montant]" size="10" value="<?php echo $unFraisHorsForfait['montant'] ?>" class="form-control">
                            </td>
                            <td>
                                <input type="hidden" name="lesFraisHF[<?php echo $unFraisHorsForfait['id'] ?>][id]" value="<?php echo $unFraisHorsForfait['id'] ?>">
                                <button class="btn btn-success" type="submit">Corriger</button>
                                <button class="btn btn-warning" type="submit">Refuser</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>  
            </table>
        </form>
    </div>


    <br>
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="inputForfaitStage">Nombre de justificatifs : </label>
            <input type="text" name="Nombredejustificatifs" class="form-control" id="inputForfaitStage"                  
                   </div>
        </div>
        <br>
        <button class="btn btn-success" type="submit">Valider</button>
        <button class="btn btn-danger" type="reset">Rénisialiser</button>



    </div>
</div>