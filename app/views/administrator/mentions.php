 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Mentions</h2>
        <small>Liste des mentions/notes pour les criteres d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/evaluations/" class="btn btn-warning btn-sm floatR ">Listes évènements</a>
        <a href="<?php echo SITE;?>admin/mentions/add/" class="btn btn-primary btn-sm floatR mgR20">Ajouter une mention</a>
        
    </div>
</div>

<div class="clear20"></div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                <div class="ibox-title">
                    <h5>Liste des mentions</h5>
                </div>

                <?php
                    if(count($datas['mentions'])>0){
                        echo'<div class="ibox-content">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <strong>'.count($datas['mentions']).' mention(s) trouvée(s).</strong>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-print"></i> Exporter</button>
                                    </div>
                                    
                                    <div class="col-md-6 pull-right input-group">
                                        <input id="searchMentionInput" type="text" placeholder="Recherche par titre..." onchange="searchMentions();" class=" form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info" onclick="searchMentions();"> Rechercher</button>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="clear20"></div>

                                
                                <div class="project-list" id="loginDataBox">
                                    <div class="ibox-content">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>

                                        <table id="dataTable" class="table table-hover issue-tracker">
                                            <tbody>';

                                                foreach ($datas['mentions'] as $mMention) {
                                                    echo'
                                                    <tr class="padding20">
                                                        <td>
                                                            <span class="label label-primary mention-number">'.$mMention->level.'</span>
                                                        </td>
                                                        <td class="project-title">
                                                        <a href="'.SITE.'admin/mentions/edit/?idu='.$mMention->id.'"><h3>'.$mMention->title.'</h3></a>
                                                        </td>
                                                        <td class="project-title">'.$mMention->description.'</td>
                                                        <td> '.date_format(date_create($mMention->datecreated), "d M Y").'</td>
                                                        <td class="text-right">
                                                        <a href="'.SITE.'admin/mentions/edit/?idu='.$mMention->id.'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                        </td>
                                                    </tr>';
                                                }
                                            
                                                echo'
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                

                            </div>';

                    }
                    else echo '<div class="alert alert-danger">Oups !. Desolé, aucune mentions trouvées</div>';
                ?>
                                

            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    //AJAX Recchercher un critere
    function searchMentions ()
    {
        $('#loginDataBox').children('.ibox-content').toggleClass('sk-loading'); 
        var val= $("#searchMentionInput").val();
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsCriteres.php',
            dataType: 'html',
            data: "id=search_mention_form&text="+val,
            cache: false,
            success: function(html)
                {
                    $("#dataTable tbody").hide();
                    $("#dataTable tbody").html(html).fadeIn();
                    $('#loginDataBox').children('.ibox-content').toggleClass('sk-loading'); 
                }
            });  
    }

</script>
