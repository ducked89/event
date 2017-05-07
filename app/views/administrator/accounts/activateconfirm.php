<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Utilisateurs</h2>
        <small>Activation de tous les comptes utilisateurs</small>
    </div>
</div>


<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-md-8">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="clear20"></div>

                <div class="ibox-content">
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/accounts/activate/" method="POST"  >
                        <input type="hidden" id="opt" name="opt" value="1>">

						<div class="alert alert-danger">Etes-vous sûr de bien vouloir éffectuer cette opération ?</div>
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
