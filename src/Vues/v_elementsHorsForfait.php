<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <form id="validationForm" method="post" action="index.php?uc=validerFrais&action=majHorsFraisForfait" role="form">
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
                    <?php foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        if ($unFraisHorsForfait["refuse"] == True) {
                            ?>
                            <tr class='refuse'>
                                <td>
                                    <p type="date"><?php echo Outils\Utilitaires::dateFrancaisVersAnglais($unFraisHorsForfait['date']) ?> </p>
                                </td>
                                <td>
                                    <p type="text"> <?php echo htmlspecialchars($unFraisHorsForfait['libelle']) ?></p>
                                </td>
                                <td>
                                    <p type="text"> <?php echo $unFraisHorsForfait['montant'] ?></p>
                                </td>
                                <td>
                                    <input type="hidden" name="fraisHFId" value="<?php echo $unFraisHorsForfait['id'] ?>">
                                    <button class="btn btn-success" type="button">Corriger</button>
                                    <button class="btn btn-danger" type="button">Réinitialiser</button>
                                    <a class="btn btn-warning">Refuser</a>
                                </td>
                            </tr>
    <?php } else { ?>
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
                                    <input type="hidden" name="fraisHFId" value="<?php echo $unFraisHorsForfait['id'] ?>">
                                    <button class="btn btn-success" type="submit">Corriger</button>
                                    <button class="btn btn-danger" type="reset">Réinitialiser</button>
                                    <a class="btn btn-warning" href="index.php?uc=validerFrais&action=refuser&idFraisHF=<?php echo $unFraisHorsForfait['id'] ?>">Refuser</a>
                                </td>
                            </tr>
                        <?php } ?>
<?php } ?>
                </tbody>  
            </table>
        </form>
    </div>

    <form method="post" 
          action="index.php?uc=validerFrais&action=majNbJustificatifs"
          role="form">
        <div class="form-group">
            <label for="nbJustificatif">Nombre de justificatifs : </label>
            <input type="text" id="nbJustificatif" 
                   name="nbJustificatif"
                   size ="5cm"
                   value="<?php echo $nbJustificatifs ?>" 
                   class="form-control">
        </div>
        <button class="btn btn-success" type="submit">Valider</button>
        <button class="btn btn-danger" type="reset">Réinitialiser</button>
    </form>
</div>