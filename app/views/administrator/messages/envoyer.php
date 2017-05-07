<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Messages</h2>
        <small>Liste des recus et envoys par/au utilisateurs du système.</small>
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
                        <a class="btn btn-block btn-primary compose-mail" href="<?= SITE;?>administrator/messages/compose/">Composer un message</a>
                        <div class="space-25"></div>
                        <h5>Dossiers</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li>
                                <a href="<?= SITE;?>administrator/messages/">
                                    <i class="fa fa-inbox "></i> Reception
                                    <span class="label label-info pull-right"><?= $datas['nbMessagesRecus'];?></span>
                                </a>
                            </li>
                            <li><a href="<?= SITE;?>administrator/messages/envoyes/"><i class="fa fa-envelope-o"></i> Envoyes</a></li>
                        </ul>
                        <!-- <div class="clear50"></div>
                        <h5>Categories</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a id="1" class="selectType"> <i class="fa fa-circle text-navy"></i> Travail </a></li>
                            <li><a id="2" class="selectType"> <i class="fa fa-circle text-primary"></i> Important</a></li>
                            <li><a id="3" class="selectType"> <i class="fa fa-circle text-info"></i> Support</a></li>
                            <li><a id="4" class="selectType"> <i class="fa fa-circle text-warning"></i> Systeme</a></li>
                        </ul>
                        <div class="clearfix"></div> -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Mailbox -->
        <div class="col-lg-9 animated fadeInRight">


            <!-- Mailbox Content Header -->
            <div class="mail-box-header">
                <h2>Envoyes (<?=$datas['nbMessagesEnvoyes'];?>)</h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button id="deleteMessages" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Supression definitve de tous les messages"><i class="fa fa-trash-o"></i> Suprimer tout</button>

                       <div class="clear20"></div>
                        <p id="deleteAllMessages" class="delete-data">Etes-vous sur? Cette operation est ireversible.
                            <button class="ajax_delete_messages_yes btn btn-xs btn-success mgR10" >Oui</button>
                            <button class="ajax_delete_messages_no btn btn-xs btn-danger" >Non</button>
                        </p>

                    </div>
                </div>
            </div>


            <!-- Mailbox Content list -->
            <div class="mail-box">
                <table class="table table-hover table-mail">
                    <tbody>

                    <?php
                        foreach ($datas['mMessagesEnvoyes'] as $mMessage) {
                            echo '<tr class="read"><td class="mail-ontact">
                                <i class="fa fa-angle-double-right mgR10"></i>
                                <a href="'.SITE.'administrator/messages/read/?idu='.$mMessage->id.'">'.$mMessage->sender.'</a></td>
                                <td class="mail-subject">'.substr($mMessage->title, 0, 100).'
                                    <div class="clear20"></div>
                                    <div class="showMessageBox'.$mMessage->id.' delete-data">'.$mMessage->content.'</div>
                                </td>
                                <td class="text-right mail-date">
                                <a class="showMessage  btn btn-white btn-sm mgR10" data-id="'.$mMessage->id.'">Afficher</a>
                                '.date_format(date_create($mMessage->datecreated), "d M Y à H:i").'</td>
                            </tr>';
                        }

                    ?>


                    </tbody>
                </table>
            </div>

            <?php echo $datas['paginate'];?>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(document).on("click", "#deleteMessages", function (e)
    {
        e.preventDefault();
        $("#deleteAllMessages").slideToggle();
    });

    $(document).on("click", ".showMessage", function (e)
    {
        e.preventDefault();
        var mid=$(this).attr("data-id");
        $(".showMessageBox"+mid).slideToggle();
    });

    $(document).on("click", ".ajax_delete_messages_yes", function (e)
    {
        $('#loginMessagenBox').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
        type: "POST",
        url: root+'app/php_ajax/actionsMessages.php',
        dataType: 'html',
        data: "id=delete_messages_envoyes",
        cache: false,
        success: function(code)
            {
                if(code=="YES"){
                    toastr.info('Operation effectuee avec success','Notification !');
                    window.location.href = root+"administrator/messages/";
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
