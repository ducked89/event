 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Services</h2>
        <small>Liste des différents services/départements de l'HEC</small>
        <a href="<?php echo SITE;?>admin/employes/" class="btn btn-warning btn-sm floatR">Liste employés</a>
        <a href="<?php echo SITE;?>admin/services/" class="btn btn-primary btn-sm floatR mgR20">Liste Services</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Ajout d'un service/département</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-7">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez vérifier vos saisies.</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['existe']))
                            echo "<div class='alert alert-info'>Il existe déjà un service avec le même titre.</div>
                                <div class='clear50'></div>";                            

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/services/add/" method="POST"  >
                                <div class="clear20"></div>
                                
                                <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                    <div class="col-lg-10"><input  name="title" placeholder="Titre du critère" required class="form-control" type="text"> </div>
                                </div>
                                

                                <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  name="description" class="form-control sm-textarea"></textarea></div>
                                </div>

                				<div class="clea50"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="createService" class="btn btn-w-m btn-success mgR20" type="submit">Créer</button>

                                         <a href="<?= SITE;?>admin/services/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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

