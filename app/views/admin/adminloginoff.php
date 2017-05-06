<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Paramètres</h2>
        <small>Définir les paramètres du système</small>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-success btn-sm floatR "><i class="fa fa-home mgR10"></i>Dashboard</a>
    </div>
</div>
<div class="clear20"></div>

<div class="row">
    <div class="col-md-8">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="clear20"></div>
             
                <div class="ibox-content">
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/parametres/loginoff/" method="POST"  >
                        <input type="hidden" id="opt" name="opt" value="0>">                       
						
						<div class="alert alert-danger">Etes-vous sûr de bien vouloir éffectuer cette opération de fermeture de la page de connexion pour les utilisateurs?</div>
		                <div class="clear20"></div>
                        <div class="form-group">
                           <button name="cuLoginOff" class="btn btn-primary floatL mgR20">Confirmer</button>
                           <a href="<?php echo SITE;?>admin/parametres/" class="btn btn-danger floatR">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
