 <?php  
    $mService = (object)($datas['mdatas']);
?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Services</h2>
        <small>Liste des differents service/departements de l'HEC</small>
        <a href="<?php echo SITE;?>admin/employes/" class="btn btn-warning btn-sm floatR">Liste organisateurs</a>
        <a href="<?php echo SITE;?>admin/services/" class="btn btn-primary btn-sm floatR mgR20">Liste Services</a>
        
    </div>
</div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Editer service</h3>
                </div>
                <div class="ibox-content col-lg-7">
                    <?php

                        if(isset($datas['error']['error']))
                        echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                            <div class='clear50'></div>";

                        if(isset($datas['error']['existe']))
                        echo "<div class='alert alert-info'>Erreur dans l'enregistrement de ce service.</div>
                            <div class='clear50'></div>";                            

                    ?>
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/services/edit/?idu=<?= $mService->id;?>" method="POST"  >
                            <input type="hidden" id="idu" name="idu" value="<?= $mService->id ?>">
                            <div class="clear20"></div>
                            
                            <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                <div class="col-lg-10"><input  name="title" placeholder="Titre du critere" required class="form-control" value="<?= $mService->title;?>" type="text"> </div>
                            </div>
                            

                            <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10"><textarea  name="description"  class="form-control sm-textarea"><?= $mService->description;?></textarea></div>
                            </div>

            				<div class="clear50"></div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button name="saveService" class="btn btn-w-m btn-success mgR20" type="submit">Modifier</button>

                                     <a href="<?= SITE;?>admin/services/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

