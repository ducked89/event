<div class="col-md-7">
    <h2>Utilisateurs</h2>
    <small>Les comptes permettents aux utilisateurs de se connecter au système.</small>           
</div>
<div class="clear20"></div>
<div class="col-lg-12">
    <div class="ibox float-e-margins">

        <div class="ibox-title">
	    <div class="clear20"></div>
            <h3>Création d'un compte</h3>
        </div>
        <div class="ibox-content col-lg-7">
             <?php 
             	if(count($datas['employes'])>0)
             	{
	        ?>
	        <form class="form-horizontal" action="<?php echo SITE;?>admin/accounts/add/" method="POST"  >
                <div class="clear20"></div>
                 <?php

                        if(isset($datas['error']['error']))
                        echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez vérifier vos saisies.</div>
                            <div class='clear50'></div>";

                        if(isset($datas['error']['existe']))
                        echo "<div class='alert alert-info'>Il existe déjà un compte utilisateur avec le même login.</div>
                            <div class='clear50'></div>";                            

                    ?>
                
                <div class="form-group"><label class="col-lg-2 control-label">Login</label>
                    <div class="col-lg-10"><input  name="login" placeholder="Nom utilisateur" required class="form-control" type="text"> </div>
                </div>
                

                <div class="form-group"><label class="col-lg-2 control-label">Mot de passe</label>
                    <div class="col-lg-10"><input  name="password1" placeholder="Mot de passe" required class="form-control" type="password"></div>
                </div>
                <div class="form-group"><label class="col-lg-2 control-label">Confirmation</label>
                    <div class="col-lg-10"><input name="password2"  placeholder="Confirmation de mot de passe"  required class="form-control" type="password"></div>
                </div>
               

				<div class="clear50"></div>

               <div class="form-group"><label class="col-sm-2 control-label">Employé</label>
	                <div class="col-sm-10"><select class="form-control m-b" name="account">
	                    <?php
	                    	foreach ($datas['employes'] as $mEmploye) {
	                    		echo '<option value="'.$mEmploye->id.'">'.$mEmploye->firstname.', '.$mEmploye->lastname.'</option>';
	                    	}
	                    	?>
	                </select>
	                </div>
	            </div>

				<div class="clear50"></div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button name ="createUser" class="btn btn-w-m btn-success mgR20" type="submit">Créer</button>

                         <a href="<?= SITE;?>admin/accounts/"><button type="button" class="btn btn-w-m btn-danger">Annuler</button></a>
                    </div>
                </div>
            </form>
            <?php  }

            else {
					echo "<div class='alert alert-danger'>Impossible de créer d'autres comptes puisque tous les employés disposent déjà d'un compte utilisateur. </div>
					<div class='clear50'></div>
					<a href='".SITE."admin/accounts/'><button type='button' class='btn btn-w-m btn-success floatR'>Revenir</button></a>";
            }
            	?>
        </div>
    </div>
</div>

