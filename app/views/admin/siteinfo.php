<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Parametres</h2>
        <small>Definir les parametres du système</small>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-success btn-sm floatR "><i class="fa fa-home mgR10"></i>Dashboard</a>
    </div>
</div>
<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h3>Modifier les informations générales</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-8">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['saved']))
                            echo "<div class='alert alert-info'>Oups ! Une erreur s'est produite. Veuillez re-essayer.</div>
                                <div class='clear50'></div>"; 

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/parametres/info/" method="POST"  >
                                <div class="clear20"></div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Interface login</label>
                                    <div class="col-sm-10"><select class="form-control m-b" name="login">
                                       <option value="1" <?=($datas['site']->login==1)?'selected="selected"':"";?>>Classic</option>
                                       <option value="0" <?=($datas['site']->login==0)?'selected="selected"':"";?>>Simplifié</option>
                                    </select>
                                    </div>
                                </div>


                                <div class="form-group"><label class="col-lg-2 control-label">Info accueil</label>
                                    <div class="col-lg-10">
                                    <textarea  name="accueil"  class="form-control sm-textarea"><?=(!empty($datas['site']->accueil))?$datas['site']->accueil:"";?></textarea></div>
                                </div>

                				<div class="clear20"></div>
                                  <div class="form-group"><label class="col-lg-2 control-label">Contact(Gauche)</label>
                                    <div class="col-lg-10">
                                    <textarea  name="contact1"  class="form-control sm-textarea"><?=(!empty($datas['site']->contact1))?$datas['site']->contact1:"";?></textarea></div>
                                </div>

                                <div class="clear20"></div>
                                  <div class="form-group"><label class="col-lg-2 control-label">Contact(Droite)</label>
                                    <div class="col-lg-10">
                                    <textarea  name="contact2"  class="form-control sm-textarea"><?=(!empty($datas['site']->contact2))?$datas['site']->contact2:"";?></textarea></div>
                                </div>

                                <div class="clear50"></div>
                                 <div class="clear20"></div>
                                  <div class="form-group"><label class="col-lg-2 control-label">Note disciplinaires</label>
                                    <div class="col-lg-10">
                                    <textarea  name="notice"  class="form-control sm-textarea"><?=(!empty($datas['site']->notice))?$datas['site']->notice:"";?></textarea></div>
                                </div>

                              

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input name="changeInfo" class="btn btn-w-m btn-success mgR20" type="submit" value="Modifier">

                                         <a href="<?= SITE;?>admin/parametres/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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

