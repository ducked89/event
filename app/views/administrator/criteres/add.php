<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Critères</h2>
        <small>Liste des critères d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/criteres/" class="btn btn-primary btn-sm floatR mgR20">Liste critères</a>
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h3>Ajout d'un critère d'évènement</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-7">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez verifier vos saisies.</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['existe']))
                            echo "<div class='alert alert-info'>Il existe déjà un critère avec le même titre.</div>
                                <div class='clear50'></div>";

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/criteres/add/" method="POST"  >
                                <div class="clear20"></div>

                                <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                    <div class="col-lg-10"><input  name="title" placeholder="Titre du critère" required class="form-control" type="text"> </div>
                                </div>


                                <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  name="description" required class="form-control sm-textarea"></textarea></div>
                                </div>

                				<div class="clear20"></div>

                               <div class="form-group"><label class="col-sm-2 control-label">Statut</label>
                	                <div class="col-sm-10"><select class="form-control m-b" name="statut">
                	                   <option value="1">Actif</option>
                                       <option value="0">Inactif</option>
                	                </select>
                	                </div>
                	            </div>

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="createCritere" class="btn btn-w-m btn-success mgR20" type="submit">Creer</button>

                                         <a href="<?= SITE;?>admin/criteres/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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
