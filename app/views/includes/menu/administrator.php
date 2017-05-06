   <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header nav-header-admin">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class=" img-thumbnail img-circle img-circle-small" src="<?php echo SITE;?>public/images/profiles/profile.jpg" />
                </span><!-- utelogo.jpg -->
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administrateur</strong>
                    </span> <span class="text-muted text-xs block"><b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo SITE;?>admin/parametres/login/">Compte</a></li>
                        <li><a href="<?php echo SITE;?>admin/password/">Change password</a></li>
                        <li><a href="<?php echo SITE;?>admin/messages/">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo SITE;?>admin/logout/">Logout</a></li>
                    </ul><!-- Déconnexion -->
                </div>
                <div class="logo-element">
                    HEC
                </div>
            </li>


            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mDashboards") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/dashboard/"><i class="fa fame fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mEvaluations") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/evaluations/"><i class="fa fame fa-bar-chart-o"></i> <span class="nav-label">Evènements</span></a>
            </li>

            <!-- <li <?php //if(isset($datas['menuSection']) && $datas['menuSection'] == "mPonderation") //echo 'class="active"';?>>
                <a href="<?php //echo SITE;?>admin/ponderations/"><i class="fa fame fa-percent"></i> <span class="nav-label">Pondérations</span></a>
            </li> -->

            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mCritere") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/criteres/"><i class="fa fame fa-check-square-o"></i> <span class="nav-label">Critères</span></a>
            </li>

            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mEmployes") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/employes/"><i class="fa fame fa-users"></i> <span class="nav-label">Organisateurs</span></a>
            </li>

            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mAccounts") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/accounts/"><i class="fa fame fa-user-o"></i> <span class="nav-label">Utilisateurs</span></a>
            </li>

             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mMessages") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/messages/"><i class="fa fame fa-envelope"></i> <span class="nav-label">Messages</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                        <li <?php if(isset($datas['menuSubSection']) && $datas['menuSubSection'] == "mCompose") echo 'class="subactive"';?>>
                            <a href="<?php echo SITE;?>admin/messages/compose/">Ecrire</a></li>
                        <li <?php if(isset($datas['menuSubSection']) && $datas['menuSubSection'] == "mInbox") echo 'class="subactive"';?>>
                            <a href="<?php echo SITE;?>admin/messages/">Inbox</a></li>
                    </ul>
            </li>


             <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mNotifications") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/notifications/"><i class="fa fame fa-bell"></i> <span class="nav-label">Notifications</span></a>
            </li>

            <!-- <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mRapport") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/rapport/"><i class="fa fame fa-file-text-o"></i> <span class="nav-label">Rapports</span></a>
            </li> -->

            <li <?php if(isset($datas['menuSection']) && $datas['menuSection'] == "mParametres") echo 'class="active"';?>>
                <a href="<?php echo SITE;?>admin/parametres/"><i class="fa fame fa-cog"></i> <span class="nav-label">Paramètres</span></a>
            </li>


        </ul>

    </div>
</nav>