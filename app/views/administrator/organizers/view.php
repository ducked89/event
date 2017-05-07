<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Profil Organisateur</h2>
       <small>Liste des organisateurs d'évènement disponibles dans le système.</small>
       <a class="btn btn-success pull-right" href="<?php echo SITE;?>admin/employes/">Liste des organisateurs</a>
   </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

   <!-- Profil header -->
   <div class="row m-b-lg m-t-lg">
       <div class="col-md-6">

           <div class="profile-image">
               <img src="<?php
               echo SITE.'public/images/profiles/';
               if(!empty($datas['employes']->photo)) echo $datas['employes']->photo;
               else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
           </div>
           <div class="profile-info">
               <div class="">
                   <div>
                       <h2 class="no-margins">
                           <?= $datas['employes']->firstname.' '.$datas['employes']->lastname;?>
                       </h2>
                       <h4> <?= $datas['employes']->position;?></h4>
                       <small>
                           <i class="fa fa-phone pd10"></i> <?= $datas['employes']->phone;?>
                           <i class="fa fa-envelope-o pd10"></i>  <?= $datas['employes']->email;?>
                       </small>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-md-4 pull-right">
           <a class="btn btn-warning mgR20" href="<?php echo SITE.'admin/employes/edit/?idu='.$datas['employes']->id;?>">Editer profil</a>
           <a class="btn btn-success" href="<?php echo SITE.'admin/accounts/edit/?idu='.$datas['employes']->iduser;?>">Editer compte</a>
       </div>
   </div>


   <!-- Profile infos -->
   <div class="row">

       <!-- Utilisateur -->
       <div class="col-lg-3">
           <div class="ibox ibox-info">
               <div class="ibox-header"><h3><i class="fa fa-user mgR10"></i>Compte</h3></div>
               <div class="ibox-content">
                   <p class="small">Informations de base sur le compte utilisateur de cet organisateur.</p>
                   <div class="clear20"></div>
                   <?php
                       if(isset($datas['employes']->user))
                       {?>

                           <ul class="employe-row">
                               <li >
                                   <div class="emp-info">Login: </div>
                                   <?= strtoupper($datas['employes']->user[0]->login);?>
                               </li>
                               <li >
                                   <div class="emp-info">Type: </div>
                                   <?= $datas['employes']->role[0]->description;?>
                               </li>
                               <li >
                                   <div class="emp-info">Date création: </div>
                                   <?= date_format(date_create($datas['employes']->user[0]->datecreated), "d M Y à H:i");?>
                               </li>
                               <li >
                                   <div class="emp-info">Derniere connexion: : </div>
                                   <?= date_format(date_create($datas['employes']->user[0]->lastattempts), "d M Y à H:i");?>
                               </li>
                               <li >
                                   <?php
                                       if($datas['employes']->user[0]->status==0)
                                       echo'
                                           <small class="label label-danger"><i class="fa fa-ban"></i> Desactivé</small>
                                           <div class="clear20"></div>
                                           <button data-id="'.$datas['employes']->user[0]->id.'" id="desactiverCompte" data-option="ON" class="btn btn-info ">Activer le compte</button>';
                                       else
                                       echo'<small class="label label-info"><i class="fa fa-check"></i> Activé</small>
                                           <div class="clear20"></div>
                                           <button data-id="'.$datas['employes']->user[0]->id.'" id="desactiverCompte" data-option="OFF" class="btn btn-danger ">Desactiver le compte</button>
                                           ';
                                   ?>
                               </li>
                           </ul>
                           <p id="desactiverCompteUtilisateur" class="delete-data">Etes-vous sur?
                               <button class="ajax_desactiver_compte_yes btn btn-xs btn-success mgR10" data-id="<?= $datas['employes']->id;?>" >Oui</button>
                               <button class="ajax_desactiver_compte_no btn btn-xs btn-danger">Non</button>
                           </p>

                       <?php }
                       else
                           echo'<div class="alert alert-warning">Aucun compte associe a ce profil d\'employe"</div><br/><br/><a href="'.SITE.'admin/accounts/add/" class="btn btn-white">Creer un compte</a>';
                       ?>
               </div>
           </div>
       </div>


       <!-- Profil -->
       <div class="col-lg-5">
           <div class="ibox ibox-info">
               <div class="ibox-header"><h3><i class="fa fa-vcard-o mgR10"></i>Profil</h3></div>
               <div class="ibox-content">
                   <p class="small">Informations de base sur le profil de l'organisateur.</p><br/>
                   <div class="clear20"></div>
                   <ul class="employe-row employe-row-x1">
                       <li >
                           <div class="emp-info">Nom et Prénom: </div>
                           <?= strtoupper($datas['employes']->lastname).' '.$datas['employes']->firstname;?>
                       </li>
                       <li >
                           <div class="emp-info">Sexe: </div>
                           <?= strtoupper($datas['employes']->sex);?>
                       </li>
                       <li >
                           <div class="emp-info">Téléphone: </div>
                           <?= strtoupper($datas['employes']->phone);?>
                       </li>
                       <li >
                           <div class="emp-info">Adresse: </div>
                           <?= $datas['employes']->adresse;?>
                       </li>
                       <li >
                           <div class="emp-info">Email: </div>
                           <?= $datas['employes']->email;?>
                       </li>
                       <li >
                           <div class="emp-info">Position: </div>
                           <?= $datas['employes']->position;?>
                       </li>
                       <li ><div class="emp-info">Service:</div>
                           <?php if(isset($datas['employes']->service) && isset($datas['employes']->service[0]->title))
                               echo ''.$datas['employes']->service[0]->title.'<br/><div class="emp-info">'.$datas['employes']->service[0]->description.'</div>';
                               else echo "<span class='infored'>Service inconnu.</span>";
                           ?>
                       </li>
                       <li >
                           <div class="emp-info">Extenstion: </div>
                           <?= $datas['employes']->extension;?>
                       </li>
                   </ul>
               </div>
           </div>
       </div>


       <!-- Evaluations -->
       <div class="col-lg-3">
           <div class="ibox ibox-info">
               <div class="ibox-header"><h3><i class="fa fa-list-alt mgR10"></i>Evènements</h3></div>
               <div class="ibox-content col-lg-12">
                   <p class="small">Evènements affectées à cet utilisateur.</p>
                   <div class="clear20"></div>
                       <?php
                           if(isset($datas['evaluations']) && count($datas['evaluations'])>0 )
                           {
                               $i=0;
                               foreach ($datas['evaluations'] as $data) {
                                   echo '
                                   <div class="faq-item">
                                       <div class="row">
                                           <div class="col-md-12">
                                               <a data-toggle="collapse" href="#noti'.$i.'" class="faq-question faq-question-small">'.$data->title.'</a>
                                               <small>Added by <strong>'.$data->type.'</strong> <i class="fa fa-clock-o"></i>
                                                   ';if($datas['evaluations'][$i]->datediff > 0)
                                                   echo $datas['evaluations'][$i]->datediff.' jour(s)';
                                                   else echo 'Aujourd\'hui';
                                                   echo '   </small></div> </div>
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
                           }
                           else echo '
                               <div class="alert alert-warning"><i class="fa fa-times"></i>
                               <strong>Oups !</strong> Desolé .Aucun évènement affecte à cet utilisateur.
                           </div>';
                           ?>
                    </div>
           </div>
       </div>

   </div>


</div>

<script type="text/javascript">
   var id=0;
   var opt="";
   $(document).on("click", "#desactiverCompte", function (e)
   {
       e.preventDefault();
      id = $(this).attr('data-id');
      opt = $(this).attr('data-option');
       $("#desactiverCompteUtilisateur").slideToggle();
   });

   $(document).on("click", ".ajax_desactiver_compte_yes", function (e)
   {
       // $("p."+id).hide();
      var mid = $(this).attr('data-id');
       $.ajax({
           type: "POST",
           url: root+'app/php_ajax/actionsComptes.php',
           dataType: 'html',
           data: "id=ajax_change_statut_compte&opt="+opt+"&ide="+id,
           cache: false,
           success: function(code)
               {
                   if(code=="YES")
                   toastr.info('Operation effectuee avec success','Notification !');
                   else
                   toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                   window.location.href=root+"admin/employes/view/?idu="+mid;
               }
           });

   });

   $(document).on("click", ".ajax_desactiver_compte_no", function (e)
   {
       var id = $(this).attr('data-id');
       $("#desactiverCompteUtilisateur").slideToggle();
   });

</script>
