
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Profil</h2>
        <small>Affichage des informations générales sur mon profil.</small>
        <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/profile/edit/?idu=<?= $myInfo->iduser ?>">Modifier mon profil</a>
    </div>
</div>
<div class="clear20"></div>

<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Modifier mot de passe</h5>
            </div>
            <div class="ibox-content">

                    <?php
                        if (isset($datas['result'])) {

                            switch ($datas['result']) {
                                case 'saved':
                                   echo'<div class="alert alert-success">Mot de passe modifié avec succès !. </div>';
                                    break;

                                case 'notmatch':
                                   echo'<div class="alert alert-danger">Les deux nouveaux mot de passe ne correspondent pas !.</div>';
                                    break;

                                case 'update':
                                   echo'<div class="alert alert-danger">Ce mot de passe n\'est plus valide !.</div>';
                                    break;

                                case 'notsaved':
                                   echo'<div class="alert alert-warning">Oups ! Une erreur s\'est produite, veuillez re-essayer!.</div>';
                                    break;

                                case 'empty':
                                   echo'<div class="alert alert-danger">Tous les champs sont obligatoires!.</div>';
                                    break;

                                 case 'existe':
                                   echo'<div class="alert alert-warning">Votre ancien mot de passe est incorrect !.</div>';
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        }
                    ?>


                    <?php

                        if(isset($datas['result']) && $datas['result']=="saved"){
                            echo '<a href="'.SITE.'members/profile/" class="btn btn-danger">Revenir</a>';
                        }
                        else{
                    ?>

                <form class="form-horizontal" action="<?php echo SITE;?>members/password/" method="POST"  >
                    <div class="form-group"><label class="col-lg-4 control-label">Ancien mot de passe</label>

                        <div class="col-lg-8"><input type="password" name="oldpassword" required  placeholder="Ancien mot de passe" class="form-control"> 
                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-4 control-label">Nouveau mot de passe</label>

                        <div class="col-lg-8"><input type="password" name="newpassword1"  required placeholder="Nouveau mot de passe" class="form-control"></div>
                    </div>

                    <div class="form-group"><label class="col-lg-4 control-label">Confirmer nouveau mot de passe</label>

                        <div class="col-lg-8"><input  type="password" name="newpassword2"  required placeholder="Confirmer nouveau mot de passe" class="form-control"></div>
                    </div>
                    <div class="form-group">
                    <div class="clear20"></div>
                        <div class="col-lg-offset-4 col-lg-10">
                            <button id="savePassword" name="cuPassword" class="btn btn-primary mgR20">Modifier</button>
                             <a href="<?php echo SITE;?>members/profile/" class="btn btn-danger">Annuler</a>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>