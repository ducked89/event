 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evènements</h2>
        <small>Ajoute &agrave; la liste des évènements d'un organisateur.</small>
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
                        <h3>Créer un évènement</h3>
                    </div>
                    <div class="ibox-content col-lg-12">

                        <div class="col-lg-7">
                            <?php

                                if(isset($datas['error']['error']))
                                echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez verifier vos saisies.</div>
                                    <div class='clear50'></div>";

                                if(isset($datas['error']['existe']))
                                echo "<div class='alert alert-info'>Il existe déjà un évènement pour ce profil avec les mêmes caractéristiques.</div>
                                    <div class='clear50'></div>"; 

                                if(isset($datas['error']['limit']))
                                echo "<div class='alert alert-danger'>Oups ! Desolé, mais vous avez atteint le nombre d'évènements par organisateur.</div>
                                    <div class='clear50'></div>";                            

                            ?>
                            <form class="form-horizontal" action="<?php echo SITE;?>admin/evaluations/add/" method="POST"  >
                                    <div class="clear20"></div>
                                    
                                    <div class="form-group"><label class="col-lg-4 control-label">Titre &eacute;v&egrave;nement</label>
                                        <div class="col-lg-8">
                                        <input  name="title" placeholder="Titre de l'évènement" required class="form-control" type="text" <?php if(isset($datas['title'])) echo 'value="'.$datas['title'].'"';?> />
                                        <i>Ex: Evènement - Jean Phillippe - Mai 2017 par Paul Jeanne</i></div>
                                    </div>
                                    <div class="clear20"></div>
                                    
                                   <div class="form-group"><label class="col-sm-4 control-label">Organisateur &eacute;v&egrave;nement</label>
                                        <div class="col-sm-8">
                                        <select class="select2_demo_1 form-control m-b" name="idevalue">
                                            <?php
                                                unset($datas['users'][0]);
                                                foreach ($datas['users'] as $mUser) {
                                                   echo'<option value="'.$mUser->id.'"';
                                                   if(isset($datas['idevalue']) && $datas['idevalue']==$mUser->id) echo 'selected="selected"';
                                                   echo '>'.$mUser->firstname.' '.$mUser->lastname.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <?php
                                        if(isset($datas['error']['idevalue']))
                                         echo "<br/><span class='infored'>Ce champ est obligatoire.</div>";
                                        ?>
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Adresse &eacute;v&egrave;nement</label>
                                        <div class="col-lg-8">
                                            <input  name="adresse" placeholder="#34, Rue Jean Paul 1, Pacot, Port-au-Prince" class="form-control" type="text"> 
                                        </div>
                                    </div>
                                    <div class="clear20"></div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Point vente de billet</label>
                                        <div class="fileinput fileinput-new col-sm-8" data-provides="fileinput">
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Choisir</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image"/></span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                        </div> 
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group">
                                        <label class="col-lg-4 control-label">Point vente de billet</label>
                                        <div class="col-lg-8">
                                            <input  name="adresse" placeholder="#34, Rue Jean Paul 1, Pacot, Port-au-Prince" class="form-control" type="text"> 
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <!-- <div class="form-group"><label class="col-sm-2 control-label">Période (mois)</label>
                                        <div class="col-sm-10">
                                        <select class="select2_demo_1  form-control m-b col-lg-10" name="mois">
                                            <option value="1" <?php // echo (isset($datas['mois']) && $datas['mois']==1)?'selected="selected"':"";?>>Janvier</option>
                                            <option value="2" <?php // echo (isset($datas['mois']) && $datas['mois']==2)?'selected="selected"':"";?>>Fevrier</option>
                                            <option value="3" <?php // echo (isset($datas['mois']) && $datas['mois']==3)?'selected="selected"':"";?>>Mars</option>
                                            <option value="4" <?php // echo (isset($datas['mois']) && $datas['mois']==4)?'selected="selected"':"";?>>Avril</option>
                                            <option value="5" <?php // echo (isset($datas['mois']) && $datas['mois']==5)?'selected="selected"':"";?>>Mai</option>
                                            <option value="6" <?php // echo (isset($datas['mois']) && $datas['mois']==6)?'selected="selected"':"";?>>Juin</option>
                                            <option value="7" <?php // echo (isset($datas['mois']) && $datas['mois']==7)?'selected="selected"':"";?>>Juillet</option>
                                            <option value="8" <?php // echo (isset($datas['mois']) && $datas['mois']==8)?'selected="selected"':"";?>>Aout</option>
                                            <option value="9" <?php // echo (isset($datas['mois']) && $datas['mois']==9)?'selected="selected"':"";?>>Septembre</option>
                                            <option value="10" <?php // echo (isset($datas['mois']) && $datas['mois']==10)?'selected="selected"':"";?>>Octobre</option>
                                            <option value="11" <?php // echo (isset($datas['mois']) && $datas['mois']==11)?'selected="selected"':"";?>>Novembre</option>
                                            <option value="12" <?php // echo (isset($datas['mois']) && $datas['mois']==12)?'selected="selected"':"";?>>Decembre</option>

                                        </select>
                                        <?php
                                        // if(isset($datas['error']['mois']))
                                        //  echo "<br/><span class='infored'>Ce champ est obligatoire.</div>";
                                        ?>
                                        </div>
                                    </div> -->

                                    <!-- <div class="form-group"><label class="col-sm-2 control-label">Période (Année)</label>
                                        <div class="col-sm-10">
                                        <select class="select2_demo_1  form-control m-b col-lg-10" name="annee">
                                            <?php
                                            // for($i=2017; $i<=2030; $i++)
                                            // {
                                            //     echo'<option value="'.$i.'"';
                                            //     if(isset($datas['annee']) && $datas['annee']==$i) echo ' selected="selected" ';
                                            //     echo '>'.$i.'</option>';
                                            // }

                                            ?>
                                         </select>
                                        <?php
                                        // if(isset($datas['error']['mois']))
                                        //  echo "<br/><span class='infored'>Ce champ est obligatoire.</div>";
                                        ?>
                                        </div>
                                    </div>
                                    <div class="clear20"></div> -->
                                    <div class="form-group" id="targetDate">
                                        <label class="col-lg-4 control-label mgR20">Heure</label>
                                        <div id="datepicker" class="input-group clockpicker input-daterange" >
                                            <input class="input-sm form-control stat" name="start" value="09:30" type="text" data-autoclose="true">
                                            <span class="input-group-addon">&agrave;</span>
                                            <input class="input-sm form-control end" name="end" value="09:30" type="text" data-autoclose="true">
                                            <!-- <span class="input-group-addon">
                                                <span class="fa fa-clock-o"></span>
                                            </span>
                                            <input class="form-control col-lg-7" value="09:30" type="text"> -->
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group" id="targetDate">
                                        <label class="col-lg-4 control-label mgR20">Date de d&eacute;but</label>
                                        <div class="input-group date col-lg-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control disable" name="targetdate" id="targetFinaldate"  value="<?php echo date("Y-m-d");?>"> 
                                        </div>
                                    </div>
                                    <div class="clear20"></div>

                                    <div class="form-group" id="targetDatefin">
                                        <label class="col-lg-4 control-label mgR20">Date de fin</label>
                                        <div class="input-group date col-lg-7">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control disable" name="targetdate" id="targetFinaldate"  value="<?php echo date("Y-m-d");?>"> 
                                        </div>
                                    </div>
                                    <div class="clear20"></div>



                                    <div class="form-group"><label class="col-lg-4 control-label">Description de l'&eacute;v&egrave;nement</label>
                                        <div class="col-lg-8"><textarea  name="commentaire" class="form-control sm-textarea"></textarea><?php if(isset($datas['commentaire'])) echo $datas['commentaire'];?></div>
                                    </div>

                                    <div class="clear20"></div>


                                    <div class="clear20"></div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button name="createEvaluation" class="btn btn-w-m btn-success mgR20" type="submit">Créer</button>

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
<!-- Clock picker -->
    <script src="js/plugins/clockpicker/clockpicker.js"></script>

 <script>
    $(document).ready(function(){

       // var today = moment().format('yyyy-mm-dd');
       //today.format('yyyy-mm-dd');

      //  alert(today);
        

        $('#targetDate .input-group.date').datepicker({
            format: "yyyy-mm-dd",
            startDate: '+5d',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
           // minDate : new Date(),
            
            autoclose: true
        });

        $('#targetDatefin .input-group.date').datepicker({
            format: "yyyy-mm-dd",
            startDate: '+5d',
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
           // minDate : new Date(),
            
            autoclose: true
        });

        $('.clockpicker .input-sm.stat').clockpicker();
        $('.clockpicker .input-sm.end').clockpicker();

    });
</script>