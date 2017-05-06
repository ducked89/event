<?php 
if($this->isConnected())
			{
				$this->datas['menuSection'] = "mEvaluations";
				$Tools = $this->useUtility("Utilities");

				if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
				{
					$params = $this->datas['params'][0];
					
					switch ($params) {
						// Ajouter
						case 'add':
						{
							$Agent = $this->chargerMyModel('User');
							$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
							$this->datas['users'] = $Agent->trouver(array(
							'champs'		=>'users.id, employes.lastname, employes.firstname',
							'ordre'			=>' employes.firstname ASC'));

							$Agent->useTable('ponderations');
							$this->datas['ponderations'] = $Agent->trouverTout();

							if(isset($_POST["createEvaluation"])){
								extract($_POST);
								if(!empty($title) && !empty($idevalue) && !empty($idevaluateur)
									&& !empty($idponderation) && !empty($mois) && !empty($annee))
								{
									// Verifications des données
									$Agent = $this->chargerMyModel('Model');
									$Agent->useTable('evaluations');

									$check = $Agent->trouver(array(
										'champs'		=> ' id ',
										'conditions'	=> ' (title="'.$title.'" AND (idevalue='.$idevalue.' AND idevaluateur='.$idevaluateur.') AND (mois='.$mois.' AND annee='.$annee.')) OR ((idevalue='.$idevalue.' AND idevaluateur='.$idevalue.') AND (mois='.$mois.' AND annee='.$annee.'))',
										'limit'			=> ' LIMIT 0, 1'
										));

									// Verification de duplication	
									if(!isset($check[0]) && !isset($check[0]->id))
									{									
										$mDate = explode("-", $targetdate);
										$mDate = date_format(new DateTime($mDate[0].'/'.$mDate[1].'/'.$mDate[2]), 'Y-m-d H:i:s');


										$limit = $Agent->trouver(array(
										'champs'		=> ' COUNT(*) as nb ',
										'conditions'	=> ' idevalue='.$idevalue.' AND mois='.$mois.' AND annee='.$annee
										));

										$altTitre = $this->genererTitre($idevalue, $idevaluateur, $mois, $annee);

										if($limit[0]->nb<5){
											$saved = $Agent->ajouterContent(array(
												'idevalue'		=>$idevalue,
												'idevaluateur'	=>$idevaluateur,
												'idponderation'	=>$idponderation,
												'title'			=>$title,
												'alttitle'		=>$altTitre,
												'commentaire'	=>$commentaire,
												'mois'			=>$mois,
												'annee'			=>$annee,
												'targetdate'	=>$mDate
											));
											
											// Enregistrement effectue
											if($saved){
												// Get notifications
												$Agent->useTable("notifications");

												$saved = $Agent->ajouterContent(array(
													'iduser'		=>$idevaluateur,
													'type'			=>'systeme',
													'title'			=>'Nouvelle Evaluation',
													'content'		=>'Vous avez une nouvelle évaluation.',
													'datecreated'	=>date("Y-m-d H:i:s"),
													'sent'			=>1,
													'statut'		=>0
												));
												

												$this->redirigerVers($this->direct.'evaluations/');
											}
											else{
												$this->datas['mdatas'] = $_POST;
												$this->datas['error']['notsaved'] =true;
												$this->chargerViewLayout($this->layout, $this->direct.'addevaluation',$this->datas);
											}
										}
										else{
											$this->datas['mdatas'] = $_POST;
											$this->datas['error']['limit'] =true;
											$this->chargerViewLayout($this->layout, $this->direct.'addevaluation',$this->datas);
										}
									}
									else{
										$this->datas['mdatas'] = $_POST;
										$this->datas['error']['existe'] =true;
										$this->chargerViewLayout($this->layout, $this->direct.'addevaluation',$this->datas);
										// $this->redirigerVers("admin/");
									}
								}
								else{
									if(empty($title)) 		$this->datas['error']['title'] 		= true;
									if(empty($commentaire)) $this->datas['error']['commentaire'] 	= true;
									if(empty($idevalue)) 	$this->datas['error']['idevalue'] 	= true;
									if(empty($idevaluateur)) $this->datas['error']['idevaluateur'] 	= true;
									if(empty($idponderation)) $this->datas['error']['idponderation'] 	= true;
									if(empty($mois)) 	$this->datas['error']['mois'] 	= true;
									if(empty($annee)) 	$this->datas['error']['mois'] 	= true;

									$this->datas['error']['error'] =true;
									$this->datas['mdatas'] = $_POST;
									$this->chargerViewLayout($this->layout, $this->direct.'addevaluation', $this->datas);
									// $this->redirigerVers("admin/");
								}
								$_POST = array();
							}
							else{
								$this->chargerViewLayout($this->layout, $this->direct.'addevaluation', $this->datas);
							}
						}
						break;

						// Consulter une valuation
						case 'view':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");
								$tempEvaluations = $Agent->trouver(array(
									'ordre'=>' title ASC',
									'conditions'	=> 'id = '.$idu));

								$Agent->useTable("evaluations");
								$tempEvaluations = $Agent->trouver(array(
									'ordre'=>' title ASC',
									'conditions'	=> 'idevalue = '.$tempEvaluations[0]->idevalue));

								if(count($tempEvaluations)>0 && isset($tempEvaluations[0]->id))
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouver(array(
										'conditions'	=> 'idevaluation='.$idu));

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));


									$Agent->useTable("mentions");
									$this->datas['mentions'] = $Agent->trouver(array(
										'ordre'			=>'level ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){

										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'conditions'	=> 'idevaluation='.$tpEval->id));
										$qteNotes = 0;
										$qteCommentaires = 0;
										if(count($tempNotes)>0)
										{
											foreach ($tempNotes as $tpNote) {
												if($tpNote->notes!=100) $qteNotes++;
												if(!empty($tpNote->commentaire)) $qteCommentaires++;
											}
											$qteNotes = ($qteNotes*100)/count($tempNotes);
											$qteCommentaires = ($qteCommentaires*100)/count($tempNotes);
											$tempEvaluations[$i]->qteNotes=($qteNotes * 50 ) / 100;
											$tempEvaluations[$i]->qteCommentaires=($qteCommentaires* 50 ) / 100;
										}
										else{
											$tempEvaluations[$i]->qteNotes=0;
											$tempEvaluations[$i]->qteCommentaires=0;
											
										}

										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations[$i]->evalue = $tpUser;

											if($tpEval->idevaluateur == $tpUser->id)
												$tempEvaluations[$i]->evaluateur = $tpUser;
										}
										$tempEvaluations[$i]->datediff = $Tools->dateDifference(date('Y-m-d'), date_format(date_create($tpEval->targetdate), 'Y-m-d'));
										$i++;

									}
									foreach ($tempEvaluations as $tpEval ){
										if($tpEval->id==$idu) $this->datas['firstevaluations']= $tpEval;
									}
									$this->datas['otherEvaluations'] = $tempEvaluations;
									$this->chargerViewLayout($this->layout, $this->direct.'viewevaluation',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/");
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;

						// Appercu des evaluation
						case 'overview':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");

								if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
									&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
									)
								{
									$cond=' AND mois='.$_GET['mois'].' AND annee='.$_GET['annee'];
									$this->datas['mois']=$_GET['mois'];
									$this->datas['annee']=$_GET['annee'];
								}
								else {
									$cond="";
								}


								//Recher et Insertion de l'auto evaluation
								$autoEvaluation = $Agent->trouver(array(
									'conditions'	=> 'idevalue = '.$idu.' AND idevaluateur='.$idu.' AND statut=1'.$cond,
									'ordre'			=>' datecreated ASC'));

								if(count($autoEvaluation)>0 && isset($autoEvaluation[0]->id))
									$tempEvaluations[0] = $autoEvaluation[0];

								// Autres evaluations
								$otherEvaluations = $Agent->trouver(array(
									'conditions'=> 'idevalue = '.$idu.' AND idevaluateur !='.$idu.' AND statut=1'.$cond,
									'ordre'		=>' datecreated ASC',
									'limit'		=>' LIMIT 0,4'));
								//$tempEvaluations[0] = $otherEvaluations[0];
								
								if(isset($tempEvaluations[0]))
								{
									$j=1;
									$this->datas['auto'] = true;
								}
								else $j=0;
								foreach ($otherEvaluations as $tpEval ){
									$tempEvaluations[$j] = $tpEval;
									$j++;
								}

								if(count($tempEvaluations)>0)
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouverTout();

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.position, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){
										if(isset($tpEval->id)){ $tempEvaluations2[$i]=$tpEval;}
										else{ unset($tempEvaluations[$i]);}
										$i++;
									}
									$i = 0;
									foreach ($tempEvaluations as $tpEval ){	
										$tempEvaluations2[$i]=$tpEval;
										$i++;
									}

									$i=0;
									foreach ($tempEvaluations2 as $tpEval ){
										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'champs'=>'idevaluation, idcritere, id, notes',
											'conditions'	=> 'idevaluation='.$tpEval->id));

										// echo'<pre>';
	          						if(count($tempNotes)>0 && isset($tempNotes[0]->id))
									{
											$tempEvaluations2[$i]->notes=$tempNotes;
										}
										else $tempEvaluations2[$i]->notes=array();
										
										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations2[$i]->evalue = $tpUser;;
										}
										$i++;

									}
									//die();
									$this->datas['evaluations'] = $tempEvaluations2;
									$this->chargerViewLayout($this->layout, $this->direct.'evaluationoverview',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/overview/?idu=".$idu."&nf=yes");
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;


						// Appercu des evaluation
						case 'summarize':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");

								if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
									&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
									)
								{
									$cond=' AND mois='.$_GET['mois'].' AND annee='.$_GET['annee'];
									$this->datas['mois']=$_GET['mois'];
									$this->datas['annee']=$_GET['annee'];
								}
								else {
									$cond="";
								}


								//Recher et Insertion de l'auto evaluation
								$autoEvaluation = $Agent->trouver(array(
									'conditions'	=> 'idevalue = '.$idu.' AND idevaluateur='.$idu.' AND statut=1'.$cond,
									'ordre'			=>' datecreated ASC'));

								if(count($autoEvaluation)>0 && isset($autoEvaluation[0]->id))
									$tempEvaluations[0] = $autoEvaluation[0];

								// Autres evaluations
								$otherEvaluations = $Agent->trouver(array(
									'conditions'=> 'idevalue = '.$idu.' AND idevaluateur !='.$idu.' AND statut=1'.$cond,
									'ordre'		=>' datecreated ASC',
									'limit'		=>' LIMIT 0,4'));

								//$tempEvaluations[0] = $otherEvaluations;
								
								if(isset($tempEvaluations[0]))
								{
									$j=1;
									$this->datas['auto'] = true;
								}
								else $j=0;
								foreach ($otherEvaluations as $tpEval ){
									$tempEvaluations[$j] = $tpEval;
									$j++;
								}

								if(count($tempEvaluations)>0)
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouverTout();

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.position, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){
										if(isset($tpEval->id)){ $tempEvaluations2[$i]=$tpEval;}
										else{ unset($tempEvaluations[$i]);}
										$i++;
									}
									$i = 0;
									foreach ($tempEvaluations as $tpEval ){	
										$tempEvaluations2[$i]=$tpEval;
										$i++;
									}

									$i=0;
									foreach ($tempEvaluations2 as $tpEval ){
										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'champs'=>'idevaluation, idcritere, id, notes',
											'conditions'	=> 'idevaluation='.$tpEval->id));

										// echo'<pre>';
	          						if(count($tempNotes)>0 && isset($tempNotes[0]->id))
									{
											$tempEvaluations2[$i]->notes=$tempNotes;
										}
										else $tempEvaluations2[$i]->notes=array();
										
										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations2[$i]->evalue = $tpUser;;
										}
										$i++;

									}
									//die();
									$this->datas['evaluations'] = $tempEvaluations2;
									$this->chargerViewLayout($this->layout, $this->direct.'evaluationsummary',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/summarize/?idu=".$idu."&nf=yes");
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;

						// Appercu des evaluation
						case 'final':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");

								if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
									&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
									)
								{
									$cond=' AND mois='.$_GET['mois'].' AND annee='.$_GET['annee'];
								}
								else {
									$cond="";
								}


								//Recher et Insertion de l'auto evaluation
								$autoEvaluation = $Agent->trouver(array(
									'conditions'	=> 'idevalue = '.$idu.' AND idevaluateur='.$idu.' AND statut=1'.$cond,
									'ordre'			=>' datecreated ASC'));

								if(count($autoEvaluation)>0 && isset($autoEvaluation[0]->id))
									$tempEvaluations[0] = $autoEvaluation[0];

								// Autres evaluations
								$otherEvaluations = $Agent->trouver(array(
									'conditions'=> 'idevalue = '.$idu.' AND idevaluateur !='.$idu.' AND statut=1'.$cond,
									'ordre'		=>' datecreated ASC',
									'limit'		=>' LIMIT 0,4'));
								
								if(isset($tempEvaluations[0]))
								{
									$j=1;
									$this->datas['auto'] = true;
								}
								else $j=0;
								foreach ($otherEvaluations as $tpEval ){
									$tempEvaluations[$j] = $tpEval;
									$j++;
								}

								if(count($tempEvaluations)>0)
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouverTout();

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.position, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){
										if(isset($tpEval->id)){ $tempEvaluations2[$i]=$tpEval;}
										else{ unset($tempEvaluations[$i]);}
										$i++;
									}
									$i = 0;
									foreach ($tempEvaluations as $tpEval ){	
										$tempEvaluations2[$i]=$tpEval;
										$i++;
									}

									$i=0;
									foreach ($tempEvaluations2 as $tpEval ){
										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'champs'=>'idevaluation, idcritere, id, notes',
											'conditions'	=> 'idevaluation='.$tpEval->id));


										$Agent->useTable("ponderationslites");
										$tempEvaluations2[$i]->ponderation  = $Agent->trouver(array(
											'conditions'	=> 'idponderation='.$tpEval->idponderation));

										// echo'<pre>';
		          						if(count($tempNotes)>0 && isset($tempNotes[0]->id))
										{
											$tempEvaluations2[$i]->notes=$tempNotes;
										}
										else $tempEvaluations2[$i]->notes=array();
										
										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations2[$i]->evalue = $tpUser;;
										}
										$i++;

									}
									//die();
									$this->datas['evaluations'] = $tempEvaluations2;
									$this->chargerViewLayout($this->layout, $this->direct.'evaluationfinal',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/");
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;

						// Imprimer  des evaluations
						case 'print':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$this->datas['pageTitle'] = "UTE Rapport d'Evaluation";
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("mentions");
								$this->datas['mentions'] = $Agent->trouver(array('ordre'=>' level ASC '));


								//Recher et Insertion de l'auto evaluation
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");
								if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
									&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
									)
								{
									$cond=' AND mois='.$_GET['mois'].' AND annee='.$_GET['annee'];
									$this->datas['mois']=$_GET['mois'];
									$this->datas['annee']=$_GET['annee'];
								}
								else {
									$cond="";
								}


								//Recher et Insertion de l'auto evaluation
								$autoEvaluation = $Agent->trouver(array(
									'conditions'	=> 'idevalue = '.$idu.' AND idevaluateur='.$idu.' AND statut=1'.$cond,
									'ordre'			=>' datecreated ASC'));

								if(count($autoEvaluation)>0 && isset($autoEvaluation[0]->id))
									$tempEvaluations[0] = $autoEvaluation[0];

								// Autres evaluations
								$otherEvaluations = $Agent->trouver(array(
									'conditions'=> ' idevalue = '.$idu.' AND idevaluateur !='.$idu.' AND statut=1 '.$cond,
									'ordre'		=>' datecreated ASC',
									'limit'		=>' LIMIT 0,4'));
								
								if(isset($tempEvaluations[0]))
								{
									$j=1;
									$this->datas['auto'] = true;
								}
								else $j=0;
								foreach ($otherEvaluations as $tpEval ){
									$tempEvaluations[$j] = $tpEval;
									$j++;
								}

								if(count($tempEvaluations)>0)
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouverTout();

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.position, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){
										if(isset($tpEval->id)){ $tempEvaluations2[$i]=$tpEval;}
										else{ unset($tempEvaluations[$i]);}
										$i++;
									}
									$i = 0;
									foreach ($tempEvaluations as $tpEval ){	
										$tempEvaluations2[$i]=$tpEval;
										$i++;
									}

									$i=0;
									foreach ($tempEvaluations2 as $tpEval ){
										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'champs'=>'idevaluation, idcritere, id, notes',
											'conditions'	=> 'idevaluation='.$tpEval->id));

										// echo'<pre>';
	          						if(count($tempNotes)>0 && isset($tempNotes[0]->id))
									{
											$tempEvaluations2[$i]->notes=$tempNotes;
										}
										else $tempEvaluations2[$i]->notes=array();
										
										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations2[$i]->evalue = $tpUser;

											$tempEvaluations2[$i]->nomMois = $Tools->nomMois($tpEval->mois);


										}
										
										$i++;

									}
									//die();
									$this->datas['evaluations'] = $tempEvaluations2;
									$this->chargerViewLayout("layout_print", $this->direct.'printevaluation',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/summarize/?idu=".$idu.'&fd=no');
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;

						// Imprimer  des evaluations
						case 'printall':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								$this->datas['pageTitle'] = "UTE Rapport d'Evaluation";
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("mentions");
								$this->datas['mentions'] = $Agent->trouver(array('ordre'=>' level ASC '));


								//Recher et Insertion de l'auto evaluation
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");
								if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
									&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
									)
								{
									$cond=' AND mois='.$_GET['mois'].' AND annee='.$_GET['annee'];
									$this->datas['mois']=$_GET['mois'];
									$this->datas['annee']=$_GET['annee'];
								}
								else {
									$cond="";
								}


								//Recher et Insertion de l'auto evaluation
								$autoEvaluation = $Agent->trouver(array(
									'conditions'	=> 'idevalue = '.$idu.' AND idevaluateur='.$idu.' AND statut=1'.$cond,
									'ordre'			=>' datecreated ASC'));

								if(count($autoEvaluation)>0 && isset($autoEvaluation[0]->id))
									$tempEvaluations[0] = $autoEvaluation[0];

								// Autres evaluations
								$otherEvaluations = $Agent->trouver(array(
									'conditions'=> 'idevalue = '.$idu.' AND idevaluateur !='.$idu.' AND statut=1'.$cond,
									'ordre'		=>' datecreated ASC',
									'limit'		=>' LIMIT 0,4'));
								
								if(isset($tempEvaluations[0]))
								{
									$j=1;
									$this->datas['auto'] = true;
								}
								else $j=0;
								foreach ($otherEvaluations as $tpEval ){
									$tempEvaluations[$j] = $tpEval;
									$j++;
								}

								if(count($tempEvaluations)>0)
								{
								
									$Agent->useTable("notes");
									$this->datas['notes']  = $Agent->trouverTout();

									$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
									$tempUsers = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname, employes.position, employes.photo',
										'ordre'			=>' employes.firstname ASC'));

									$Agent->useTable("criteres");
									$this->datas['criteres'] = $Agent->trouver(array(
										'ordre'			=>' title ASC'));

									$i=0;
									$Tools = $this->useUtility("Utilities");
									foreach ($tempEvaluations as $tpEval ){
										if(isset($tpEval->id)){ $tempEvaluations2[$i]=$tpEval;}
										else{ unset($tempEvaluations[$i]);}
										$i++;
									}
									$i = 0;
									foreach ($tempEvaluations as $tpEval ){	
										$tempEvaluations2[$i]=$tpEval;
										$i++;
									}

									$i=0;
									foreach ($tempEvaluations2 as $tpEval ){
										// Verification de la progression
										$Agent->useTable("notes");
										$tempNotes  = $Agent->trouver(array(
											'champs'=>'idevaluation, idcritere, id, notes, commentaire',
											'conditions'	=> 'idevaluation='.$tpEval->id));

										// echo'<pre>';
	          						if(count($tempNotes)>0 && isset($tempNotes[0]->id))
									{
											$tempEvaluations2[$i]->notes=$tempNotes;
										}
										else $tempEvaluations2[$i]->notes=array();
										
										foreach ($tempUsers as $tpUser) {
											if($tpEval->idevalue == $tpUser->id)
												$tempEvaluations2[$i]->evalue = $tpUser;

											$tempEvaluations2[$i]->nomMois = $Tools->nomMois($tpEval->mois);
										}
										
										$i++;

									}
									//die();
									$this->datas['evaluations'] = $tempEvaluations2;
									$this->chargerViewLayout("layout_print_commentaire", $this->direct.'printevaluation',$this->datas);
								}
								else $this->redirigerVers("admin/evaluations/");
							}
							else $this->redirigerVers("admin/evaluations/");
						}
						break;

						// Edition d'evaluation
						case 'edit':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								if(isset($_POST["saveEvaluation"])){

									extract($_POST);
									if(!empty($title))
									{
										// Verifications des données
										$Agent = $this->chargerMyModel('Model');
										$Agent->useTable('evaluations');
										$check = $Agent->trouver(array(
											'champs'		=> ' id ',
											'conditions'	=> ' id='.$idu,
											'limit'			=> ' LIMIT 0, 1'
											));

										// Verification de duplication	
										if(isset($check[0]) && isset($check[0]->id))
										{									

											$mDate = explode("-", $targetdate);
											$mDate = date_format(new DateTime($mDate[0].'/'.$mDate[1].'/'.$mDate[2]), 'Y-m-d H:i:s');

											$saved = $Agent->modifier(array(
												'id'			=>$idu,
												'idevalue'		=>$idevalue,
												'idevaluateur'	=>$idevaluateur,
												'idponderation'	=>$idponderation,
												'title'			=>$title,
												'commentaire'	=>$commentaire,
												'mois'			=>$mois,
												'annee'			=>$annee,
												'targetdate'	=>$mDate
											));
											
											// Enregistrement effectue
											if($saved){
												$this->redirigerVers($this->direct.'evaluations/');
											}
											else{
												$this->datas['mdatas'] = $_POST;
												$this->datas['error']['notsaved'] =true;
												$this->chargerViewLayout($this->layout, $this->direct.'editevaluation',$this->datas);
											}
										}
										else{
											$this->datas['mdatas'] = $_POST;
											$this->datas['error']['existe'] =true;
											$this->chargerViewLayout($this->layout, $this->direct.'editevaluation',$this->datas);
											// $this->redirigerVers("admin/");
										}
									}
									else{
										if(empty($title)) 		$this->datas['error']['title'] 		= true;
										$this->datas['error']['error'] =true;
										$this->datas['mdatas'] = $_POST;
										$this->chargerViewLayout($this->layout, $this->direct.'editevaluation', $this->datas);
										// $this->redirigerVers("admin/");
									}
									$_POST = array();
								}
								else{
									$Agent = $this->chargerMyModel("User");
									$Agent->useTable("evaluations");
									$found = $Agent->trouver(array(
										'conditions'	=> ' id= '.$idu));

									if(isset($found[0]->id))
									{
										$this->datas['mdatas'] = get_object_vars($found[0]);
										
										$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
										$this->datas['users'] = $Agent->trouver(array(
										'champs'		=>'users.id, employes.lastname, employes.firstname',
										'ordre'			=>' employes.firstname ASC'));

										$Agent->useTable('ponderations');
										$this->datas['ponderations'] = $Agent->trouverTout();

										$this->chargerViewLayout($this->layout, $this->direct.'editevaluation',$this->datas);
									}
									else{
										$this->redirigerVers("admin/evaluations/");
									}
								}
							}
							else{
								$this->redirigerVers("admin/evaluations/");
							}		
						}
						break;
						

						// Activer une evaluation						
						case 'enable':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$foundBasic = $Agent->trouver(array('champs'=>'id, idevaluateur, idevalue, targetdate','conditions'	=> ' id= '.$idu));

								$idEva = $foundBasic[0]->idevaluateur;
								

								if(isset($foundBasic[0]->id))
								{
									$found = $Agent->modifier(array(
										'id'	=> $idu,
										'statut'=>1));

										$Agent->useTable("employes");
										$foundEmp = $Agent->trouver(array(
										'conditions'	=> ' iduser='.$idEva
										));

										$Agent->useTable("employes");
										$foundEvalue = $Agent->trouver(array(
										'conditions'	=> ' iduser='.$foundBasic[0]->idevalue
										));

										if(isset($foundEmp[0]->id) && !empty($foundEmp[0]->email) ){
											//$to = $found[0]->email;
											$to = $foundEmp[0]->email;
											$to_name = $foundEmp[0]->firstname.' '.$foundEmp[0]->lastname;
											
											$subject = 'Nouvelle affectation d\'évaluation';
											$message = '<br><br/><strong>Hello '.$to_name.',</strong><br><br/>
														Une nouvelle évaluation à été affectée à votre compte.<br><br/>
														Evaluation de : <strong>'.$foundEvalue[0]->firstname.' '.$foundEvalue[0]->lastname.'
														</strong><br>Date d\'écheance: <strong>'.date_format(date_create($foundBasic[0]->targetdate), "d M Y").'</strong>';
											require_once 'app/views/layout_notification.php';
											$this->sendMail($to, $to_name, $subject, $mymessage);	
										}

								}  
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->redirigerVers("admin/evaluations/");
							}
						}
						break;

						// Desactiver une evaluation
						case 'disable':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$found = $Agent->trouver(array('champs'=>'id', 'conditions'	=> ' id= '.$idu));
								if(isset($found[0]->id))
								{
									$found = $Agent->modifier(array(
										'id'	=> $idu,
										'statut'=>0));
								}  
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->redirigerVers("admin/evaluations/");
							}
						}
						break;

						// Activer toutes les evaluations
						case 'activate':
						{
							if(isset($_POST['opt']) && $_POST['opt']==1)
							{								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$found = $Agent->modifierCondition(array('statut'=>1), ' id >0');
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->chargerViewLayout($this->layout, $this->direct.'activerallevaluations', $this->datas);
							}
						}
						break;


						// Desactiver toutes les evaluations
						case 'desactivate':
						{
							if(isset($_POST['opt']) && $_POST['opt']==0)
							{								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$found = $Agent->modifierCondition(array('statut'=>0), ' id >0');
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->chargerViewLayout($this->layout, $this->direct.'desactiverallevaluations', $this->datas);
							}
						}
						break;

						// Activer une evaluation						
						case 'open':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$found = $Agent->trouver(array('champs'=>'id','conditions'	=> ' id= '.$idu));
								if(isset($found[0]->id))
								{
									$found = $Agent->modifier(array(
										'id'	=> $idu,
										'etat'=>1));

								}  
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->redirigerVers("admin/evaluations/");
							}
						}
						break;

						// Desactiver une evaluation
						case 'finalize':
						{
							if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
							{
								$idu = $_GET['idu'];
								
								$Agent = $this->chargerMyModel('User');
								$Agent->useTable('evaluations');
								$found = $Agent->trouver(array('champs'=>'id', 'conditions'	=> ' id= '.$idu));
								if(isset($found[0]->id))
								{
									$found = $Agent->modifier(array(
										'id'	=> $idu,
										'etat'=>2));
								}  
								$this->redirigerVers("admin/evaluations/");
							}
							else{
								$this->redirigerVers("admin/evaluations/");
							}
						}
						break;

						case 'grid':
						{
							if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
								&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
								)
							{
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");
								$tempEvalues = $Agent->trouver(array(
									'champs'=>' DISTINCT idevalue',
									'conditions'=>' mois='.$_GET['mois'].' AND annee='.$_GET['annee']));
							}
							else {
								$Agent = $this->chargerMyModel('Model');
								$Agent->useTable("evaluations");
								$tempEvalues = $Agent->trouver(array(
									'champs'=>' DISTINCT idevalue'));
							}


							// Chercher la liste des evaluations de chaque evalues
							if(count($tempEvalues)>0 && isset($tempEvalues[0]->idevalue))
							{
								// Liste des employes
								$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
								$tempUsers = $Agent->trouver(array(
								'champs'	=>'users.id, employes.id as empid, employes.iduser, employes.lastname, employes.firstname, employes.position, employes.photo',
								'ordre'		=>' employes.firstname ASC'));

								// Liste des ponderations
								$Agent->useTable("ponderations");
								$tempPonderations = $Agent->trouver(array(
									'ordre'			=>' title ASC'));

								$j=0; 

								// Recherche des periodes d'evaluations
								foreach ($tempEvalues as $tempEvalue) {
									$Agent->useTable("evaluations");
									$tempAnnees = $Agent->trouver(array(
										'champs'=>' annee',
										'include'=>true,
										'conditions'=>' idevalue='.$tempEvalue->idevalue,
										'conditions2'=>' GROUP BY annee'));

										// var_dump($tempAnnees); die();
									
									//Groupement des evalautions par periode 
									$k=0;
									foreach ($tempAnnees as $tempAnnee) {
										$Agent->useTable("evaluations");
										$tempEvaluations = $Agent->trouver(array(
											'conditions'=>'idevalue='.$tempEvalue->idevalue.' AND annee='.$tempAnnee->annee,
											'ordre'			=>' datecreated ASC'));

										// Chercher les infos de chaque evaluation trouvee pour une evaluer
										$i=0;
										$Tools = $this->useUtility("Utilities");
										foreach ($tempEvaluations as $tpEval ){

											// Verification de la progression
											$Agent->useTable("notes");
											$tempNotes  = $Agent->trouver(array(
												'conditions'	=> 'idevaluation='.$tpEval->id));
											$qteNotes = 0;
											$qteCommentaires = 0;
											if(count($tempNotes)>0)
											{
												foreach ($tempNotes as $tpNote) {
													if($tpNote->notes!=100) $qteNotes++;
													if(!empty($tpNote->commentaire)) $qteCommentaires++;
												}
												$qteNotes = ($qteNotes*100)/count($tempNotes);
												$qteCommentaires = ($qteCommentaires*100)/count($tempNotes);
												$tempEvaluations[$i]->qteNotes=($qteNotes * 50 ) / 100;
												$tempEvaluations[$i]->qteCommentaires=($qteCommentaires* 50 ) / 100;
											}
											else{
												$tempEvaluations[$i]->qteNotes=0;
												$tempEvaluations[$i]->qteCommentaires=0;
												
											}

											foreach ($tempPonderations as $tpPond) {
												if($tpEval->idponderation == $tpPond->id)
													$tempEvaluations[$i]->ponderation = $tpPond;
											}

											foreach ($tempUsers as $tpUser) {
												if($tpEval->idevalue == $tpUser->id)
													$tempEvaluations[$i]->evalue = $tpUser;

												if($tpEval->idevaluateur == $tpUser->id)
													$tempEvaluations[$i]->evaluateur = $tpUser;
											}
											$tempEvaluations[$i]->datediff = $Tools->dateDifference(date('Y-m-d'), date_format(date_create($tpEval->targetdate), 'Y-m-d'));
											$i++;

										}
										$tempAnnees[$k]->userEvaluations=$tempEvaluations; 
										$tempAnnees[$k]->annee=$tempAnnee->annee; 
										$k++;
									}
									$tempEvalues[$j]=$tempAnnees; 
									$j++;
								}
								$this->datas['evalues'] = $tempEvalues;
							}
							else {
								$this->redirigerVers("admin/evaluations/");
							}
							
							$this->chargerViewLayout($this->layout, $this->direct.'evaluationsgrid', $this->datas);
						}
						break;

						default:
							$this->redirigerVers("admin/evaluations/");
						break;
					}
				}
				else
				{
					if( (isset($_GET['mois']) && preg_match("/^[0-9]+$/i", $_GET['mois']))
						&& (isset($_GET['annee']) && preg_match("/^[0-9]+$/i", $_GET['annee']))
						)
					{
						$Agent = $this->chargerMyModel('Model');
						$Agent->useTable("evaluations");
						$tempEvaluations = $Agent->trouver(array(
							'conditions'=>' mois='.$_GET['mois'].' AND annee='.$_GET['annee'],
							'ordre'=>' title ASC'));
					}
					else {
						$Agent = $this->chargerMyModel('Model');
						$Agent->useTable("evaluations");
						$tempEvaluations = $Agent->trouver(array('ordre'=>' title ASC'));
					}

					if(count($tempEvaluations) && isset($tempEvaluations[0]->id))
					{

						$Agent->useTable("ponderations");
						$tempPonderations = $Agent->trouver(array(
							'ordre'			=>' title ASC'));

						$Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
						$tempUsers = $Agent->trouver(array(
							'champs'		=>'users.id, employes.lastname, employes.firstname, employes.photo',
							'ordre'			=>' employes.firstname ASC'));

						$i=0;
						$Tools = $this->useUtility("Utilities");
						foreach ($tempEvaluations as $tpEval ){

							foreach ($tempPonderations as $tpPond) {
								if($tpEval->idponderation == $tpPond->id)
									$tempEvaluations[$i]->ponder = $tpPond;
							}

							foreach ($tempUsers as $tpUser) {
								if($tpEval->idevalue == $tpUser->id)
									$tempEvaluations[$i]->evalue = $tpUser;

								if($tpEval->idevaluateur == $tpUser->id)
									$tempEvaluations[$i]->evaluateur = $tpUser;
							}
							$tempEvaluations[$i]->datediff = $Tools->dateDifference(date('Y-m-d'), date_format(date_create($tpEval->targetdate), 'Y-m-d'));

							$tempEvaluations[$i]->nomMois = $Tools->nomMois($tpEval->mois);
							$i++;

						}
						$this->datas['evaluations'] = $tempEvaluations;
					}
					else $this->datas['evaluations'] = null;
					$this->chargerViewLayout($this->layout, $this->direct.'evaluations', $this->datas);
				}
			}
		
?>