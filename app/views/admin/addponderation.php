 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Pondérations</h2>
        <small>Liste des pondérations d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/ponderations/" class="btn btn-primary btn-sm floatR">Liste pondérations</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Créer un profil de pondération</h3>
                    <span>Cet objet va vous permettre de définir un pourcentage de note de chaque critères affectés.</span>
                </div>
                <div class="ibox-content col-lg-12">
                    <div class=" col-lg-7">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez vérifier vos saisies.</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['existe']))
                            echo "<div class='alert alert-info'>Il existe déjà un profil de pondération avec le même titre.</div>
                                <div class='clear50'></div>";                            

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/ponderations/add/" method="POST"  >
                                <div class="clear20"></div>
                                
                                <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                    <div class="col-lg-10"><input  name="title" placeholder="Titre du profil de pondération" required class="form-control" type="text"> </div>
                                </div>
                                

                                <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  name="description" class="form-control sm-textarea"></textarea></div>
                                </div>

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="createPonderation" class="btn btn-w-m btn-success mgR20" type="submit">Créer</button>

                                         <a href="<?= SITE;?>admin/ponderations/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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

