 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Pondérations</h2>
        <small>Liste des pondérations d'évènement des organisateurs</small>
        <a href="<?php echo SITE;?>admin/ponderations/add/" class="btn btn-primary btn-sm floatR">Ajouter une pondération</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="wrapper wrapper-content animated fadeInUp">

        <div class="ibox">
            <div class="ibox-title">
                <h5>Profil de pondérations </h5>

            </div>
            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-1">
                        <button type="button" id="refreshPonderations" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Recharger</button>
                    </div>
                    <div class="col-md-11">
                        <div class="input-group"><input id="searchPonderationsInput" type="text" onchange="searchPonderations();" placeholder="Recherche..." class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" onclick="searchPonderations();" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                    </div>
                </div>

                <div class="project-list" id="loginPonderationBox">
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
                                if(count($datas['ponderations'])>0 && isset($datas['ponderations'][0]->id))
                                {
                                    foreach ($datas['ponderations'] as $data) {
                                        echo '
                                            <tr>
                                                <td class="project-title">
                                                <a href="'.SITE.'admin/ponderations/items/?idu='.$data->id.'">
                                                <h3><strong>'.$data->title.'</strong></h3></a>
                                                <small>Creation : '.date_format(date_create($data->datecreated), "d M Y").'</small>
                                                </td>
                                                <td class="project-completion">
                                                    <p>';
                                                    if(!empty($data->description)) echo $data->description;
                                                    else echo'<span class="infoalert">Aucune description !</span>';
                                                echo '</p>
                                                </td>
                                                <td class="project-actions">
                                                <a href="'.SITE.'admin/ponderations/items/?idu='.$data->id.'" class="btn btn-white btn-sm mgR20"><i class="fa fa-list "></i> Critères </a>

                                                    <a href="'.SITE.'admin/ponderations/edit/?idu='.$data->id.'" class="btn btn-white btn-sm mgR20"><i class="fa fa-pencil "></i> Edit </a>

                                                    <a data-id="'.$data->id.'" class="ajax_delete_ponderation btn btn-white btn-sm floatR"><i class="fa fa-trash"></i> </a>

                                                    <div class="clear"></div>
                                                       <p id="delete'.$data->id.'" class="delete-data">Etes-vous sur? 
                                                            <button class="ajax_delete_ponderation_yes btn btn-xs btn-success mgR10" data-id="'.$data->id.'" >Oui</button>
                                                            <button class="ajax_delete_ponderation_no btn btn-xs btn-danger" data-id="'.$data->id.'">Non</button>
                                                        </p> 
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }
                                else echo '<tr>
                                <td colspan="4" class="nodata">
                                        <div class="alert alert-block alert-danger "><strong>Oups !</strong> Desolé. Aucun ponderation trouvé.
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
        $('#refreshPonderations').click(function () {
            var btn = $(this);
            simpleLoad(btn, true);
            refreshPonderations();
            simpleLoad(btn, false);
        });
     });   

    function simpleLoad(btn, state) {
        if (state) {
            $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Rechargement");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Recharger");
                $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
            }, 1000);
        }
    }

    //AJAX Recchercher un ponderation
    function searchPonderations ()
    {
        setTimeout(function () {
            $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
            var val= $("#searchPonderationsInput").val();
            $.ajax({
                type: "POST",
                url: root+'app/php_ajax/actionsCriteres.php',
                dataType: 'html',
                data: "id=search_ponderation_form&text="+val,
                cache: false,
                success: function(html)
                    {
                        $("#dataTable tbody").hide();
                        $("#dataTable tbody").html(html).fadeIn();
                        $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
                    }
                });  
        },  1000);       
    }

    //AJAX Recharger la liste des ponderations
    function refreshPonderations ()
    {
        $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsCriteres.php',
            dataType: 'html',
            data: "id=refresh_ponderation_form",
            cache: false,
            success: function(html)
            {
                $("#dataTable tbody").hide();
                $("#dataTable tbody").html(html).fadeIn();
                $('#loginPonderationBox').children('.ibox-content').toggleClass('sk-loading'); 
            }
        });         
    }

    // Activation & Desactivation d'un ponderation
    $(document).on("click", ".ajaxChangeStatutPonderation", function(e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var stat = $(this).attr('data-value');

        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsPonderations.php',
            dataType: 'html',
            data: "id=ajax_change_statut_ponderation&opt="+stat+"&idu="+id,
            cache: false,
            success: function(code)
            {
                if(code="YES")
                toastr.info('Operation effectuee avec success','Notification !');
                else 
                toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                refreshPonderations ();
            }
        });

        // alert(id+" - Stat = "+stat);
    });


    $(document).on("click", ".ajax_delete_ponderation", function (e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

    $(document).on("click", ".ajax_delete_ponderation_yes", function (e)
    {
        var id = $(this).attr('data-id');
        // $("p."+id).hide();

        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsPonderations.php',
            dataType: 'html',
            data: "id=delete_ponderation_form&idu="+id,
            cache: false,
            success: function(code)
                {
                    if(code="YES")
                    toastr.info('Operation effectuee avec success','Notification !');
                    else 
                    toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                    refreshPonderations ();          
                }
            });

    });

    $(document).on("click", ".ajax_delete_ponderation_no", function (e)
    {
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

</script>
