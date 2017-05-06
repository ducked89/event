  <ul class="nav navbar-top-links navbar-right">
    <li>
        <span class="m-r-sm text-muted welcome-message">Bienvenue Haiti Event Core </span>
    </li>
    
   <!-- Messages-->
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope"></i>  <span class="label label-warning"><?= count($mMessages)?></span>
        </a>
        <ul class="dropdown-menu dropdown-messages">

        <?php
            if(count($mMessages)>0)
            {
               $i=0;
                    foreach ($datas['messages'] as $data) {
                        if ($i < 3) {
                            echo '<li>
                                <div class="dropdown-messages-box">
                                    <a href="'.SITE.'admin/messages/" class="pull-left">
                                        <img alt="image" class="img-circle" src="'.SITE.'public/images/profiles/profile.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">';if($datas['messages'][$i]->datediff > 0)
                                        echo $datas['messages'][$i]->datediff.' jour(s)';
                                        else echo 'Aujourd\'hui';
                                        echo '</small>
                                        <strong>'.$data->sender.'</strong> <br/> '.$data->title.'. <br>
                                        <small class="text-muted">'.$data->datecreated.'</small>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            ';
                        }
                        $i++;
                    }

                 echo '<li>
                    <div class="text-center link-block">
                        <a href="'.SITE.'admin/messages/">
                            <i class="fa fa-envelope"></i> <strong>Lire les messages.</strong>
                        </a>
                    </div>
                </li>';
            }else{
                echo '<li>
                        <div class="text-center link-block">
                            <a href="#">
                                <i class="fa fa-envelope"></i> <strong>Aucun message !</strong>
                            </a>
                        </div>
                    </li>';
            }
        ?>

        </ul>
    </li>
    
    <!-- Notifications-->
    <li class="dropdown">
        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>  <span class="label label-primary"><?= count($mNotifcations)?></span>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
         
          <?php   
              if(count($mNotifcations)>0)
                {
                    $i=0;
                    foreach ($datas['notifications'] as $data) {
                        if ($i < 3) {
                            echo '<li>
                                 <a href="'.SITE.'admin/notifications/#not"'.$data->id.'" ">
                                    <div>
                                        <i class="fa fa-bell fa-fw mgR10"></i><strong>'.$data->title.'</strong><br/>
                                        <span>'.substr($data->content,0,100).'</span>
                                        <span class="pull-right text-muted small">';if($datas['notifications'][$i]->datediff > 0)
                                    echo $datas['notifications'][$i]->datediff.' jour(s)';
                                    else echo 'Aujourd\'hui';
                                    echo '</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>'; 
                        }
                        $i++;
                    }
                    echo'
                    <li>
                        <div class="text-center link-block">
                            <a href="'.SITE.'admin/notifications">
                                <strong>Lire les alertes</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>';
                }else{
                    echo'
                    <li>
                        <div class="text-center link-block">
                            <a href="#">
                                <strong>Aucune alerte !</strong>
                            </a>
                        </div>
                    </li>';
                }
            ?>
        
        </ul>
    </li>

    <li>
        <a href="<?php echo SITE;?>admin/logout/">
            <i class="fa fa-sign-out"></i> Logout
        </a>
    </li>
</ul>
<!-- Déconnexion -->