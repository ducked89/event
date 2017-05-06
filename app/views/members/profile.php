 <?php     $myInfo = $datas['employes'];?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Profil</h2>
        <small>Affichage des informations générales sur mon profil.</small>
        <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/profile/edit/">Modifier mon profil</a>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

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


    <!-- Profile infos -->
    <div class="row">

        <!-- Utilisateur -->
        <div class="col-lg-3">
            <div class="ibox ibox-info">
                <div class="ibox-header"><h3><i class="fa fa-user mgR10"></i>Compte</h3></div>
                <div class="ibox-content">
                    <p class="small">Informations de base sur le compte utilisateur de cet employé.</p>
                    <div class="clear20"></div>
                    <?php
                        if(isset($myInfo->user))
                        {?>
                                   
                            <ul class="employe-row">
                                <li >
                                    <div class="emp-info">Login: </div>
                                    <?= strtoupper($myInfo->user[0]->login);?>
                                </li>
                                <li >
                                    <div class="emp-info">Type: </div>
                                    <?= $myInfo->role[0]->description;?>
                                </li>
                                <li >
                                    <div class="emp-info">Date creation: </div>
                                    <?= date_format(date_create($myInfo->user[0]->datecreated), "d M Y à H:i");?>
                                </li>
                                <li >
                                    <div class="emp-info">Derniere connexion: </div>
                                    
                                    <?= date_format(date_create($myInfo->timeout[0]->timeout), "d M Y à H:i");?>
                                </li>
                                <li >
                                    <?php 
                                        if($myInfo->user[0]->status==0)
                                        echo'<small class="label label-danger"><i class="fa fa-ban"></i> Desactivé</small>';
                                        else
                                        echo'<small class="label label-info"><i class="fa fa-check"></i> Activé</small>';
                                    ?>                                        
                                </li>
                            </ul>
                            <div class="clear20"></div>
                        <?php }
                        else
                            echo'<div class="alert alert-warning">Aucun compte associé à ce profil d\'employé"</div><br/><br/><a href="'.SITE.'admin/accounts/add/" class="btn btn-white">Créer un compte</a>';
                        ?>
                </div>
            </div>
        </div>

        
        <!-- Profil -->
        <div class="col-lg-5">
            <div class="ibox ibox-info">
                <div class="ibox-header"><h3><i class="fa fa-vcard-o mgR10"></i>Profil</h3></div>
                <div class="ibox-content">
                    <p class="small">Informations de base sur le profil de l'employé.</p><br/>
                    <div class="clear20"></div>
                    <ul class="employe-row employe-row-x1">
                        <li >
                            <div class="emp-info">Nom et Prénom: </div>
                            <?= strtoupper($myInfo->lastname).' '.$myInfo->firstname;?>
                        </li>
                        <li >
                            <div class="emp-info">Sexe: </div>
                            <?= strtoupper($myInfo->sex);?>
                        </li>
                        <li >
                            <div class="emp-info">Téléphone: </div>
                            <?= strtoupper($myInfo->phone);?>
                        </li>
                        <li >
                            <div class="emp-info">Adresse: </div>
                            <?= $myInfo->adresse;?>
                        </li>
                        <li >
                            <div class="emp-info">Email: </div>
                            <?= $myInfo->email;?>
                        </li>
                        <li >
                            <div class="emp-info">Position: </div>
                            <?= $myInfo->position;?>
                        </li>
                        <li ><div class="emp-info">Service:</div>
                            <?php if(isset($myInfo->service) && isset($myInfo->service[0]->title))
                                echo ''.$myInfo->service[0]->title.'<br/><div class="emp-info">'.$myInfo->service[0]->description.'</div>';
                                else echo "<span class='infored'>Service inconnu.</span>";
                            ?> 
                        </li>
                        <li >
                            <div class="emp-info">Extenstion: </div>
                            <?= $myInfo->extension;?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       

        <!-- Notifications -->
        <div class="col-lg-4">
            <div class="ibox ibox-info">
                <div class="ibox-header"><h3><i class="fa fa-bell mgR10"></i>Notifications</h3></div>
                <div class="ibox-content col-lg-12">
                    <p class="small">Messages d'alerte envoyés par le système ou par l'administrateur.</p>
                    <div class="clear20"></div>
                        <?php  
                            if(count($datas['notificationsSec'])>0 && isset($datas['notificationsSec'][0]->id))
                            {
                                $i=0;
                                foreach ($datas['notificationsSec'] as $data) {
                                    echo '
                                    <div class="faq-item">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a data-toggle="collapse" href="#noti'.$data->id.'" class="faq-question faq-question-small">'.$data->title.'</a>
                                                        <small>Added by <strong>'.$data->type.'</strong> <i class="fa fa-clock-o"></i>
                                                            ';if($data->datediff > 0)
                                                            echo $data->datediff.' jour(s)';
                                                            else echo 'Aujourd\'hui';
                                                            echo '   
                                                        </small>
                                                    </div> 
                                                </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div id="noti'.$i.'" class="panel-collapse collapse">
                                                                <div class="faq-answer">
                                                                    <p>'.$data->content.'</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                ';
                                    $i++;
                                }
                                echo'<div class="clear20"><div>
                                    <a class="btn btn-info" href="'.SITE.'members/notifications/"><i class="fa fa-bell mgR10"></i>Mes notifications</a>';
                            }
                            else echo '
                                <div class="alert alert-warning><i class="fa fa-times"></i>
                                <strong>Oups !</strong> Desolé! .Aucune notification trouvée.
                            </div><div class="clear20"></div>
                            ';
                            ?>
                     </div>
            </div>
        </div>
    </div>


</div>