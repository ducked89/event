<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Critères</h2>
       <small>Liste des critères d'évènements des organisateurs</small>

       <small>Liste d'évaluations des organisateurs</small>
       <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-warning btn-sm floatR ">Mentions des notes</a>


       <a href="<?php echo SITE;?>admin/criteres/add/" class="btn btn-primary btn-sm floatR mgR20">Ajouter un critère</a>

   </div>
</div>

<div class="row row-bg">
   <div class="wrapper wrapper-content animated fadeInUp">

       <div class="ibox col-md-12">
           <div class="ibox-title">
               <h5>Critères d’évènement</h5>

           </div>
           <div class="ibox-content">
               <div class="row m-b-sm m-t-sm">
                   <div class="col-md-2">
                       <button type="button" id="refreshCriteres" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Recharger</button>
                   </div>
                   <div class="col-md-10">
                       <div class="input-group"><input id="searchCriteresInput" type="text" onchange="searchCriteres();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
                           <button type="button" onclick="searchCriteres();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                   </div>
               </div>

               <div class="project-list" id="loginCritereBox">
                   <div class="ibox-content">
                       <div class="sk-spinner sk-spinner-wave">
                           <div class="sk-rect1"></div>
                           <div class="sk-rect2"></div>
                           <div class="sk-rect3"></div>
                           <div class="sk-rect4"></div>
                           <div class="sk-rect5"></div>
                       </div>

                       <table class="table table-hover" id="dataTable">
                           <tbody>

                           <?php
                               if(count($datas['criteres'])>0 && isset($datas['criteres'][0]->id))
                               {
                                   foreach ($datas['criteres'] as $data) {
                                       echo '
                                           <tr>
                                               <td class="project-title">
                                                   <a href="'.SITE.'admin/criteres/edit/?idu='.$data->id.'"><h3>'.$data->title.'</h3></a>

                                                   <small>Creation : '.date_format(date_create($data->datecreated), "d M Y").'</small>
                                               </td>
                                               <td class="project-completion">
                                                   <p>'.$data->description.'</p>
                                               </td>
                                               <td class="project-status">';
                                                   if($data->statut==1) echo'<span class="label label-info mgR20">Actif</span>
                                                       <a data-value="OFF" data-id="'.$data->id.'" class="ajaxChangeStatutCritere btn btn-white btn-sm floatR"><i class="fa fa-ban"></i> Désact.';
                                                   else echo'<span class="label label-danger mgR20">Inactif</span>
                                                       <a data-value="ON" data-id="'.$data->id.'" class="ajaxChangeStatutCritere btn btn-white btn-sm floatR"><i class="fa fa-check"></i> Act</a>';
                                               echo'
                                               </td>
                                               <td class="project-actions">
                                                   <a href="'.SITE.'admin/criteres/edit/?idu='.$data->id.'" class="btn btn-white btn-sm mgR20"><i class="fa fa-pencil "></i> Edit </a>

                                                   <a data-id="'.$data->id.'" class="ajax_delete_critere btn btn-white btn-sm floatR"><i class="fa fa-trash"></i> </a>

                                                   <div class="clear"></div>
                                                      <p id="delete'.$data->id.'" class="delete-data">Etes-vous sur?
                                                           <button class="ajax_delete_critere_yes btn btn-xs btn-success mgR10" data-id="'.$data->id.'" >Oui</button>
                                                           <button class="ajax_delete_critere_no btn btn-xs btn-danger" data-id="'.$data->id.'">Non</button>
                                                       </p>
                                               </td>
                                           </tr>
                                       ';
                                   }
                               }
                               else echo '<tr>
                               <td colspan="4" class="nodata">
                                       <div class="alert alert-block alert-danger "><strong>Oups !</strong> Desolé. Aucun critere trouvé.
                                       </div>
                                   </td>
                               </tr>';
                           ?>


                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){
       $('#refreshCriteres').click(function () {
           var btn = $(this);
           simpleLoad(btn, true);
           refreshCriteres();
           simpleLoad(btn, false);
       });
    });

   function simpleLoad(btn, state) {
       if (state) {
           $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
           btn.children().addClass('fa-spin');
           btn.contents().last().replaceWith(" Rechargement");
       } else {
           setTimeout(function () {
               btn.children().removeClass('fa-spin');
               btn.contents().last().replaceWith(" Recharger");
               $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
           }, 1000);
       }
   }

   //AJAX Recchercher un critere
   function searchCriteres ()
       {
           setTimeout(function () {
               $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
               var val= $("#searchCriteresInput").val();
               $.ajax({
                   type: "POST",
                   url: root+'app/php_ajax/actionsCriteres.php',
                   dataType: 'html',
                   data: "id=search_critere_form&text="+val,
                   cache: false,
                   success: function(html)
                       {
                           $("#dataTable tbody").hide();
                           $("#dataTable tbody").html(html).fadeIn();
                           $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
                       }
                   });
           },  1000);
       }

   //AJAX Recharger la liste des criteres
   function refreshCriteres ()
   {
       $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsCriteres.php',
           dataType: 'html',
           data: "id=refresh_critere_form",
           cache: false,
           success: function(html)
           {
               $("#dataTable tbody").hide();
               $("#dataTable tbody").html(html).fadeIn();
               $('#loginCritereBox').children('.ibox-content').toggleClass('sk-loading');
           }
       });
   }

   // Activation & Desactivation d'un critere
   $(document).on("click", ".ajaxChangeStatutCritere", function(e)
   {
       e.preventDefault();
       var id = $(this).attr('data-id');
       var stat = $(this).attr('data-value');

       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsCriteres.php',
           dataType: 'html',
           data: "id=ajax_change_statut_critere&opt="+stat+"&idu="+id,
           cache: false,
           success: function(code)
           {
               if(code=="YES")
               toastr.info('Operation effectuee avec success','Notification !');
               else
               toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
               refreshCriteres ();
           }
       });

       // alert(id+" - Stat = "+stat);
   });


   $(document).on("click", ".ajax_delete_critere", function (e)
   {
       e.preventDefault();
       var id = $(this).attr('data-id');
       $("#delete"+id).slideToggle();
   });

   $(document).on("click", ".ajax_delete_critere_yes", function (e)
   {
       var id = $(this).attr('data-id');
       // $("p."+id).hide();

       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsCriteres.php',
           dataType: 'html',
           data: "id=delete_critere_form&idu="+id,
           cache: false,
           success: function(code)
               {
                   if(code=="YES")
                   toastr.info('Operation effectuee avec success','Notification !');
                   else
                   toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                   refreshCriteres ();
               }
           });

   });

   $(document).on("click", ".ajax_delete_critere_no", function (e)
   {
       var id = $(this).attr('data-id');
       $("#delete"+id).slideToggle();
   });

</script>
