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
            <div class="col-lg-offset-1 col-lg-10">
                <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Parametres sur serveur de messagerie</h3>
                </div>
                <div class="ibox-content padding50 col-lg-12">
                    <div class="col-lg-8 center">
                        <div class="result ">
        
                            <?php
                                $data=$datas['mdatas'][0];
                                if (isset($datas['result'])) {

                                    switch ($datas['result']) {
                                        case 'NOTSAVED':
                                           echo'<div class="alert alert-danger">Impossible d\'effectuer cette operation. Contactez votre administratuer !.</div>';
                                            break;

                                        case 'EMPTY':
                                           echo'<div class="alert alert-warning">Tous les champs sont obligatoires!.</div>';
                                            break;

                                        case 'SAME':
                                           echo'<div class="alert alert-warning">Le nouveau nom de compte doit etre differents de l\'ancien !.</div>';
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                }
                            ?>

                        </div>
                            <div class="clear20"></div>
                            <form class="form-horizontal" action="<?php echo SITE;?>admin/parametres/config/" method="POST"  >
                                <input type="hidden" id="cuLogin" name="cuLogin">
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Server Host</label>
                                    <div class="col-lg-8"><input value="<?=(isset($data->host))?$data->host:"" ;?>"   name="host" type="text" required class="form-control"></div>
                                </div>
                                <div class="clear20"></div>

                                 <div class="form-group">
                                    <label class="col-lg-4 control-label">Email</label>
                                    <div class="col-lg-8"><input value="<?=(isset($data->username))?$data->username:"" ;?>"  name="username" type="text" required class="form-control"></div>
                                </div>
                                <div class="clear20"></div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Password</label>
                                    <div class="col-lg-8"><input name="password" type="text" required class="form-control"></div>
                                </div>
                                <div class="clear20"></div>

                                <div class="form-group">
                                    <label class="col-lg-4 control-label">SMTP Secure</label>
                                    <div class="col-lg-8"><input value="<?=(isset($data->smtpsecure))?$data->smtpsecure:"" ;?>"  name="smtpsecure" type="text" required class="form-control"></div>
                                </div>
                                <div class="clear20"></div>

                                 <div class="form-group">
                                    <label class="col-lg-4 control-label">Server Port</label>
                                    <div class="col-lg-8"><input value="<?=(isset($data->port))?$data->port:"" ;?>"  name="port" type="text" required class="form-control"></div>
                                </div>
                                <div class="clear20"></div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8 pull-right">
                                        <button name="saveConfig"  class="btn btn-primary mgR20">Enregistrer</button>
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


</div>