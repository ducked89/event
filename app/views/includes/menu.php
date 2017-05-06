   <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header nav-header-admin">
                <div class="dropdown profile-element"> <span>
                   <a href="<?=SITE.'members/profile/photo/';?>">
                    <img alt="Profile" class="img-thumbnail img-circle img-circle-small" src="<?php echo SITE;?>public/images/profiles/<?= (!empty($mInfo->photo))? $mInfo->photo :  "profile.jpg" ?>" /></a>
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $mInfo->firstname." , ".$mInfo->lastname;?></strong>
                    </span> <span class="text-muted text-xs block"><?= $mInfo->position;?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo SITE;?>members/profile/">Profile</a></li>
                        <li><a href="<?php echo SITE;?>members/password/">Change password</a></li>
                        <li><a href="<?php echo SITE;?>members/messages/">Message</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo SITE;?>members/logout/">Logout</a></li>
                    </ul><!-- Déconnexion -->
                </div>
                <div class="logo-element">
                    HEC
                </div>
            </li>


            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mDashboards") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/dashboard/"><i class="fa fame fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
            </li>



             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mEvaluations") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/evaluations/"><i class="fa fame fa-edit"></i> <span class="nav-label">Evaluations</span></a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mMessages") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/messages/"><i class="fa fame fa-envelope"></i> <span class="nav-label">Messagerie</span></a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mNotifications") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/notifications/"><i class="fa fame fa-bell"></i> <span class="nav-label">Notifcations</span></a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mProfile") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/profile/"><i class="fa fame fa-user-o"></i> <span class="nav-label">Profil</span></a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mParametres") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>members/parametres/"><i class="fa fame fa-cog"></i> <span class="nav-label">Paramètres</span></a>
            </li>


        </ul>

    </div>
</nav>