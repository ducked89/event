<!-- Header -->
<?php
    $mUser = (object)($datas['mdatas']);
    if(isset($datas['mUserTemp']))
    $mUserTemp = (object)($datas['mUserTemp']);
    else $mUserTemp = (object)($datas['mdatas']);
    // var_dump($mUserTemp);
?>
<div class="col-md-12">
    <h2>Utilisateurs</h2>
    <small>Modification des identifiants des <utilisateurs class=""></utilisateurs></small>


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


                   <div class="clear20"></div>
                 <?php

                        if(isset($datas['error']['error']))
                        echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                            <div class='clear20'></div>";

                        if(isset($datas['error']['existe']))
                        echo "<div class='alert alert-info'>Il n'existe pas de compte avec les informations fourinies.</div>
                            <div class='clear20'></div>";

                        if(isset($datas['error']['notsaved']))
                        echo "<div class='alert alert-info'>Oups !. Une erreur s'est produite dans la sauvegarde. Veuillez re-essayer.</div>
                            <div class='clear20'></div>";

                    ?>

                </div>
                <div class="clear20"></div>

                <div class="ibox-content">
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/accounts/edit/?idu=<?= $mUserTemp->id ?>" method="POST"  >
                        <input type="hidden" id="id" name="id" value="<?= $mUser->id ?>">
                        <input type="hidden" id="cuPassword" name="cuPassword">
                        <div class="form-group"><label class="col-lg-4 control-label">Login</label>
                            <div class="col-lg-8"><input  id="login" name="login" type="text" placeholder="Nouveau mot de passe" class="form-control" value="<?=  $mUserTemp->login;?>"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Statut</label>
                            <div class="col-sm-10"><select class="form-control m-b" name="status">
                               <option value="1" <?php if($mUserTemp->status==1) echo 'selected="selected"';?>>Actif</option>
                               <option value="0" <?php if($mUserTemp->status==0) echo 'selected="selected"';?>>Inactif</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8 pull-right">
                                <button id="saveUser" name="saveUser"  onclick="checkPassword()" class="btn btn-primary mgR20">Modifier</button>
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
