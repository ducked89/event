<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
     <h2>Notifications</h2>
     <small>Messages de notification envoyés par l'administrateur et/ou générés par le système.</small>
    </div>
</div>
<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <h4>Vous avez : <?=$datas['nbNotifications'][0]->nb;?> notifications</h4>
    <div class="clear20"></div>
    <?php  
    if(count($datas['notifications'])>0 && isset($datas['notifications'][0]->id))
    {
        $i=0;
        foreach ($datas['notifications'] as $data) {
            echo '
            <div class="faq-item">
                <div class="row">
                    <div class="col-md-7">
                        <a data-toggle="collapse" href="#noti'.$data->id.'" class="faq-question">
                            <div class="btn btn-info floatL mgR20"><i class="fa fa-angle-double-down "></i></div>'.ucfirst($data->title).'</a>
                        <small>Added by <strong>'.$data->type.'</strong> <i class="fa fa-clock-o"></i>
                            ';if($datas['notifications'][$i]->datediff > 0)
                            echo $datas['notifications'][$i]->datediff.' jour(s)';
                            else echo 'Aujourd\'hui';
                            echo '   </small></div> </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="noti'.$data->id.'" class="panel-collapse collapse">
                                        <div class="faq-answer">
                                            <p>'.$data->content.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                $i++;
            }

            echo ' <div class="clear50></div>'.$datas['paginate'];

        }
        else echo '
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <strong>Oups !</strong> Desolé .Aucune notification trouvée.
        </div>';
        ?>
</div>
