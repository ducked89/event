 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Organisateurs</h2>
        <small>Liste des organisateurs d'évènements disponibles dans le système.</small>
        <a href="<?php echo SITE;?>admin/employes/export/" class="btn btn-info btn-sm floatR">Exporter</a>
        <a href="<?php echo SITE;?>admin/services/" class="btn btn-warning btn-sm floatR mgR20">Liste services</a>
        <a href="<?php echo SITE;?>admin/employes/add/" class="btn btn-primary btn-sm floatR mgR20">Ajouter un organisateur</a>
    </div>
</div>

<div class="row row-bg">
	<div class="wrapper wrapper-content animated fadeInRight">

		<div class="ibox-content">
	        <div class="row m-b-sm m-t-sm">
	            <div class="col-md-1">
	                <button type="button" id="refreshEmployes" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Recharger</button>
	            </div>
	            <div class="col-md-11">
	                <div class="input-group"><input id="searchEmployesInput" type="text" onchange="searchEmployes();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
	                    <button type="button" onclick="searchEmployes();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
	            </div>
	        </div> 
		</div>


		<div class="row" id="loadingEmployeBox">
	        <div class="ibox-content no-bg">
	            <div class="sk-spinner sk-spinner-wave">
	                <div class="sk-rect1"></div>
	                <div class="sk-rect2"></div>
	                <div class="sk-rect3"></div>
	                <div class="sk-rect4"></div>
	                <div class="sk-rect5"></div>
	            </div>
	            <div id="employesBox">
				 <?php
			            if(count($datas['employes'])>0 && isset($datas['employes'][0]->id))
			            {
			            	$i=0;
			                foreach ($datas['employes'] as $data) {
			                	if($i%4==0) echo '<div class="clear20"></div>';
			                    echo '
			                    <div class="col-lg-3">
							        <div class="contact-box center-version center-content">

								            <a href="'.SITE.'admin/employes/photo/?idu='.$data->id.'">
								                <img alt="image" class="img-circle" src="'.SITE.'public/images/profiles/';
								                if(empty($data->photo) || $data->photo=="") echo 'profile.jpg';
								                else echo $data->photo;

								            echo '"></a>
								            <a class="nopadding" href="'.SITE.'admin/employes/view/?idu='.$data->id.'">
								                <h3 class="m-b-xs"><strong>'.$data->firstname.', '.$data->lastname.'</strong></h3>
											 </a>';


                                            if(isset($data->service))
                                                echo'<div class="font-bold infoalert">'.$data->service->title.'</div>';
                                            else echo '<span class="infored">Service inconnu  !</span>';
                                           
                                            echo'<div>'.$data->position.'</div>
                                            <address class="m-t-md center-content">';

    							                if(isset($data->compte))
    							                	echo'
    							                    <strong><a href="'.SITE.'admin/account/view/?idu='.$data->compte->id.'">'.$data->compte->login.'</a></strong><br>';
    							                 else
    							                 	echo '<span class="infored">Aucun compte</span><br/>';
    							                 echo
    							                 	$data->email.'<br>
    							                    '.$data->adresse.'<br>
    							                    <abbr title="Phone">P:</abbr> '.$data->phone.'  / Ext. '.$data->extension.'<br>
							                </address>
											<div class="clear20"></div>
							           
							            <div class="contact-box-footer contact-box-footer-bg">
							                <div class="m-t-xs btn-group">
							                    <a href="'.SITE.'admin/employes/view/?idu='.$data->id.'" class="btn btn-xs btn-white btn-white-border mgR10"><i class="fa fa-eye"></i> Voir</a>
							                    <a href="'.SITE.'admin/employes/edit/?idu='.$data->id.'" class="btn btn-xs btn-white btn-white-border mgR10"><i class="fa fa-edit"></i> Edit</a>
							                    <a class="ajax_delete_employe btn btn-xs btn-white btn-white-border" data-id="'.$data->id.'" ><i class="fa fa-trash"></i> Del.</a>
							                </div>
							            </div>

							            <div class="clear"></div>
				                        <p id="delete'.$data->id.'" class="delete-data">Etes-vous sur? 
			                                <button class="ajax_delete_employe_yes btn btn-xs btn-success mgR10" data-id="'.$data->id.'" >Oui</button>
			                                <button class="ajax_delete_employe_no btn btn-xs btn-danger" data-id="'.$data->id.'">Non</button>
				                        </p> 
							        </div>
							    </div>
								';
								$i++;
			                }
			            }
			            else echo '<div class="alert alert-block alert-info "><strong>Oups !</strong> Desolé. Aucun employé trouvé.</div>'; 
			        ?>  	   
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
	$(document).ready(function(){
        $('#refreshEmployes').click(function () {
            var btn = $(this);
            simpleLoad(btn, true);
            refreshEmployes();
            simpleLoad(btn, false);
        });
   
	});
    function simpleLoad(btn, state) {
        if (state) {
            $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Rechargement");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Recharger");
                $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
            }, 1000);
        }
    }

    //AJAX Recchercher un employe
    function searchEmployes ()
    {
        $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
        var val= $("#searchEmployesInput").val();
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsEmployes.php',
            dataType: 'html',
            data: "id=search_employe_form&text="+val,
            cache: false,
            success: function(html)
                {
                    $("#employesBox").hide();
                    $("#employesBox").html(html).fadeIn();
                    $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
                }
            });  
    }

    //AJAX Recharger la liste des employes
    function refreshEmployes ()
    {
        $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsEmployes.php',
            dataType: 'html',
            data: "id=refresh_employe_form",
            cache: false,
            success: function(html)
            {
                $("#employesBox").hide();
                $("#employesBox").html(html).fadeIn();
                $('#loadingEmployeBox').children('.ibox-content').toggleClass('sk-loading'); 
            }
        });         
    }

    // Activation & Desactivation d'un employe
    $(document).on("click", ".ajaxChangeStatutCritere", function(e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var stat = $(this).attr('data-value');

        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsEmployes.php',
            dataType: 'html',
            data: "id=ajax_change_statut_employe&opt="+stat+"&idu="+id,
            cache: false,
            success: function(code)
            {
                if(code=="YES")
                toastr.info('Operation effectuee avec success','Notification !');
                else 
                toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                refreshEmployes ();
            }
        });

        // alert(id+" - Stat = "+stat);
    });


    $(document).on("click", ".ajax_delete_employe", function (e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

    $(document).on("click", ".ajax_delete_employe_yes", function (e)
    {
        var id = $(this).attr('data-id');
        // $("p."+id).hide();

        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsEmployes.php',
            dataType: 'html',
            data: "id=delete_employe_form&idu="+id,
            cache: false,
            success: function(code)
                {
                    if(code=="YES")
                    toastr.info('Operation effectuee avec success','Notification !');
                    else 
                    toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                    refreshEmployes ();          
                }
            });

    });

    $(document).on("click", ".ajax_delete_employe_no", function (e)
    {
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

</script>
