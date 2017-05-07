<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Paramètres</h2>
        <small>Définir les paramètres du système</small>
        <a href="<?php echo SITE;?>administrator/parametres/" class="btn btn-success btn-sm floatR "><i class="fa fa-cogs mgR10"></i>Paramètres</a>
    </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">


    <div class="row">
        <div class="col-md-8">
            <div class="col-lg-offset-1 col-lg-10">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Modifier le nom de compte Admin</h3>
                </div>
                <div class="ibox-content padding50">
                    <div class="result">

                        <?php

                            if (isset($datas['result'])) {

                                switch ($datas['result']) {
                                    case 'NOTSAVED':
                                       echo'<div class="alert alert-danger">Impossible d\'éffectuer cette opération. Contactez votre administratuer !.</div>';
                                        break;

                                    case 'EMPTY':
                                       echo'<div class="alert alert-warning">Tous les champs sont obligatoires!.</div>';
                                        break;

                                    case 'SAME':
                                       echo'<div class="alert alert-warning">Le nouveau nom de compte doit être différents de l\'ancien !.</div>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            }
                        ?>

                    </div>
                        <div class="clear20"></div>
                        <form class="form-horizontal" action="<?php echo SITE;?>administrator/parametres/login/" method="POST"  >
                            <input type="hidden" id="cuLogin" name="cuLogin">
                            <div class="form-group"><label class="col-lg-4 control-label">Nouveau nom d'utilisateur</label>
                                <div class="col-lg-8"><input  id="oldpass" name="login" type="text" required placeholder="Nouveau login" class="form-control"></div>
                            </div>
                            <div class="clear20"></div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8 pull-right">
                                    <button name="createLogin"  class="btn btn-primary mgR20">Modifier</button>
                                    <a href="<?php echo SITE;?>administrator/parametres/" class="btn btn-danger floatR">Annuler</a>
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
