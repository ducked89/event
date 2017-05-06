<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Parametres</h2>
        <small>Definir les parametres du système</small>
        <a href="<?php echo SITE;?>admin/parametres/" class="btn btn-success btn-sm floatR "><i class="fa fa-cogs mgR10"></i>Parametres</a>
    </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    <div class="row">
        <div class="col-md-10">
            <div class="col-lg-offset-1 col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Definir un présentation de la page de connexion</h3>
                    </div>
                    <div class="ibox-content padding50">
                        <div class="clear20"></div>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/parametres/connexion/" method="POST"  >
                            <input type="hidden" id="cuPassword" name="cuPassword">
                            <div class="form-group col-lg-4">
                                <img src="<?= SITE;?>public/images/login_boxed.png" alt="Connexion 1"><br/>
                                 <input type="radio" name="idlogin" value="0"> Mode compact<br>
                            </div>

                            <div class="form-group col-lg-4 pull-right">
                                <img src="<?= SITE;?>public/images/login_wide.png" alt="Connexion 2"><br/>
                                 <input type="radio" name="idlogin" value="1"> Mode moderne<br>
                                
                            </div>

                            <div class="clear20"></div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8 pull-center">
                                    <button name="createConnexion" class="btn btn-primary mgR20">Modifier</button>
                                    <a href="<?php echo SITE;?>admin/parametres/" class="btn btn-danger floatR">Annuler</a>
                                </div>
                            </div>
                        </form>
                        <div class="clear20"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


</div>