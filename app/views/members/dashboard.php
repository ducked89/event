 <div class="row wrapper border-bottom white-bg page-heading">
	 <div class="col-md-12">
	 	<h2>Bienvenue <strong><?= $mInfo->firstname.", ".$mInfo->lastname?></strong></h2>
	 	<small>Vous avez 
	 		<a href="<?php echo SITE;?>members/messages/">
	 			<strong><?= count($mRecus)?></strong> 
	 			message<?= (count($mRecus)>1)? "s" :  "" ?></a> et 
	 		<a href="<?php echo SITE;?>members/notifications/"><strong><?= count($mNotifcations)?></strong> 
	 				notification<?= (count($mNotifcations)>1) ? "s" :  "" ?></a>.
	 	</small>
	 </div>
 </div>


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="clear20"></div>

	<div class="row">
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><a href="<?php echo SITE;?>members/evaluations/">
					<span class="label label-info pull-right"><i class="fa fa-bar-chart-o mgR10"></i>Liste</span></a>
					<h5>Evaluations</h5>
				</div>
				<div class="ibox-content">
					<h2 class="no-margins"><a href="<?php echo SITE;?>members/evaluations/"><?= count($mEvaluations)?> évaluation<?= (count($mEvaluations)>1)? "s" :  " " ?></a></h2>
           </div>
        </div>
		</div>

	   <div class="col-lg-4">
	       	<div class="ibox float-e-margins">
	       		<div class="ibox-title"><a href="<?php echo SITE;?>members/messages/">
	       			<span class="label label-info pull-right"><i class="fa fa-eye mgR10"></i>Voir</span></a>
	       			<h5>Messages</h5>
	       		</div>
	       		<div class="ibox-content">
	       			<h2 class="no-margins"><a href="<?php echo SITE;?>members/messages/">
	       				<?= count($mRecus)?> message<?= (count($mRecus)>1)? "s" :  " " ?></a></h2>
	            </div>
	        </div>
	    </div>

	    <div class="col-lg-4">
	    	<div class="ibox float-e-margins">
	    		<div class="ibox-title"><a href="<?php echo SITE;?>members/notifications/">
	    			<span class="label label-info pull-right"><i class="fa fa-list mgR10"></i>Voir</span></a>
	    			<h5>Notifications</h5>
	    		</div>
	    		<div class="ibox-content">
	    			<h2 class="no-margins"><a href="<?php echo SITE;?>members/notifications/">
	    				<?= count($mNotifcations)?> notification<?= (count($mNotifcations)>1)? "s" :  " " ?></a></h2>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="clear20"></div>


	<div class="row">
		<div class="col-lg-8">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					Liste Evaluations
				</div>
				<div class="ibox-content">
					 <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Progression</th>
                        <th>Etat</th>
                        <th>Echéance</th>
                    </tr>
                    </thead>
                        <tbody>
                         <?php

                            $mEvaluations = (object)($datas['evaluations']);

                            if(sizeof($mEvaluations)>0){
                                foreach ($mEvaluations as $mEvaluation) {
                                  $progress = $mEvaluation->qteNotes+$mEvaluation->qteCommentaires;
                                    echo '<tr class="gradeU odd" role="row">
                                        <td class="">';

                                         if($mEvaluation->etat!=2)
                                          echo'<a href="'.SITE.'members/evaluations/launch/?idu='.$mEvaluation->id.'">'.$mEvaluation->title.'</a>';
                                        else echo'<a href="'.SITE.'members/evaluations/view/?idu='.$mEvaluation->id.'">'.$mEvaluation->title.'</a>';

                                        echo'</td>
                                        
                                        <td class="">
                                          <span >'.$progress.' %</span>
                                          <div class="progress progress-mini">
                                              <div style="width: '.$progress.'%;" class="progress-bar progress-bar-';

                                                if($progress<50) echo "danger";
                                                else if($progress>50 && $progress<80) echo "warning";
                                                else echo'valid valid';

                                              echo'"></div>
                                          </div>
                                        </td>
                                        <td class="center">';

                                        if($mEvaluation->etat == 1)echo '<span class="label label-warning">En cours</span>';
                                        elseif($mEvaluation->etat == 2)echo '<span class="label label-valid">Finale</span>';
                                        else echo '<span class="label label-white">En Attente</span>';
                                        echo '</td></td>
                                        <td class=""><span class="';

                                        if($mEvaluation->datediff<=0) echo 'inforedlarge';

                                        echo'">'.date_format(date_create($mEvaluation->targetdate), "d M Y").'</sapn></td>
                                       
                                        
                                    </tr>';
                                }
                            }
                             else
                                echo '    <tr> <td colspan="4">
                            <div class="row"> <div class="col-lg-12">
				                <div class="alert alert-warning">Aucune évaluation trouvée.</div>
				            </div></td>
				            </tr>';
                            ?>
                       
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Titre</th>
                        <th>Progression</th>
                        <th>Etat</th>
                        <th>Echéance</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					Raccourcis
				</div>
				<div data-toggle="collapse" href="#messages"  class="ibox-content ibox-heading">
	                    <h3><i class="btn btn-xs btn-info fa fa-angle-double-down mgR20"></i>Messagerie</h3>
		            </div>
				<div id="messages" class="panel-collapse collapse ibox-content">
					<button class="btn btn-primary btn-block m-t"  data-toggle="modal" data-target="#myModal2"> 
			            <i class="fa fa-envelope"></i> 
				        <span class="bold"> Composer un message</span>
			        </button>

			        <a href="<?= SITE;?>members/messages/">
					    <button type="button" class="btn  btn-block m-t btn-valid "><i class="fa fa-inbox"></i> 
					    <span class="bold">Boite de réception</span></button></a>

			        <a href="<?= SITE;?>members/messages/sent/">
						<button type="button" class="btn btn-block m-t btn-info "><i class="fa fa-send"></i> 
							<span class="bold">Boite d'envoi</span></button></a>
							<div class="clear20"></div>
					
				</div>
				<div data-toggle="collapse" href="#mentions"  class="ibox-content ibox-heading">
	                    <h3><i class="btn btn-xs btn-info fa fa-angle-double-down mgR20"></i>Mentions des notes</h3>
		            </div>
		            <div id="mentions" class="panel-collapse collapse ibox-content">
					<button type="button" class="btn btn-info btn-block m-t " data-toggle="modal" data-target="#myModalNote"><i class="fa fa-stickt-note"></i> 
        <span class="bold">Mentions des notes</span></button>  
							<div class="clear20"></div>
					
				</div>
			</div>
			
		</div>

	</div>

</div>

<?php  require_once 'app/views/includes/sendmessagesmembers.php';?>
<?php  require_once 'app/views/includes/mentionnote.php';?>