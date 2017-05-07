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
           <a class="btn btn-info pull-right floatR" target="_blanK" href="<?= SITE;?>admin/evaluations/print/?idu=<?= $myEvalue->id;?>">Imprimer</a>
           <a class="btn btn-success pull-right mgR20" href="<?php echo SITE.'admin/evaluations/overview/?idu='.$myEvalue->id;?>">Details</a>

           <div class="col-md-7">

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
       </div>


            <div class="row">
               <div class="ibox float-e-margins">
                   <div class="ibox-content">
                       <div class="ibox-title"><h3>Resume de l'évènement </h3></div>

                       <div class="row"> <div class="col-lg-12">
                           <div class="alert alert-warning"> Legende : <small> <strong>--</strong> l'evaluateur n'a pas encore choisi de notes. | <strong>0</strong> Non applicable  </small></div></div>
                       </div>
                       <table class="table table-bordered">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th class="main-column">Criteres</th>
                               <?php
                                   if(isset($datas['auto'])) echo '<th>AUTO</th>';
                                   for ($i=1; $i<count($datas['evaluations']); $i++) {
                                      echo'<th>EVAL. '.$i.'</th>';
                                   }
                                   echo '<th class="column-premiere">MOY. EVAL</th>
                                   <th class="column-finale">MOY. NOTES</th>
                                   <th class="column-finale">MOY. POND.</th>';
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
                                               $i=0; $totalNotesPonderes = 0;
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

                                                                   foreach ($cEvaluation->ponderation as $mPonderation) {
                                                                       if($cNote->idcritere==$mPonderation->idcriteres)
                                                                       {
                                                                           $totalNotesPonderes = $totalNotesPonderes +($cNote->notes*$mPonderation->percent)/10;

                                                                       echo " => ".$mPonderation->percent." = " .$totalNotesPonderes +(($cNote->notes*$mPonderation->percent)/10)." - ".$mPonderation->percent;
                                                                       }
                                                                   }

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
                                                        // Verification de la validite de chaque evaluations
                                                       if($cEvaluation->noteInvalid > 3){ }
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
                                                                           $qte2++;
                                                                           $somme2= $somme2+$cNote->notes;
                                                                       }

                                                                   }
                                                                }
                                                               if($cNote->notes==0) $noteInvalid2++;
                                                                $datas['evaluations'][$k]->noteInvalid2=$noteInvalid2;
                                                           }

                                                       }

                                                   }
                                                   else{
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
                                           <td colspan="'.((count($datas['evaluations'])*2)+3).'">
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


       </div>
   </div>
</div>
