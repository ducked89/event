 <?php  
    $mEvaluation = (object)($datas['mdatas']);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evènements</h2>
        <small>Liste des évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-warning btn-sm floatR ">Mentions des notes</a>

        <a href="<?= SITE;?>admin/evaluations/">
        <button class="btn btn-sm btn-success floatR mgR20" type="button"><i class="fa fa-list mgR10"></i> 
        <span class="bold"> Liste Evènements</span></button></a>       
    </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row row-bg">
        <div class="clear20"></div>
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
            	    <div class="clear20"></div>
                        <h3>Editer un évènement</h3>
                    </div>
                    <div class="ibox-content col-lg-12">

                        <div class="col-lg-7">
                            <?php

                                if(isset($datas['error']['error']))
                                echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                                    <div class='clear50'></div>";

                                if(isset($datas['error']['existe']))
                                echo "<div class='alert alert-info'>Il existe deja une evaluation pour ce profil avec les memes caracteristiques.</div>
                                    <div class='clear50'></div>";                            

                            ?>
                            <form class="form-horizontal" action="<?php echo SITE;?>admin/evaluations/edit/?idu=<?= $mEvaluation->id;?>" method="POST"  >
                                    <div class="clear20"></div>
                                    
                                    <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                        <div class="col-lg-10">
                                            <input  name="title" placeholder="Titre de l'évaluation" required class="form-control" type="text" value="<?= $mEvaluation->title;?>" />
                                            <i>Ex: Evaluation - Jean Phillippe - Avril 2017</i>
                                            <?php if(isset($datas['error']['title'])) echo '<span class="infored">Champ obligatoire !</span>';?>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>
                                    
                                   <div class="form-group"><label class="col-sm-2 control-label">Evalué(e)</label>
                                        <div class="col-sm-10"><select class="form-control m-b" name="idevalue">
                                            <?php
                                                unset($datas['users'][0]);
                                                foreach ($datas['users'] as $mUser) {
                                                   echo'<option value="'.$mUser->id.'"';
                                                   if($mEvaluation->idevalue==$mUser->id) echo 'selected="selected"';
                                                   echo '>'.$mUser->firstname.' '.$mUser->lastname.'</option>';
                                                }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Evaluateur</label>
                                        <div class="col-sm-10"><select class="form-control m-b col-lg-10" name="idevaluateur">
                                            <?php
                                                foreach ($datas['users'] as $mUser) {
                                                   echo'<option value="'.$mUser->id.'"';
                                                   if($mEvaluation->idevaluateur==$mUser->id) echo 'selected="selected"';
                                                   echo '>'.$mUser->firstname.' '.$mUser->lastname.'</option>';
                                                }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Profil de ponderation</label>
                                        <div class="col-sm-10"><select class="form-control m-b col-lg-10" name="idponderation">
                                            <?php
                                                foreach ($datas['ponderations'] as $mPonderation) {
                                                   echo'<option value="'.$mPonderation->id.'"';
                                                   if($mEvaluation->idponderation==$mPonderation->id) echo 'selected="selected"';
                                                   echo '>'.$mPonderation->title.'</option>';
                                                }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                     <div class="form-group"><label class="col-sm-2 control-label">Periode (mois)</label>
                                        <div class="col-sm-10">
                                        <select class="select2_demo_1  form-control m-b col-lg-10" name="mois">
                                            <option value="1" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==1)?'selected="selected"':"";?>>Janvier</option>
                                            <option value="2" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==2)?'selected="selected"':"";?>>Fevrier</option>
                                            <option value="3" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==3)?'selected="selected"':"";?>>Mars</option>
                                            <option value="4" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==4)?'selected="selected"':"";?>>Avril</option>
                                            <option value="5" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==5)?'selected="selected"':"";?>>Mai</option>
                                            <option value="6" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==6)?'selected="selected"':"";?>>Juin</option>
                                            <option value="7" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==7)?'selected="selected"':"";?>>Juillet</option>
                                            <option value="8" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==8)?'selected="selected"':"";?>>Aout</option>
                                            <option value="9" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==9)?'selected="selected"':"";?>>Septembre</option>
                                            <option value="10" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==10)?'selected="selected"':"";?>>Octobre/<option>
                                            <option value="11" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==11)?'selected="selected"':"";?>>Novembre</option>
                                            <option value="12" <?= (isset($mEvaluation->mois) && $mEvaluation->mois==12)?'selected="selected"':"";?>>Decembre</option>

                                        </select>
                                        <?php
                                        if(isset($datas['error']['mois']))
                                         echo "<br/><span class='infored'>Ce champ est obligatoire.</div>";
                                        ?>
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Periode (Annee)</label>
                                        <div class="col-sm-10">
                                        <select class="select2_demo_1  form-control m-b col-lg-10" name="annee">
                                            <?php
                                            for($i=2017; $i<=2030; $i++)
                                            {
                                                echo'<option value="'.$i.'"';
                                                if(isset($mEvaluation->annee) && $mEvaluation->annee==$i) echo 'selected="selected"';
                                                echo '>'.$i.'</option>';
                                            }

                                            ?>
                                         </select>
                                        <?php
                                        if(isset($datas['error']['mois']))
                                         echo "<br/><span class='infored'>Ce champ est obligatoire.</div>";
                                        ?>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>



                                    <div class="form-group" id="targetDate">
                                        <label class="col-sm-2 control-label mgR20">Delaie de finalisation</label>
                                        <div class="input-group date col-sm-8">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control disable" name="targetdate" id="targetFinaldate"  value="<?= date_format(date_create($mEvaluation->targetdate),"Y-m-d"); ?>"> 
                                        </div>
                                    </div>
                                    <div class="clear20"></div>



                                    <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                        <div class="col-lg-10"><textarea  name="commentaire" class="form-control sm-textarea"><?= $mEvaluation->commentaire;?></textarea></div>
                                    </div>

                                    <div class="clear20"></div>


                                    <div class="clear20"></div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button name="saveEvaluation" class="btn btn-w-m btn-success mgR20" type="submit">Modifier</button>

                                             <a href="<?= SITE;?>admin/evaluations/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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
</div>


 <script>
    $(document).ready(function(){

        $('#targetDate .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>