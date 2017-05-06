 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Services</h2>
        <small>Liste des differents service/departements de l'HEC</small>
        <a href="<?php echo SITE;?>admin/employes/" class="btn btn-warning btn-sm floatR">Liste organisateurs</a>
        <a href="<?php echo SITE;?>admin/services/add/" class="btn btn-primary btn-sm floatR mgR20">Ajouter un service</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="wrapper wrapper-content animated fadeInUp">

        <div class="ibox">
            <div class="ibox-title">
                <h5>Liste des serives </h5>

            </div>
            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-1">
                        <button type="button" id="refreshServices" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Recharger</button>
                    </div>
                    <div class="col-md-11">
                        <div class="input-group"><input id="searchServicesInput" type="text" onchange="searchServices();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" onclick="searchServices();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                    </div>
                </div>

                <div class="project-list" id="loginServiceBox">
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>

                        <table class="table table-hover" id="dataTable">
                            <tbody>

                            <?php
                                if(count($datas['services'])>0 && isset($datas['services'][0]->id))
                                {
                                    foreach ($datas['services'] as $data) {
                                        echo '
                                            <tr>
                                                <td class="project-title">
                                                <a href="'.SITE.'admin/services/edit/?idu='.$data->id.'">
                                                <h3><strong>'.$data->title.'</strong></h3></a>
                                                <small>Creation : '.date_format(date_create($data->datecreated), "d M Y").'</small>
                                                </td>

                                                <td class="project-completion">
                                                    <p>';
                                                    if(!empty($data->description)) echo $data->description;
                                                    else echo'<span class="infoalert">Aucune description !</span>';
                                                echo '</p>
                                                </td>
                                                <td>';
                                                    if(isset($data->employes) && count($data->employes)>0)
                                                    {

                                                        echo count($data->employes).' employe(s) 
                                                        <a data-id="'.$data->id.'" class="showEmployes btn btn-white btn-sm floatR"><i class="fa fa-group "></i> List employes </a>
                                                        
                                                        <div class="clear20"></div>
                                                        <div class="employesList'.$data->id.' delete-data">
                                                             <ul class="employe-row">';

                                                             foreach ($data->employes as $mEmploye) {
                                                                echo'<li >
                                                                    <i class="fa fa-user mgR20"></i>
                                                                    <a href="'.SITE.'admin/employes/view/?idu='.$mEmploye->id.'">'.$mEmploye->firstname.' '.$mEmploye->lastname.'</a>
                                                                </li>';
                                                            }
                                                            echo'
                                                            </ul>
                                                        </div>';
                                                    }
                                                    else echo'<span class="alert alert-warning">Aucun employe trouve dans ce service.</span>';
                                                        echo'
                                                    
                                                </td>
                                                <td class="project-actions">
                                                

                                                    <a href="'.SITE.'admin/services/edit/?idu='.$data->id.'" class="btn btn-white btn-sm mgR20"><i class="fa fa-pencil "></i> Edit </a>

                                                    <a data-id="'.$data->id.'" class="ajax_delete_service btn btn-white btn-sm floatR"><i class="fa fa-trash"></i> </a>

                                                    <div class="clear"></div>
                                                       <p id="delete'.$data->id.'" class="delete-data">Etes-vous sur? 
                                                            <button class="ajax_delete_service_yes btn btn-xs btn-success mgR10" data-id="'.$data->id.'" >Oui</button>
                                                            <button class="ajax_delete_service_no btn btn-xs btn-danger" data-id="'.$data->id.'">Non</button>
                                                        </p> 
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }
                                else echo '<tr>
                                <td colspan="4" class="nodata">
                                        <div class="alert alert-block alert-danger "><strong>Oups !</strong> Desolé. Aucun service trouvé.
                                        </div>
                                    </td>
                                </tr>';     
                            ?>
                            

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#refreshServices').click(function () {
            var btn = $(this);
            simpleLoad(btn, true);
            refreshServices();
            simpleLoad(btn, false);
        });
     });   

    function simpleLoad(btn, state) {
        if (state) {
            $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Rechargement");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Recharger");
                $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
            }, 1000);
        }
    }

    //AJAX Recchercher un service
    function searchServices ()
    {
        setTimeout(function () {
            $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
            var val= $("#searchServicesInput").val();
            $.ajax({
                type: "POST",
                url: root+'app/php_ajax/actionsServices.php',
                dataType: 'html',
                data: "id=search_service_form&text="+val,
                cache: false,
                success: function(html)
                    {
                        $("#dataTable tbody").hide();
                        $("#dataTable tbody").html(html).fadeIn();
                        $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
                    }
                });  
        },  1000);       
    }

    //AJAX Recharger la liste des services
    function refreshServices ()
    {
        $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsServices.php',
            dataType: 'html',
            data: "id=refresh_service_form",
            cache: false,
            success: function(html)
            {
                $("#dataTable tbody").hide();
                $("#dataTable tbody").html(html).fadeIn();
                $('#loginServiceBox').children('.ibox-content').toggleClass('sk-loading'); 
            }
        });         
    }

    // Afficher liste utilisateur
     $(document).on("click", ".showEmployes", function (e)
    {
        e.preventDefault();
        var mid=$(this).attr("data-id");
        $(".employesList"+mid).slideToggle();
    });

    $(document).on("click", ".ajax_delete_service", function (e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });
    $(document).on("click", ".ajax_delete_service_no", function (e)
    {
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });
</script>
