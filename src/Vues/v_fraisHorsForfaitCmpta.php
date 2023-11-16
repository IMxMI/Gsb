<?php ?>
<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
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
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td>
                </tr>
                <tr>
                    <td><input type="text" placeholder=""></td>
                    <td><input type="text" placeholder=""></td>
                    <td><input type="text" placeholder=""></td>
                    <td><button class="btn btn-success" type="submit">Corriger</button>
                        <button class="btn btn-danger" type="reset">Rénitialiser</button></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder=""></td>
                    <td><input type="text" placeholder=""></td>
                    <td><input type="text" placeholder=""></td>
                    <td><button class="btn btn-success" type="submit">Corriger</button>
                        <button class="btn btn-danger" type="reset">Rénitialiser</button></td>
                </tr>
                <?php
                ?>
            </tbody>  
        </table>
    </div>
</div>
<br>
    <div class="col-md-4">
        <form action="index.php?uc=etatFrais&action=voirEtatFrais" 
              method="post" role="form">
            <div class="form-group">
                <label for="choixVisiteur" accesskey="v">Nombre de justificatifs : </label>
               <tr>
                   <td><input type="text" placeholder=""></td></tr>
            </div>
    </div>

<button class="btn btn-success" type="submit">Valider</button>
<button class="btn btn-danger" type="reset">Rénitialiser</button>
</form>
</div>
</div>