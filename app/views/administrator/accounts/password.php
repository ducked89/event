<!-- Header -->
<?php
    $mUser = (object)($datas['mdatas']);
?>
<div class="col-md-12">
    <h2>Utilisateurs</h2>
    <small>Modification le mot de passe du compte ci-dessous</small>


</div>
<div class="clear50"></div>
<div class="row">
    <div class="col-lg-6">
        <div class="contact-box">
            <div class="col-sm-8">
                <h3><strong><?=  $mUser->login;?></strong></h3>
                <p><i class="fa fa-envelope-open-o"></i> <?=  $mUser->email;?></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="contact-box">
            <a href="<?php echo SITE.'admin/accounts/view/?idu='.$mUser->id;?>">
            <div class="col-sm-3">
                <div>
                    <img alt="image" class="img-thumbnail img-md img-responsive"
                    src="<?php echo SITE;?>public/images/profiles/<?= (!empty($mUser->photo))? $mUser->photo :  "profile.jpg" ?>">
                </div>
            </div>
            <div class="col-sm-8">
                <h3><strong><?=  $mUser->firstname.', '.$mUser->lastname;?></strong></h3>
                <p><i class="fa fa-phone"></i> <?=  $mUser->phone;?></p>
            </div>
            <div class="clearfix"></div>
                </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8">
        <div class="col-lg-offset-1 col-lg-10">
            <div class="ibox float-e-margins">
                <div class="clear20"></div>
                <div class="result">


                    <?php

                        if (isset($datas['result'])) {

                            switch ($datas['result']) {
                                case 'DONE':
                                   echo'<div class="alert alert-success">Mot de passe modifie avec success !.</div>';
                                    break;

                                case 'NOTMATCH':
                                   echo'<div class="alert alert-danger">Les deux nouveaux mot de passe ne correspondent pas !.</div>';
                                    break;

                                default:
                                    # code...
                                    break;
                            }
                        }
                    ?>

                </div>
                <div class="clear20"></div>

                <div class="ibox-content">
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/accounts/password/?idu=<?= $mUser->id ?>" method="POST"  >
                        <input type="hidden" id="iduser" name="iduser" value="<?= $mUser->id ?>">
                        <input type="hidden" id="cuPassword" name="cuPassword">
                        <div class="form-group"><label class="col-lg-4 control-label">Nouveau mot de passe</label>
                            <div class="col-lg-8"><input  id="password1" name="password1" type="password" placeholder="Nouveau mot de passe" class="form-control"></div>
                        </div>

                        <div class="form-group"><label class="col-lg-4 control-label">Confirmation</label>
                            <div class="col-lg-8"><input id="password2"  name="password2"  type="password" placeholder="Confirmer nouveau mot de passe" class="form-control" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8 pull-right">
                                <button id="editpassbutton" name="editpassbutton"  onclick="checkPassword()" class="btn btn-primary mgR20">Modifier</button>
                                <a href="<?php echo SITE;?>admin/accounts/" class="btn btn-danger floatR">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


</script>
