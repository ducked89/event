<?php 
    $data = (isset($datas['nbElements']))?$datas['nbElements'] : null;
    // var_dump($data);die();
    // var_dump($datas['nbElements']);die();

?>
<div class="col-md-12">
    <h2>Bienvenue <strong>Administrateur</strong></h2>
    <small>Vous avez <strong>
    <a href="<?php echo SITE;?>admin/messages/"><?= count($datas['messages']);?></strong> 
    message<?= (count($datas['messages'])>1)? "s" :  " " ?></a> et 

    <a href="<?php echo SITE;?>admin/notifications/">
    <?= count($datas['notifications']);?> notification<?= (count($datas['notifications'])>1)? "s" :  " " ?>.</small></a>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="clear20"></div>
       <!--  <h1>Not Ready !</h1>
        <h3 class="font-bold">Ce module est en cours de developpement.</h3>

        <div class="error-desc">
            En parallele, vous pouvez utiliser une autre fonctionalité.<br/><a href="<?php //echo SITE;?>admin/dashboard/" class="btn btn-primary m-t">Dashboard</a>
        </div> -->

        <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title"><a href="<?php echo SITE;?>admin/evaluations/add/">
                                <span class="label label-info pull-right"><i class="fa fa-plus mgR10"></i>Créer</span></a>
                                <h5>Evènement</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><a href="<?php echo SITE;?>admin/evaluations/"><?= $data['nbEvaluations'][0]->nb;?> évènement<?=  ($data['nbEvaluations'][0]->nb>1)? "s" :  " " ?></a></h2>
                               <!--  <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                               <small>Total income</small> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title"><a href="<?php echo SITE;?>admin/employes/add/">
                                <span class="label label-info pull-right"><i class="fa fa-plus mgR10"></i>Créer</span></a>
                                <h5>Organisateur</h5>
                            </div>
                            <div class="ibox-content">
                               <h2 class="no-margins"><a href="<?php echo SITE;?>admin/employes/">
                               <?= $data['nbEmployes'][0]->nb;?> organisateur<?=($data['nbEmployes'][0]->nb>1)? "s" :  " " ?></a></h2>
                                <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                                <small>New orders</small> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title"><a href="<?php echo SITE;?>admin/accounts/add/">
                                <span class="label label-info pull-right"><i class="fa fa-plus mgR10"></i>Créer</span></a>
                                <h5>Utilisateur</h5>
                            </div>
                            <div class="ibox-content">
                                <h2 class="no-margins"><a href="<?php echo SITE;?>admin/accounts/">
                                <?=$data['nbUsers'][0]->nb;?> utilisateur<?=($data['nbUsers'][0]->nb>1)? "s":"";?></a></h2>
                                <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                <small>New visits</small> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Messages</h5>
                            </div>
                            <div class="ibox-content">
                             <h2 class="no-margins"><a href="<?php echo SITE;?>admin/messages/">
                                <?=count($datas['messages']);?> message<?= (count($datas['messages'])>1) ? "s" : "" ?></a></h2>
                            </div>
                        </div>
                     </div>


        <div class="row">
                    

                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <a class="btn btn-xs btn-success pull-right" href="<?=SITE;?>admin/evaluations/"><i class="fa fa-list mgR10"></i>Liste évènement</a>
                                <h3>Dernieres Evènements</h3>
                            </div>
                            <div class="ibox-content">
                                
                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                            <tr>
                                                <th>Titre</th>
                                                <th>Organisateur</th>
                                                <th>Adresse</th>
                                                <th>Etat</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                             <?php

                                                $mEvaluations =(isset($datas['evaluations'])? (object)($datas['evaluations']): array());

                                                if(count($mEvaluations)>0){
                                                    foreach ($mEvaluations as $mEvaluation) {
                                                        echo '<tr class="gradeU odd" role="row">
                                                                <td class=""><a href="'.SITE.'admin/evaluations/view/?idu='.$mEvaluation->id.'">'.$mEvaluation->title.'</a></td>
                                                                <td class="sorting_1">'.$mEvaluation->evalue->firstname.' '.strtoupper($mEvaluation->evalue->lastname).'</td>
                                                                 <td class="sorting_1">'.$mEvaluation->evaluateur->firstname.' '.strtoupper($mEvaluation->evaluateur->lastname).'</td>
                                                             
                                                                <td class="center">';

                                                                if($mEvaluation->etat == 1)echo '<span class="label label-warning">En cours</span>';
                                                                elseif($mEvaluation->etat == 2)echo '<span class="label label-valid">Finale</span>';
                                                                else echo '<span class="label label-white">En Attente</span>';

                                                                echo '</td>
                                                                
                                                            </tr>';
                                                    }
                                                }
                                                else
                                                   echo '    <tr> <td colspan="4"><div class="row"> <div class="col-lg-12">
                            <div class="alert alert-warning">Aucun évènement trouvé.</div>
                        </div></td></tr>';
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title"><h3>Raccourcis</h3></div>
                            <div class="ibox-content">
                               <ul class="employe-row">
                                   <li><i class="fa fa-user mgR10"></i><a href="<?= SITE;?>admin/accounts/add/">Créer un utilisateur</a></li>
                                   <li><i class="fa fa-group mgR10"></i><a href="<?= SITE;?>admin/employes/">Profiles des organisateurs</a></li>
                                   <li><i class="fa fa-list mgR10"></i><a href="<?= SITE;?>admin/criteres/">Liste des critères</a></li>
                                   <li><i class="fa fa-check mgR10"></i><a href="<?= SITE;?>admin/mentions/">Liste des mentions</a></li>
                                    <li><i class="fa fa-lock mgR10"></i><a href="<?= SITE;?>admin/password/">Changer mot de passe</a></li>
                               </ul>
                            </div>
                        </div>
        </div>

</div>
