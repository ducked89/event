<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Messages</h2>
        <small>Liste des recus et envoyés par/au utilisateurs du système.</small>
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
                                    <i class="fa fa-inbox "></i> Reception 
                                    <span class="label label-info pull-right"><?= $datas['nbMessagesRecus'];?></span> 
                                </a>
                            </li>
                            <li><a href="<?= SITE;?>admin/messages/envoyes/"><i class="fa fa-envelope-o"></i> Envoyés</a></li>
                        </ul>
                        <div class="clear50"></div>
                       <!--  <h5>Categories</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a id="1" class="selectType"> <i class="fa fa-circle text-navy"></i> Travail </a></li>
                            <li><a id="2" class="selectType"> <i class="fa fa-circle text-primary"></i> Important</a></li>
                            <li><a id="3" class="selectType"> <i class="fa fa-circle text-info"></i> Support</a></li>
                            <li><a id="4" class="selectType"> <i class="fa fa-circle text-warning"></i> Systeme</a></li>
                        </ul> -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Mailbox -->
        <div class="col-lg-9 animated fadeInRight">
       

            <!-- Mailbox Content Header -->
            <div class="mail-box-header">

                <form class="pull-right mail-search">
                    <div class="input-group">
                        <input id="searchMessagesInput" type="text" class="form-control input-sm" name="search" placeholder="Rechercher un message">
                        <div class="input-group-btn">
                            <button onclick="searchMessages();" type="button" class="btn btn-sm btn-info">Rechercher
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
                    Réception
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button id="deleteMessages" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Supression definitve de tous les messages"><i class="fa fa-trash-o"></i> Supprimer tout</button>

                       <div class="clear20"></div>
                        <p id="deleteAllMessages" class="delete-data">Etes-vous sur? Cette opération est irreversible.
                            <button class="ajax_delete_messages_yes btn btn-xs btn-success mgR10" >Oui</button>
                            <button class="ajax_delete_messages_no btn btn-xs btn-danger" >Non</button>
                        </p> 

                    </div>
                    <button id="refreshMessages" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Recharger la reception"><i class="fa fa-refresh"></i> Recharger</button>
                </div>
            </div>
            

            <!-- Mailbox Content list -->
            <div class="mail-box" id="loadingMessageBox">
                <div class="ibox-content no-bg">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                        <table class="table table-hover table-mail">
                            <tbody id="messageBox">
                            
                            <?php
                                if(count($datas['mMessagesRecus'])>0){

                                    foreach ($datas['mMessagesRecus'] as $mMessage) {
                                        if($mMessage->statut==0) echo '<tr class="unread">';
                                        else echo '<tr class="read">';

                                        echo'
                                            <td class="mail-ontact">
                                            <i class="fa fa-angle-double-right mgR10"></i>
                                            <a class="showMessage" data-id="'.$mMessage->id.'">'.$mMessage->sender.'</a></td>
                                            <td class="mail-subject">'.substr($mMessage->title, 0, 100).'
                                            <div class="clear20"></div>
                                                <div class="col-sm-12 showMessageBox'.$mMessage->id.' delete-data">
                                                    <div class="ibox-content">'.$mMessage->content.'</div>
                                                </div>
                                            </td>
                                            <td class="text-right mail-date">
                                                <a class="showMessage  btn btn-warning btn-xs mgR10" data-id="'.$mMessage->id.'">Afficher</a>
                                                  <a class="messageNonLu  btn btn-white btn-xs mgR10" data-id="'.$mMessage->id.'">Marquer non lu</a>
                                                <a href="'.SITE.'admin/messages/reply/?idu='.$mMessage->id.'" class="btn btn-info btn-xs mgR10">Repondre</a>
                                                '.date_format(date_create($mMessage->datecreated), "d M Y à H:i").'</td>
                                                
                                        </tr>

                                        ';
                                    }
                                 }
                                 else
                                    echo '<div class="alert alert-warning">Désolé, aucun message trouvés !</div>';
                            ?>
                            
                           
                            </tbody>
                        </table>
                </div>
            </div>

            <?php echo $datas['paginate'];?>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function(){
        $('#refreshMessages').click(function () {
            var btn = $(this);
            simpleLoad(btn, true);
            refreshMessages();
            simpleLoad(btn, false);
        });
   
    });
    function simpleLoad(btn, state) {
        if (state) {
            $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Rechargement");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Recharger");
                $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
            }, 1000);
        }
    }
    
    //AJAX Recharger la liste des employes
    function refreshMessages ()
    {
        $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsMessages.php',
            dataType: 'html',
            data: "id=refresh_message_form",
            cache: false,
            success: function(html)
            {
                $("#messageBox").hide();
                $("#messageBox").html(html).fadeIn();
                $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
            }
        });         
    }

    //AJAX Recchercher un employe
    function searchMessages ()
    {
        $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
        var val= $("#searchMessagesInput").val();
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsMessages.php',
            dataType: 'html',
            data: "id=search_message_form&text="+val,
            cache: false,
            success: function(html)
                {
                    $("#messageBox").hide();
                    $("#messageBox").html(html).fadeIn();
                    $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
                }
            });  
    }

    $(document).on("click", ".showMessage", function (e)
    {
        e.preventDefault();
        var mid=$(this).attr("data-id");
        $(".showMessageBox"+mid).slideToggle();

        $.ajax({
        type: "POST",
        url: root+'app/php_ajax/actionsMessages.php',
        dataType: 'html',
        data: "id=update_message_recu&idu="+mid,
        cache: false,
        success: function(code)
            {
               
            }
        });

    });


    $(document).on("click", ".messageNonLu", function (e)
    {
        e.preventDefault();
        var mid=$(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsMessages.php',
            dataType: 'html',
            data: "id=update_message_nonlu&idu="+mid,
            cache: false,
            success: function(code)
                {
                   if(code=="YES"){
                    toastr.info('Operation effectuee avec success','Notification !');
                    refreshMessages();
                    }
                    else 
                    toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                }
        });

    });

    $(document).on("click", "#deleteMessages", function (e)
    {
        e.preventDefault();
        $("#deleteAllMessages").slideToggle();
    });


    $(document).on("click", ".ajax_delete_messages_yes", function (e)
    {
        $('#loadingMessageBox').children('.ibox-content').toggleClass('sk-loading'); 
        $.ajax({
        type: "POST",
        url: root+'app/php_ajax/actionsMessages.php',
        dataType: 'html',
        data: "id=delete_messages_recus",
        cache: false,
        success: function(code)
            {
                if(code=="YES"){
                    toastr.info('Operation effectuee avec success','Notification !');
                    window.location.href = root+"admin/messages/";
                }
                else 
                toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
            }
        });
    });

    $(document).on("click", ".ajax_delete_messages_no", function (e)
    {
        $("#deleteAllMessages").slideToggle();
    });

</script>