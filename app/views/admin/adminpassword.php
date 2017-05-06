<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Paramètres</h2>
        <small>Définir les paramètres du système</small>
        <a href="<?php echo SITE;?>admin/parametres/" class="btn btn-success btn-sm floatR "><i class="fa fa-cogs mgR10"></i>Paramètres</a>
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
                        <h3>Modifier mot de passe Admin</h3>
                    </div>
                    <div class="ibox-content padding50">
                        <div class="result">
        
                            <?php

                                if (isset($datas['result'])) {

                                    switch ($datas['result']) {
                                        case 'NOTSAVED':
                                           echo'<div class="alert alert-danger">Impossible d\'éffectuer cette opération. Contactez votre administratuer !.</div>';
                                            break;

                                        case 'NOTMATCH':
                                           echo'<div class="alert alert-warning">Les deux nouveaux mot de passe ne correspondent pas !.</div>';
                                            break;

                                        case 'EMPTY':
                                           echo'<div class="alert alert-warning">Tous les champs sont obligatoires!.</div>';
                                            break;

                                        case 'SAME':
                                           echo'<div class="alert alert-warning">Le nouveau mot de passe doit être différents de l\'ancien !.</div>';
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                }
                            ?>

                        </div>
                        <div class="clear20"></div>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/parametres/password/" method="POST"  >
                            <input type="hidden" id="cuPassword" name="cuPassword">
                            <div class="form-group"><label class="col-lg-4 control-label">Ancien mot de passe</label>
                                <div class="col-lg-8"><input  id="oldpass" name="oldpass" type="password" required placeholder="Ancien mot de passe" class="form-control"></div>
                            </div>
                            <div class="clear20"></div>
                            <div class="form-group"><label class="col-lg-4 control-label">Nouveau mot de passe</label>
                                <div class="col-lg-8"><input  id="password1" name="password1" type="password" required  placeholder="Nouveau mot de passe" class="form-control"></div>
                            </div>

                            <div class="form-group"><label class="col-lg-4 control-label">Confirmation</label>
                                <div class="col-lg-8"><input id="password2"  name="password2"  type="password" required placeholder="Confirmer nouveau mot de passe" class="form-control" ></div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8 pull-right">
                                    <button name="createPassword" class="btn btn-primary mgR20">Modifier</button>
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