<?php
$myEvaluation = (object)($datas['evaluations'][0]);
$myEvalue = (object)($myEvaluation->evalue);

?>

<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Evènement</h2><br/>
       <a class="btn btn-success pull-right mgR20" href="<?php echo SITE;?>admin/evaluations">Liste évènements</a>
       <h3>Statts.. pour : <?= $myEvaluation->title;?></h3>
   </div>
</div>


<div class="row">
<div class="col-lg-12">
   <div class="wrapper wrapper-content animated fadeInRight">

       <!-- Profil header -->
       <div class="row m-b-lg m-t-lg">
       <?php

           if(isset($_GET['nf']) && $_GET['nf']=="yes"){

           }
           else
               echo '
           <a class="btn btn-success pull-right mgR20"
           href="'.SITE.'admin/evaluations/summarize/?idu='.$myEvalue->id.'&mois='.(isset($datas["mois"])?$datas["mois"]:1).'&annee='.(isset($datas["annee"])?$datas["annee"]:2017).'">
           <i class="fa fa-list mgR10"></i>Version resume</a>';?>



          <!--  &mois=".(isset($datas["mois"])?$datas["mois"]:1)."
           &annee=".(isset($datas["annee"])?$datas["annee"]:2017) -->


           <div class="col-md-6">

               <div class="profile-image">
                   <img src="<?php
                   echo SITE.'public/images/profiles/';
                   if(!empty($myEvalue->photo)) echo $myEvalue->photo;
                   else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
               </div>

               <div class="profile-info">
                   <div class="">
                       <h2 class="no-margins"><?= $myEvalue->firstname.' '.$myEvalue->lastname;?></h2>
                      <br/>
                       Position: <strong><?= $myEvalue->position;?></strong>
                   </div>

               </div>
           </div>


           <div class="col-lg-6 pull-right">
           <div class="clear20"></div>
               <form action="<?=SITE;?>admin/evaluations/overview/" method="GET">
               <input type="hidden" name="idu" value="<?=$myEvalue->id;?>">
                   <div class="col-md-12">
                       <div class="form-group">
                           <label class="col-sm-2 control-label mgR10">Periode (mois/annee)</label>
                           <div class="col-sm-8">
                               <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-6" name="mois">
                                  <option value="1" <?=(isset($datas['mois']) && $datas['mois']==1)?'selected="selected"':'';?>  >Janvier</option>
                                   <option value="2" <?=(isset($datas['mois']) && $datas['mois']==2)?'selected="selected"':'';?> >Fevrier</option>
                                   <option value="3" <?=(isset($datas['mois']) && $datas['mois']==3)?'selected="selected"':'';?> >Mars</option>
                                   <option value="4" <?=(isset($datas['mois']) && $datas['mois']==4)?'selected="selected"':'';?> >Avril</option>
                                   <option value="5" <?=(isset($datas['mois']) && $datas['mois']==5)?'selected="selected"':'';?> >Mai</option>
                                   <option value="6" <?=(isset($datas['mois']) && $datas['mois']==6)?'selected="selected"':'';?> >Juin</option>
                                   <option value="7" <?=(isset($datas['mois']) && $datas['mois']==7)?'selected="selected"':'';?> >Juillet</option>
                                   <option value="8" <?=(isset($datas['mois']) && $datas['mois']==8)?'selected="selected"':'';?> >Aout</option>
                                   <option value="9" <?=(isset($datas['mois']) && $datas['mois']==9)?'selected="selected"':'';?> >Septembre</option>
                                   <option value="10" <?=(isset($datas['mois']) && $datas['mois']==10)?'selected="selected"':'';?> >Octobre</option>
                                   <option value="11" <?=(isset($datas['mois']) && $datas['mois']==11)?'selected="selected"':'';?> >Novembre</option>
                                   <option value="12" <?=(isset($datas['mois']) && $datas['mois']==12)?'selected="selected"':'';?> >Decembre</option>
                               </select></div>

                               <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-6 pull-right" name="annee">
                                   <?php
                                   for($i=2017; $i<=2030; $i++)
                                   {
                                       echo'<option value="'.$i.'"';
                                       if(isset($datas['annee']) && $datas['annee']==$i)
                                           echo 'selected="selected"';
                                       echo'>'.$i.'</option>';
                                   }

                                   ?>
                                </select></div>
                               <div class="clear20"></div>
                               <div class="col-sm-6"><button type="submit" class="btn btn-valid" >Valider</button></div>
                           </div>
                   </div>
                   </div>
               </form>
           </div>

       </div>

           <?php
              if(isset($_GET['nf']) && $_GET['nf']=="yes")
               echo '<div class="clear20"></div><div class="alert alert-warning">Aucune evaluation trouvée pour cette periode.</a><div class="clear20"></div>';
              else if(isset($_GET['fd']) && $_GET['fd']=="no")
               echo '<div class="clear20"></div><div class="alert alert-warning">Aucun évènement trouvé pour cette periode. Essayer avec une autre periode.</a><div class="clear20"></div>';
               else{?>

               <div class="row">
                   <div class="ibox float-e-margins">
                       <div class="ibox-content">
                           <div class="ibox-title"><h3>Statistique de l'évènement </h3></div>
                           <div class="row"> <div class="col-lg-12">
                           <div class="alert alert-warning"> Legende : <small> <strong>--</strong> Aucune note n'a été saisie. | <strong>0</strong> Non applicable  </small></div></div>
                       </div>
                           <table class="table table-bordered">
                               <thead>
                               <tr>
                                   <th>#</th>
                                   <th class="main-column">Criteres</th>
                                   <?php
                                       $i=0;
                                       foreach ($datas['evaluations'] as $mEval) {
                                          echo'<th><a href="'.SITE.'admin/evaluations/view/?idu='.$mEval->id.'">EVAL. '.$i.'</a></th>';
                                          $i++;
                                       }
                                       echo '<th class="column-premiere">MOY</th>';

                                       // Tableau du traitement des notes
                                       $i=0;
                                       foreach ($datas['evaluations'] as $mEval) {
                                          echo'<th><a href="'.SITE.'admin/evaluations/view/?idu='.$mEval->id.'">V. EVAL. '.$i.'</a></th>';
                                          $i++;
                                       }
                                       echo '<th class="column-finale">MOY. F</th>';
                                   ?>
                               </tr>
                               </thead>
                               <tbody>

                                <?php

                                   // Parcourir la liste des criteres
                                   if(count($datas['criteres'])>0)
                                   {
                                       $j = 1; $qte = 0; $somme=0;  $noteInvalid=0; $totalMoy=0;
                                       $qte2 = 0; $somme2=0; $noteInvalid2=0; $totalMoy2=0;
                                       // Affichage des notes par criteres
                                       foreach ($datas['criteres'] as $myCritere) {
                                           echo'

                                               <tr class="fluid">
                                                   <td>'.$j.'</td>
                                                   <td>'.$myCritere->title.'</td>
                                                   ';
                                                   $i=0;
                                                   // Parcourir la listes des evaluations pour affiches les notes par crietere
                                                   foreach ($datas['evaluations'] as $cEvaluation) {

                                                       if(isset($cEvaluation->notes) && count($cEvaluation->notes)>0)
                                                       {
                                                          $mNotes =  $cEvaluation->notes;
                                                           echo '<td>';

                                                           // Affichage des notes
                                                           foreach ($mNotes as $cNote) {
                                                              if( ($cNote->idcritere == $myCritere->id) &&
                                                                ($cNote->idevaluation == $cEvaluation->id) )
                                                                {
                                                                   if($cNote->notes!=100)
                                                                   {
                                                                       echo $cNote->notes;
                                                                       $somme= $somme+$cNote->notes;

                                                                   } else if($cNote->notes==100)
                                                                   {
                                                                       echo "0";
                                                                       $somme= $somme+0;

                                                                   }
                                                                   else echo "--";
                                                                    $qte++;
                                                                }
                                                               if(($cNote->notes==0) || ($cNote->notes==100)) $noteInvalid++;
                                                               $datas['evaluations'][$i]->noteInvalid=$noteInvalid;
                                                           }
                                                           echo '</td>';

                                                       }
                                                       else{
                                                           echo '<td>--</td>';
                                                           $datas['evaluations'][$i]->noteInvalid= $noteInvalid;
                                                       }
                                                       $noteInvalid=0;
                                                       $i++;
                                                   }

                                                   // Moyenne de chanque critere
                                                   $moy = ($qte==0?0:number_format((float)($somme/$qte), 2, '.', ''));
                                                   $datas['criteres'][($j-1)]->moyenne = $moy;
                                                   $myCritere->moyenne = $moy;

                                                   // Moyenne des moynnes
                                                   $totalMoy = $totalMoy+$moy;
                                                   echo'<td class="main-column-info column-premiere">'.$moy.'</td>';
                                                   $qte = 0; $somme=0;

                                                   // Affichage du traitement des notes
                                                   // Parcourir la listes des evaluations pour affiches les notes par crietere
                                                   $k=0;
                                                   foreach ($datas['evaluations'] as $cEvaluation) {

                                                       if(isset($cEvaluation->notes) && count($cEvaluation->notes)>0)
                                                       {
                                                          $mNotes =  $cEvaluation->notes;
                                                           echo '<td>';

                                                            // Verification de la validite de chaque evaluations
                                                           if($cEvaluation->noteInvalid > 3){ echo '--';}
                                                           else{
                                                               // Affichage des notes de l'evaluation
                                                               foreach ($mNotes as $cNote) {

                                                                   if( ($cNote->idcritere == $myCritere->id) &&
                                                                    ($cNote->idevaluation == $cEvaluation->id) )
                                                                    {
                                                                       if(($cNote->notes!=100) && ($cNote->notes!=100))
                                                                       {
                                                                           // Verification de la validite de chaque notes
                                                                           if(abs($myCritere->moyenne - $cNote->notes)<3)
                                                                           {
                                                                               echo $cNote->notes;
                                                                               $qte2++;
                                                                               $somme2= $somme2+$cNote->notes;
                                                                           }
                                                                           else {
                                                                               echo '<span class="infoalert">--</span>';
                                                                           }

                                                                       }
                                                                       else echo "--";
                                                                    }
                                                                   if($cNote->notes==0) $noteInvalid2++;
                                                                    $datas['evaluations'][$k]->noteInvalid2=$noteInvalid2;
                                                               }

                                                           }
                                                           echo '</td>';

                                                       }
                                                       else{
                                                           echo '<td>--</td>';
                                                            $datas['evaluations'][$k]->noteInvalid2="--";
                                                       }
                                                       $noteInvalid=0;
                                                       $k++;
                                                   }

                                                    // Moyenne de chanque critere
                                                   $moy2 = ($qte2== 0 ? '0' : number_format((float)($somme2/$qte2), 2, '.', ''));

                                                   $datas['criteres'][($j-1)]->moyenne2 = $moy2;
                                                   $myCritere->moyenne2 = $moy2;

                                                   // Moyenne des moyennes
                                                   $totalMoy2 = $totalMoy2+$moy2;
                                                   echo'<td class="main-column-info column-valid">'.$moy2.'</td>';
                                                   $qte2 = 0; $somme2=0;


                                           echo'</tr>';
                                           $j++;

                                       }

                                   }
                                   else{
                                        echo'<tr>
                                               <td colspan="'.(count($datas['evaluations'])*2).'">
                                                   <div class="clear20"></div>
                                                   <div class="center alert alert-warning">Aucune donnee disponible !</div>
                                                   <div class="clear20"></div>
                                               </td>
                                           </tr>';
                                   }
                               ?>
                               <tr class="ending">
                                   <td colspan="2">Notes invalides</td>
                                    <?php
                                       // var_dump($datas['evaluations']); die();
                                       foreach ($datas['evaluations'] as $cEvaluation) {
                                           echo'<td>'.$cEvaluation->noteInvalid.'</td>';
                                       }

                                   ?>
                                   <td><?= number_format((float)($totalMoy/count($datas['criteres'])), 2, '.', '');?></td>

                                    <?php
                                      // var_dump($datas['evaluations']); die();
                                       foreach ($datas['evaluations'] as $cEvaluation) {
                                           echo'<td>-</td>';
                                       }

                                       $qteValid=0;
                                        foreach ($datas['criteres'] as $mCritere) {
                                           if($mCritere->moyenne2 != '0')
                                               $qteValid++;
                                       }
                                        $qteValid=(($qteValid==0)?1:$qteValid);

                                   ?>
                                   <td><?=number_format((float)($totalMoy2/$qteValid), 2, '.', '');?></td>
                               </tr>

                               </tbody>
                           </table>

                       </div>

                   </div>
               </div>
               <?php }?>


       </div>
   </div>
</div>
