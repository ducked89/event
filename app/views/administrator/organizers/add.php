<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Organisateurs</h2>
       <small>Liste des organisateurs d'évènement disponibles dans le système.</small>
       <a href="<?php echo SITE;?>admin/employes/export/" class="btn btn-info btn-sm floatR">Exporter</a>
       <a href="<?php echo SITE;?>admin/employes/" class="btn btn-primary btn-sm floatR mgR20">Liste organisateurs</a>
   </div>
</div>

<div class="row row-bg">
   <div class="col-lg-12">
       <div class="wrapper wrapper-content animated fadeInUp ">
           <div class="ibox float-e-margins ">
               <div class="ibox-title">
                   <h3>Ajout d'un organisateur</h3>
               </div>
               <div class="ibox-content">
                   <div class="col-lg-7">
                       <?php

                           if(isset($datas['error']['error']))
                           echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez verifier vos saisies.</div>
                               <div class='clear50'></div>";

                           if(isset($datas['error']['existe']))
                           echo "<div class='alert alert-info'>Il existe déjà un employé avec les mêmes informations.</div>
                               <div class='clear50'></div>";

                       ?>
                       <form class="form-horizontal" action="<?php echo SITE;?>admin/employes/add/" method="POST"  >
                               <div class="clear20"></div>

                               <div class="form-group"><label class="col-lg-2 control-label">Nom</label>
                                   <div class="col-lg-10">
                                   <input  name="nom" placeholder="Nom de famille" required class="form-control" type="text"><?php if(isset($datas['error']['nom'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                   </div>
                               </div>

                                <div class="form-group"><label class="col-lg-2 control-label">Prenom</label>
                                   <div class="col-lg-10">
                                   <input  name="prenom" placeholder="Prénom" required class="form-control" type="text">
                                   <?php if(isset($datas['error']['prenom'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                   </div>
                               </div>

                               <div class="form-group"><label class="col-lg-2 control-label">Sexe</label>
                                   <div class="col-lg-10">
                                   <fieldset id="sexe">
                                           <input type="radio" value="F" name="sexe"><span class="mgL20">Féminin</span>
                                           <input type="radio" value="M" name="sexe">Masculin
                                       </fieldset>
                                   </div>
                               </div>

                               <div class="form-group"><label class="col-lg-2 control-label">Téléphone</label>
                                   <div class="col-lg-10">
                                   <input  name="phone" placeholder="Ex: 3687 9238" required class="form-control" type="text">
                                   <?php if(isset($datas['error']['phone'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                   </div>
                               </div>

                               <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                                   <div class="col-lg-10"><input  name="email" placeholder="Ex: ajderson@gmail.com" class="form-control" type="email"> </div>
                               </div>

                               <div class="form-group"><label class="col-lg-2 control-label">Adresse</label>
                                   <div class="col-lg-10"><input  name="adresse" placeholder="#34, Rue Jean Paul 1, Pacot, Port-au-Prince" class="form-control" type="text"> </div>
                               </div>


                               <div class="clear20"></div><hr>
                               <div class="clear20"></div>

                               <div class="form-group"><label class="col-lg-2 control-label">Poste</label>
                                   <div class="col-lg-10">
                                   <input  name="poste" placeholder="Ex: Assistant en communication" required class="form-control" type="text">
                                   <?php if(isset($datas['error']['poste'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                   </div>
                               </div>

                               <div class="form-group"><label class="col-sm-2 control-label">Service</label>
                                   <div class="col-sm-10">
                                       <select class="form-control m-b" name="service">
                                         <?php
                                               foreach ($datas['services'] as $mService) {
                                                   echo '<option value="'.$mService->id.'">'.$mService->title.'</option>';
                                               }

                                         ?>
                                       </select>
                                   </div>
                               </div>

                                <div class="form-group"><label class="col-lg-2 control-label">Extension</label>
                                   <div class="col-lg-10">
                                   <input  name="extension" placeholder="Ex: 1234"  class="form-control" type="text">
                                   <?php if(isset($datas['error']['extention'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                   </div>
                               </div>

                               <div class="clear20"></div>
                               <div class="form-group">
                                   <div class="col-lg-offset-2 col-lg-10">
                                       <button name="createEmploye" class="btn btn-w-m btn-success mgR20" type="submit">Creer</button>

                                        <a href="<?= SITE;?>admin/employes/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
                                   </div>
                               </div>
                       </form>
                   </div>
                   <div class="clear50"></div>
               </div>
           </div>
       </div>
   </div>
</div>
