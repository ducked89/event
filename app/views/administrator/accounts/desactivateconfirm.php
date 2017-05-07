<div class="col-md-12">
    <h2>Utilisateurs</h2>
    <small>Desactivation de tous les comptes utilisateurs</small>


</div>
<div class="clear50"></div>

<div class="row">
    <div class="col-md-8">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="clear20"></div>

                <div class="ibox-content">
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/accounts/desactivate/" method="POST"  >
                        <input type="hidden" id="opt" name="opt" value="0>">

						<div class="alert alert-danger">Etes-vous sur de bien vouloir effectuer cette operation ?</div>
		                <div class="clear20"></div>
                        <div class="form-group">
                           <button id="editpassbutton" name="editpassbutton" class="btn btn-primary floatL mgR20">Confirmer</button>
                           <a href="<?php echo SITE;?>admin/accounts/" class="btn btn-danger floatR">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
