<div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content animated flipInY">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Composer un message</h4>
						<small class="font-bold">Ecrire l'administrateur</small>
					</div>
					 <form class="form-horizontal" action="<?php echo SITE;?>members/messages/send/" method="POST"  >
						<div class="modal-body">

						<div class="form-group"><label class="col-sm-2 control-label">Sujet:</label>
                            <div class="col-sm-10"><input name="title" type="text" class="form-control" value=""></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Contenu:</label>
                            <div class="col-sm-10"><textarea name="content" type="text" class="form-control sm-textarea"></textarea></div>
                        </div>
						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
							<button name="sendMessage" type="submit" class="btn btn-primary">Envoyer</button>
						</div>
					</form>
					</div>
				</div>
			</div>