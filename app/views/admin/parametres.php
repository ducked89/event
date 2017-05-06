<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Parametres</h2>
        <small>Definir les parametres du système</small>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-success btn-sm floatR "><i class="fa fa-home mgR10"></i>Dashboard</a>
	</div>
</div>

<div class="clear50"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
	
			<!-- Parametres compte admin -->
			<div class="col-lg-4">
			    <div class="ibox ibox-info">
			        <div class="ibox-header"><h3><i class="fa fa-user mgR10"></i>Compte</h3></div>
			        <div class="ibox-content">
			            <p class="small">Parametres du compte administrateur</p>
			            <div class="clear20"></div>
			            <a href="<?= SITE;?>admin/parametres/login/" class="btn btn-info">Editer nom du compte</a>
			            <div class="clear20"></div>
			            <a href="<?= SITE;?>admin/parametres/password/"><i class="fa fa-lock mgR10"></i>Changer mot de passe</a>
			            <div class="clear20"></div>
			            <a href="<?= SITE;?>admin/parametres/config/"><i class="fa fa-envelope mgR10"></i>Configuration messagerie</a>
			        </div>
			    </div>
			</div>

			<!-- Parametres du système-->
			<div class="col-lg-4">
			    <div class="ibox ibox-info">
			        <div class="ibox-header"><h3><i class="fa fa-cogs mgR10"></i>Système</h3></div>
			        <div class="ibox-content">
			            <p class="small">Parametres generaux du système</p>
			            <div class="clear20"></div>
			            <ul class="parametres">
							<li><a href="<?= SITE;?>admin/parametres/info/"><i class="fa fa-info-circle mgR10"></i>Informations générales</a></li>

							<li><a href="<?= SITE;?>admin/parametres/connexion/"><i class="fa fa-arrow-circle-o-right mgR10"></i>Changer le login</a></li>

				            <li><a href="<?= SITE;?>admin/parametres/accountsoff/"><i class="fa fa-group mgR10"></i>Désactiver tous les comptes</a></li>
				            
				            <li><a href="<?= SITE;?>admin/parametres/sendmessages/"><i class="fa fa-envelope-open-o mgR10"></i>Désactiver la messagerie</a></li>
			        </div>
			    </div>
			</div>

			<!-- Parametres d'interface utilisateur -->
			<div class="col-lg-4">
			    <div class="ibox ibox-info">
			        <div class="ibox-header"><h3><i class="fa fa-desktop mgR10"></i>Interface utilisateur</h3></div>
			        <div class="ibox-content">
			            <p class="small">Parametres des éléments graphiques du système</p>
			            <div class="clear20"></div>
			            <ul class="parametres">
							<li><a href="<?= SITE;?>admin/parametres/banner/"><i class="fa fa-picture-o mgR10"></i>Changer la banniere d'accueil</a></li>
				            <li><a href="<?= SITE;?>admin/parametres/logo/"><i class="fa fa-file-picture-o mgR10"></i>Changer le logo</a></li>
				        </ul>
			        </div>
			    </div>
			</div>

 	</div>


</div>