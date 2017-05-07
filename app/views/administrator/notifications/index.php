<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Notifications</h2>
       <small>Messages de traitement/operation effectués dans le système..</small>
       <a href="<?php echo SITE;?>administrator/notifications/add/" class="btn btn-primary btn-sm floatR"><i class="fa fa-send mgR10"></i>Envoyer une notification</a>

   </div>
</div>
<div class="row row-bg">
   <div class="wrapper wrapper-content animated fadeInUp">
   <div class="clear20"></div>

       <!-- Notification recus -->
       <div class="col-md-6 <?=(isset($datas['section'])&& $datas['section']=="recus")?'section-selected':'';?>">
           <div class="ibox-title">
               <h5>Notifications Système</h5>

           </div>
           <div class="ibox-content">
               <div class="row m-b-sm m-t-sm">
                   <div class="col-md-1">
                       <button type="button" id="refreshNotificationsRecus" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i></button>
                   </div>
                   <div class="col-md-11">
                       <div class="input-group"><input id="searchNotificationsRecusInput" type="text" onchange="searchNotificationsRecus();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
                           <button type="button" onclick="searchNotificationsRecus();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                   </div>
               </div>

               <div class="project-list" id="loadingNotifcationsRecusBox">
                   <div class="ibox-content ibox-content-expand">
                       <div class="sk-spinner sk-spinner-wave">
                           <div class="sk-rect1"></div>
                           <div class="sk-rect2"></div>
                           <div class="sk-rect3"></div>
                           <div class="sk-rect4"></div>
                           <div class="sk-rect5"></div>
                       </div>

                       <div id="notificationsRecusBox">
                           <?php

                               if(count($datas['notificationsRecus'])>0){

                                       foreach ($datas['notificationsRecus'] as $mNotifRecus) {
                                       echo '
                                           <div class="faq-item faq-item-expand">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                   <img src="'.SITE.'public/images/profiles/profile.jpg" class="floatL mgR20 img-circle img-sm" />
                                                       <a data-toggle="collapse" href="#faq'.$mNotifRecus->id.'" class="faq-question">
                                                       <i class="btn btn-xs btn-info pull-right fa fa-angle-double-down"></i>'.$mNotifRecus->title.'</a>
                                                      <strong>Système </strong> à '.$mNotifRecus->employe.' -  <small><i class="fa fa-clock-o"></i> ';
                                                      if($mNotifRecus->datediff > 0)
                                                       echo $mNotifRecus->datediff.' jour(s)';
                                                       else echo 'Aujourd\'hui';
                                                       echo ' - '.date_format(date_create($mNotifRecus->datecreated), "d M Y").'</small>
                                                   </div>
                                               </div>
                                               <div class="row">
                                                   <div class="col-lg-12">
                                                       <div id="faq'.$mNotifRecus->id.'" class="panel-collapse collapse">
                                                           <div class="faq-answer">
                                                               <p>'.$mNotifRecus->content.'</p>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <hr>
                                           </div>

                                       ';
                                   }
                               }
                               else{
                                   echo '
                                       <div class="faq-item faq-item-expand">
                                           <div class="row">
                                               <div class="col-md-12">
                                               <span class="alert alert-warning">Aucune notification système !</span>
                                               </div>
                                           </div>
                                       </div>';

                               }
                           ?>
                       </div>
                   </div>
               </div>
               <div class="clear50"></div><?=$datas['paginateRecus'];?>
           </div>
       </div>



       <!-- Notification envoyes -->
       <div class="col-md-6 <?=(isset($datas['section'])&& $datas['section']=="sent")?'section-selected':'';?>">
           <div class="ibox-title">
               <h5>Notifications Envoyés</h5>

           </div>
           <div class="ibox-content">
               <div class="row m-b-sm m-t-sm">
                   <div class="col-md-1">
                       <button type="button" id="refreshNotificationsEnvoyes" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i>  </button>
                   </div>
                   <div class="col-md-11">
                       <div class="input-group"><input id="searchNotificationsEnvoyesInput" type="text" onchange="searchNotificationsEnvoyes();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
                           <button type="button" onclick="searchNotificationsEnvoyes();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                   </div>
               </div>

               <div class="project-list" id="loadingNotifcationsEnvoyesBox">
                   <div class="ibox-content">
                       <div class="sk-spinner sk-spinner-wave">
                           <div class="sk-rect1"></div>
                           <div class="sk-rect2"></div>
                           <div class="sk-rect3"></div>
                           <div class="sk-rect4"></div>
                           <div class="sk-rect5"></div>
                       </div>

                       <div id="notificationsEnvoyesBox">
                           <?php

                               if(count($datas['notificationsEnvoyes'])>0){

                                       foreach ($datas['notificationsEnvoyes'] as $mNotifRecus) {
                                       echo '
                                           <div class="faq-item faq-item-expand">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <i class="floatL mgR20 fa fa-send-o fa-large"></i>
                                                       <a data-toggle="collapse" href="#faq'.$mNotifRecus->id.'" class="faq-question">
                                                       <i id="'.$mNotifRecus->id.'" title="Afficher la notification" class=" btn btn-xs btn-info pull-right fa fa-angle-double-down"></i>'.$mNotifRecus->title.'</a>';

                                                       if($mNotifRecus->sent==0)
                                                       echo'
                                                       <button data-id="'.$mNotifRecus->id.'" title="Envoyer cette notification" class="sendNotification btn btn-warning pull-right"><i class="fa fa fa-plane"></i></button>';

                                                       echo'<strong>Admin </strong> à '.$mNotifRecus->employe.' -  <small><i class="fa fa-clock-o"></i> ';
                                                      if($mNotifRecus->datediff > 0)
                                                       echo $mNotifRecus->datediff.' jour(s)';
                                                       else echo 'Aujourd\'hui';
                                                       echo ' - '.date_format(date_create($mNotifRecus->datecreated), "d M Y").'</small>
                                                   </div>
                                               </div>
                                               <div class="row">
                                                   <div class="col-lg-12">
                                                       <div id="faq'.$mNotifRecus->id.'" class="panel-collapse collapse">
                                                           <div class="faq-answer">
                                                               <p>'.$mNotifRecus->content.'</p>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <hr>
                                           </div>
                                       ';
                                   }
                               }
                               else{
                                   echo '
                                       <div class="faq-item faq-item-expand">
                                           <div class="row">
                                               <div class="col-md-12">
                                               <span class="alert alert-warning">Aucune notification système !</span>
                                               </div>
                                           </div>
                                       </div>';

                               }

                           ?>
                       </div>
                   </div>
               <?=$datas['paginateEnvoyes'];?><div class="clear50"></div>
               </div>
           </div>
       </div>



   </div>
</div>


<script type="text/javascript">
   $(document).on("click", "#refreshNotificationsRecus", function(e)
   {
       $('#loadingNotifcationsRecusBox').children('.ibox-content').toggleClass('sk-loading');
       refreshNotificationsRecus();
   });

   $(document).on("click", "#refreshNotificationsEnvoyes", function(e)
   {
       $('#loadingNotifcationsEnvoyesBox').children('.ibox-content').toggleClass('sk-loading');
       refreshNotificationsEnvoyes();
   });

   //AJAX Recchercher une notification recu
   function searchNotificationsRecus ()
   {
       $('#loadingNotifcationsRecusBox').children('.ibox-content').toggleClass('sk-loading');
       var val= $("#searchNotificationsRecusInput").val();
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsNotifications.php',
           dataType: 'html',
           data: "id=search_notification_recu_form&text="+val,
           cache: false,
           success: function(html)
               {
                   $("#notificationsRecusBox").hide();
                   $("#notificationsRecusBox").html(html).fadeIn();
                   $('#loadingNotifcationsRecusBox').children('.ibox-content').toggleClass('sk-loading');
               }
           });
   }

   //AJAX Recharger la liste des notifications recus
   function refreshNotificationsRecus ()
   {
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsNotifications.php',
           dataType: 'html',
           data: "id=refresh_notification_recu_form",
           cache: false,
           success: function(html)
           {
               $("#notificationsRecusBox").hide();
               $("#notificationsRecusBox").html(html).fadeIn();
               $('#loadingNotifcationsRecusBox').children('.ibox-content').toggleClass('sk-loading');
           }
       });
   }


   //AJAX Recchercher une notification envoye
   function searchNotificationsEnvoyes ()
   {
       $('#loadingNotifcationsEnvoyesBox').children('.ibox-content').toggleClass('sk-loading');
       var val= $("#searchNotificationsEnvoyesInput").val();
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsNotifications.php',
           dataType: 'html',
           data: "id=search_notification_envoye_form&text="+val,
           cache: false,
           success: function(html)
               {
                   $("#notificationsEnvoyesBox").hide();
                   $("#notificationsEnvoyesBox").html(html).fadeIn();
                   $('#loadingNotifcationsEnvoyesBox').children('.ibox-content').toggleClass('sk-loading');
               }
           });
   }

   // AJAX Recharger la liste de snotifcation envoyes
   function refreshNotificationsEnvoyes ()
   {
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsNotifications.php',
           dataType: 'html',
           data: "id=refresh_notification_envoye_form",
           cache: false,
           success: function(html)
           {
               $("#notificationsEnvoyesBox").hide();
               $("#notificationsEnvoyesBox").html(html).fadeIn();
               $('#loadingNotifcationsEnvoyesBox').children('.ibox-content').toggleClass('sk-loading');
           }
       });
   }

   // Activation & Desactivation d'un critere
   $(document).on("click", ".sendNotification", function(e)
   {
       e.preventDefault();
       var id = $(this).attr('data-id');
       $('#loadingNotifcationsEnvoyesBox').children('.ibox-content').toggleClass('sk-loading');

       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsNotifications.php',
           dataType: 'html',
           data: "id=ajax_send_notification&idu="+id,
           cache: false,
           success: function(code)
           {
               if(code=="YES")
               toastr.info('Operation effectuee avec success','Notification !');
               else
               toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
               refreshNotificationsEnvoyes ();
           }
       });

       // alert(id+" - Stat = "+stat);
   });

</script>
