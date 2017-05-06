<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Messages</h2>
        <small>Liste des reçus et envoyés par/au utilisateurs du système.</small>
    </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content">
    <div class="row">
        

        <!-- Mail Menu -->
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="<?= SITE;?>admin/messages/compose/">Composer un message</a>
                        <div class="space-25"></div>
                        <h5>Dossiers</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li>
                                <a href="<?= SITE;?>admin/messages/">
                                    <i class="fa fa-inbox "></i> Réception 
                                    <span class="label label-info pull-right"><?= $datas['nbMessagesRecus'];?></span> 
                                </a>
                            </li>
                            <li><a href="<?= SITE;?>admin/messages/envoyes/"><i class="fa fa-envelope-o"></i> Envoyés</a></li>
                        </ul>
                       <!--  <div class="clear50"></div>
                        <h5>Catégories</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a id="1" class="selectType"> <i class="fa fa-circle text-navy"></i> Travail </a></li>
                            <li><a id="2" class="selectType"> <i class="fa fa-circle text-primary"></i> Important</a></li>
                            <li><a id="3" class="selectType"> <i class="fa fa-circle text-info"></i> Support</a></li>
                            <li><a id="4" class="selectType"> <i class="fa fa-circle text-warning"></i> Système</a></li>
                        </ul>
                        <div class="clearfix"></div> -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Formumlaire d'envoie de message -->
         <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
               <h2>Composer un mesage</h2>
            </div>
                <div class="mail-box">


	                <div class="mail-body">
	                <?php
	                	 if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'éffectuer cette opération. Veuillez verifier vos saisies.</div>
                                <div class='clear20'></div>";

                            if(isset($datas['error']['title']))
                            echo "<div class='alert alert-danger'>Veuillez saisir un titre pour le message !</div>
                                <div class='clear20'></div>";  

                            if(isset($datas['error']['content']))
                            echo "<div class='alert alert-danger'>Veuillez rédiger un message !</div>
                                <div class='clear20'></div>";  
	                ?>

	                    <form class="form-horizontal" method="POST" action="<?=SITE;?>admin/messages/compose/">
	                        <div class="form-group">
	                        	<label class="col-sm-2 control-label">A :</label>
	                       		<div class="col-sm-10">
	                       			<select class="select2_demo_1 form-control" name="idreceiver">
	                       				<?php
	                       					foreach ($datas['employes'] as $mUser) {
                                               echo'<option value="'.$mUser->id.'">'.$mUser->firstname.' '.$mUser->lastname.'</option>';
                                            }

	                       				?>
	                       			</select>
	                       		</div>
	                        </div>
	                        <div class="form-group">
	                        	<label class="col-sm-2 control-label">Sujet:</label>
	                            <div class="col-sm-10"><input type="text" class="form-control" name="title"></div>
	                        </div>
							<div class="clear20"></div>

							<div class="form-group">
			                	<label class="col-sm-2 control-label">Message :</label>
				                <div class="col-sm-10"><textarea name="content" class="form-control sm-textarea textarea"></textarea></div>
		                    </div>
			            	<div class="clear20"></div>
							 <button type="submit" name="sendMessage" class="btn btn-sm btn-valid ">
							 <i class="fa fa-send"></i> Envoyer</button>
		                     <a href="<?=SITE;?>admin/messages" class="btn btn-danger btn-sm pull-right" >
		                     <i class="fa fa-cancel"></i> Annuler</a>
                    
		                    <div class="clear50"></div>
						</form>

	                </div>
                </div>
            </div>
	</div>
</div>