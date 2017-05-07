 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Mentions</h2>
        <small>Liste des mentions/notes pour les critères d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-primary btn-sm floatR mgR20">Mentions des notes</a>
        
    </div>
</div>


<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Ajouter une mention de note</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-7">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez vérifier vos saisies.</div>
                                <div class='clear20'></div>";

                            if(isset($datas['error']['existe']))
                            echo "<div class='alert alert-danger'>Il existe déjà une mention avec le même titre ou la même note.</div>
                                <div class='clear20'></div>";                            

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/mentions/add/" method="POST"  >
                                <div class="clear20"></div>
                                
                                <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                    <div class="col-lg-10"><input  name="title" placeholder="Titre de la mention" required class="form-control" type="text"> </div>
                                </div>
                                <div class="clear20"></div>

                               <div class="form-group"><label class="col-sm-2 control-label">Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="level">
                                       
                                           <?php 
                                           for ($i=0; $i <= 10; $i++) { 
                                             echo '<option value="'.$i.'">'.$i.'</option>';
                                           }

                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  name="description" required class="form-control sm-textarea"></textarea></div>
                                </div>

                				

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="createMention" class="btn btn-w-m btn-success mgR20" type="submit">Creer</button>

                                         <a href="<?= SITE;?>admin/mentions/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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

