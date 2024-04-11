<br><!-- comment -->
<br>

<div class="row">
    <div class="col-md-8">

        <div class="panel panel-info">
            <div class="panel-heading">Descriptif des éléments hors forfait</div>
            <form id="validationForm" method="post" action="index.php?uc=validerFrais&action=majHorsFraisForfait" role="form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="date">Date</th>
                            <th class="libelle">Libellé</th>  
                            <th class="montant">Montant</th>  
                            <th class="action">&nbsp;</th> 
                        </tr>
                    </thead>  
                    <tbody>
                        <?php
                        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                            $libelle = $unFraisHorsForfait['libelle'];
                            // Vérifier si la clé 'refuse' existe dans le tableau $unFraisHorsForfait
                            if (isset($unFraisHorsForfait['refuse']) && $unFraisHorsForfait['refuse'] == 1) {
                                // Si la clé 'refuse' existe et vaut 1, ajoutez "REFUSE" au début du libellé
                                $libelle = "REFUSE - " . $libelle;
                            }
                            ?>
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
                                    <button class="btn btn-danger" type="reset">Réinitialiser</button>
                                    <button class="btn btn-warning" type="button" onclick="refuser('<?php echo $unFraisHorsForfait['id'] ?>')">Refuser</button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>  
                </table>
            </form>
        </div>
    </div>
    <div class="col-md-12">

        <br>
        <br>

        <form method="post" 
              action="index.php?uc=validerFrais&action=majNbJustificatifs" 
              role="form">
            <div class="form-group">
                <label for="nbJustificatif">Nombre de justificatifs : </label>
                <input type="text" id="nbJustificatif" 
                       name="nbJustificatif"
                       size ="5cm"
                       value="<?php echo $nbJustificatifs ?>" 
                       class="form-control col-md-auto"
                       style="max-width: 150px;">
            </div>
            <button class="btn btn-success" type="submit">Valider</button>
            <button class="btn btn-danger" type="reset">Réinitialiser</button>
        </form>
    </div>
</div>
</div>
    <script>
        function refuser(idFrais) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'index.php?uc=validerFrais&action=refuser';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'idFraisRefuse';
            input.value = idFrais;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>