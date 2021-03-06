<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Evènements</h2>
       <small>Liste des  d'évènements des organisateurs</small>
       <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-warning btn-sm floatR ">Mentions des notes</a>

       <a href="<?= SITE;?>admin/evaluations/activate/">
       <button type="button" class="btn btn-sm btn-info floatR mgR20"><i class="fa fa-check"></i>
       <span class="bold">Activer tous</span></button></a>

       <a href="<?= SITE;?>admin/evaluations/add/">
       <button type="button" class="btn btn-sm btn-success floatR mgR20"><i class="fa fa-plus "></i>
       <span class="bold">Creer</span></button></a>
   </div>
</div>

<div class="clear20"></div>
<div class="wrapper wrapper-content animated fadeInTop">

   <div class="row row-bg">
       <div class="clear20"></div>
       <div class="col-md-12">
           <div class="col-lg-offset-1 col-lg-10">
               <div class="ibox float-e-margins">
                   <div class="clear20"></div>

                   <div class="ibox-title">
                       <h3>Desactiver les évènements</h3>
                   </div>

                   <div class="ibox-content padding50">
                       <form class="form-horizontal" action="<?php echo SITE;?>admin/evaluations/desactivate/" method="POST"  >
                           <input type="hidden" id="opt" name="opt" value="0>">

                           <div class="alert alert-danger">Etes-vous sur de bien vouloir effectuer cette operation ?</div>
                           <div class="clear20"></div>
                           <div class="form-group">
                              <button id="editpassbutton" name="editpassbutton" class="btn btn-primary floatL mgR20">Confirmer</button>
                              <a href="<?php echo SITE;?>admin/evaluations/" class="btn btn-danger floatR">Annuler</a>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
