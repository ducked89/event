<?php     $myInfo = $datas['employes'];?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Parametres</h2>
    	<small>Modifier vos paramètres d'utilisateurs.</small>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInLeft">

    <!-- Profil header -->
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">

            <div class="profile-image">
                <img src="<?php 
                echo SITE.'public/images/profiles/';
                if(!empty($myInfo->photo)) echo $myInfo->photo;
                else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            <?= $myInfo->firstname.' '.$myInfo->lastname;?>
                        </h2>
                        <h4> <?= $myInfo->position;?></h4>
                        <small>
                            <i class="fa fa-phone pd10"></i> <?= $myInfo->phone;?>
                            <i class="fa fa-envelope-o pd10"></i>  <?= $myInfo->email;?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 pull-right">
            <a class="btn btn-warning pull-right" href="<?php echo SITE;?>members/profile/photo/?idu=<?= $myInfo->iduser ?>">Changer photo</a>
        </div>
    </div>




    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row row-bg">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h3>Modification de paramètres</h3>
                    </div>
                    <div class="ibox-content col-lg-12">
						<ul class="employe-row">
	                       <li><i class="fa fa-user mgR10"></i><a href="<?= SITE;?>members/profile/edit/">Editer profil</a></li>
	                       <li><i class="fa fa-file-picture-o mgR10"></i><a href="<?= SITE;?>members/profile/photo">Modifier photo</a></li>
	                        <li><i class="fa fa-lock mgR10"></i><a href="<?= SITE;?>members/password/">Changer mot de passe</a></li>
	                   </ul>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>