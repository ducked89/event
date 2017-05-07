<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Notifications</h2>
       <small>Messages de traitements/opération éffectués dans le système..</small>
       <a href="<?php echo SITE;?>administrator/notifications/" class="btn btn-primary btn-sm floatR">
       <i class="fa fa-bell mgR10"></i>Notifications</a>

   </div>
</div>

<div class="row row-bg">
   <div class="clear20"></div>
   <div class="col-lg-12">
       <div class="wrapper wrapper-content animated fadeInUp">
           <div class="ibox float-e-margins">

               <div class="ibox-title">
                   <h3>Publier une notification</h3>
               </div>
               <div class="ibox-content col-lg-12">

                   <div class="col-lg-7">
                       <?php

                           if(isset($datas['error']['error']))
                           echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez vérifier vos saisies.</div>
                               <div class='clear20'></div>";

                           if(isset($datas['error']['existe']))
                           echo "<div class='alert alert-info'>Il existe déjà une notification avec les mêmes infos.</div>
                               <div class='clear20'></div>";

                       ?>
                       <form class="form-horizontal" action="<?php echo SITE;?>administrator/notifications/add/" method="POST"  >
                               <div class="clear20"></div>

                               <div class="form-group"><label class="col-lg-2 control-label">Objet</label>
                                   <div class="col-lg-10"><input <?php if(isset($_POST['title'])) echo 'value="'.$_POST['title'].'"';?> name="title" placeholder="Titre de la notifcation" required class="form-control" type="text"> </div>
                                   <?php if(isset($datas['error']['title'])) echo '<span class="alert alert-warning">Ce champ est obligatoire.</span>';?>
                               </div>


                               <div class="form-group"><label class="col-lg-2 control-label">Message</label>
                                   <div class="col-lg-10"><textarea  name="content" required class="form-control sm-textarea"><?php if(isset($_POST[''])) echo 'value="'.$_POST['content'].'"';?></textarea>
                                   </div>
                                   <?php if(isset($datas['error']['content'])) echo '<span class="alert alert-warning">Ce champ est obligatoire.</span>';?>
                               </div>

                               <div class="clear20"></div>

                              <div class="form-group"><label class="col-sm-2 control-label">Envoyer à </label>
                                   <div class="col-sm-10"><select class="form-control m-b" name="iduser">
                                      <option value="0">Tous</option>

                                   <?php
                                       foreach ($datas['employes'] as $mEmploye) {
                                           echo '<option value="'.$mEmploye->iduser.'" ';
                                           if(isset($_POST['']) && $_POST['']==$mEmploye->iduser) echo 'selected="selected"';
                                           echo '>'.$mEmploye->firstname.' '.$mEmploye->lastname.'</option>';
                                       }

                                   ?>

                                   </select>
                                   </div>
                               </div>

                               <div class="clear20"></div>
                               <div class="form-group">
                                   <div class="col-lg-offset-2 col-lg-10">
                                       <button name="createNotification" class="btn btn-w-m btn-success mgR20" type="submit">Créer</button>
                                        <a href="<?= SITE;?>administrator/notifications/" class="btn btn-w-m btn-danger floatR">Annuler</a>
                                   </div>
                               </div>
                       </form>
                       <div class="clear50"></div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
