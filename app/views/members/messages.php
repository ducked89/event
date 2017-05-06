<?php $mMessageRecus = $datas['mMessageRecus'];?>
<div class="row wrapper dashboard-header border-bottom white-bg page-heading">
    <div class="col-sm-12">

		<div class="col-md-6">
			<h2>Messages reçus</h2>
			<small>Vous avez 
				<a href="<?php echo SITE;?>members/messages/"><strong><?= count($mMessageRecus)?></strong> 
					message<?= (count($mMessageRecus)>1)? "s" :  " " ?></a> et
				<a href="<?php echo SITE;?>members/notifications/"><strong><?= count($mNotifcations)?></strong> 
					notification<?= (count($mNotifcations)>1)? "s" :  " " ?></a>.
			</small>
		</div>


		<a href="<?= SITE;?>members/messages/sent/">
		<button type="button" class="btn btn-sm btn-info floatR "><i class="fa fa-send"></i> 
		<span class="bold">Boite d'envoi</span></button></a>

		<button type="button" class="btn btn-sm btn-primary compose-mail floatR mgR20"  data-toggle="modal" data-target="#myModal2"><i class="fa fa-envelope"></i> 
			<span class="bold"> Composer un message</span></button>
	</div>
</div>



<div class="wrapper wrapper-content white-bg animated fadeInRight">
	
		<div class="row m-b-lg m-t-lg">
			<div class="col-md-12">
			<?php if(sizeof($mMessageRecus)!=0){?>

				<div class="fh-column">
					<div class="full-height-scroll">
						<ul class="list-group elements-list">
							<?php
							foreach ($mMessageRecus as $mMessage) {
								echo '
								<li class="list-group-item">
									<a data-toggle="tab" href="#mess-'.$mMessage->id.'">
										<small class="pull-right text-muted">
											';if($mMessage->datediff > 0)
											echo $mMessage->datediff.' jour(s)';
											else echo 'Aujourd\'hui';
											echo '
										</small>
										<strong>Administrateur</strong>
										<div class="small m-t-xs">
											<p>
												'.ucfirst($mMessage->title).'
											</p>
											<p class="m-b-none">
												<i class="fa fa-calendar"></i> '.$mMessage->datecreated.'
											</p>
										</div>
									</a>
								</li>


								';
							} ?>

						</ul>

					</div><div class="clear20"></div>
					<?php echo $datas['paginate'];?>
				</div>

				<div class="full-height">
					<div class="full-height-scroll white-bg border-left">

						<div class="element-detail-box">

							<div class="tab-content">

								<?php
								$i=1;
								foreach ($mMessageRecus as $mMessage) {
									echo '
									<div id="mess-'.$mMessage->id.'" class="tab-pane ';
										if ($i ==1) {
											echo 'active';
										}

										echo' ">
										<div class="pull-right">
											<div class="tooltip-demo">
												<button class="btn btn-white btn-xs"><i class="fa fa-trash-o mgR10"></i> Supprimer</button>

											</div>
										</div>
										<div class="small text-muted">
											<i class="fa fa-clock-o"></i> '.date_format(date_create($mMessage->datecreated), "d M Y").'
										</div>

										<h1>'.$mMessage->title.'</h1>

										<p>'.$mMessage->content.'</p>

										<div class="clear50"></div>
										<p class="small">
											<strong>Administrateur</strong>
										</p>

									</div>
									';
									$i++;
								} ?>



							</div>

						</div>

					</div>
				</div>

			<?php }else{ ;?>
			<div class="middle-box text-center animated fadeInDown nomargintop">
		        <h2>Pas de message!</h2>
		        <h3 class="font-bold">Vous n'avez pas encore reçu de message.</h3>
			</div>

			<?php }?>

			</div>
		</div>
	</div>

<?php  require_once 'app/views/includes/sendmessagesmembers.php';?>







