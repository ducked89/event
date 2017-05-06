 <?php  
    $mCritere = (object)($datas['mdatas']);
?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Criteres</h2>
        <small>Liste des criteres d'évènements des organisateurs</small>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Edit crietere d'évènement</h3>
                </div>
                <div class="ibox-content col-lg-7">
                    <?php

                        if(isset($datas['error']['error']))
                        echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                            <div class='clear50'></div>";

                        if(isset($datas['error']['existe']))
                        echo "<div class='alert alert-info'>Erreur dans l'enregistrement de ce critere.</div>
                            <div class='clear50'></div>";                            

                    ?>
                    <form class="form-horizontal" action="<?php echo SITE;?>admin/criteres/edit/?idu=<?= $mCritere->id;?>" method="POST"  >
                            <input type="hidden" id="idu" name="idu" value="<?= $mCritere->id ?>">
                            <div class="clear20"></div>
                            
                            <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                <div class="col-lg-10"><input  name="title" placeholder="Titre du critere" required class="form-control" value="<?= $mCritere->title;?>" type="text"> </div>
                            </div>
                            

                            <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10"><textarea  name="description" required class="form-control sm-textarea"><?= $mCritere->description;?></textarea></div>
                            </div>

            				<div class="clear20"></div>

                           <div class="form-group"><label class="col-sm-2 control-label">Statut</label>
            	                <div class="col-sm-10"><select class="form-control m-b" name="statut">
            	                   <option <?php if($mCritere->statut==1) echo'selected="selected"';?> value="1">Actif</option>
                                   <option <?php if($mCritere->statut==0) echo'selected="selected"';?> value="0">Inactif</option>
            	                </select>
            	                </div>
            	            </div>

            				<div class="clear20"></div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button name="saveCritere" class="btn btn-w-m btn-success mgR20" type="submit">Modifier</button>

                                     <a href="<?= SITE;?>admin/criteres/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

