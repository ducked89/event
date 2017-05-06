
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Avis disciplinaires</h2>
        <small>Quelques principes et notes sur l'utilisation de ce système.</small>
    </div>
</div>
<div class="clear20"></div>

<div class="row">
    <div class="col-lg-offset-1 col-lg-10">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Lisez avec soin puis confirmez l'acceptation de cette note.</h5>
            </div>
            <div class="ibox-content">

                    <?php
                        if (isset($datas['result'])) {

                            switch ($datas['result']) {
                                case 'nsaved':
                                   echo'<div class="alert alert-success">Merci de votre comprehension et l\'acceptation de cette note.<br/>Bonne navigation !. </div>';
                                    break;

                                case 'notsaved':
                                   echo'<div class="alert alert-warning">Oups ! Une erreur s\'est produite, veuillez re-essayer!.</div>';
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        }
                    ?>


                    <?php

                        if(isset($datas['result']) && $datas['result']=="nsaved"){
                            echo '<a href="'.SITE.'members/profile/" class="btn btn-danger">Revenir</a>';
                        }
                        else{
                    ?>

                <div class="clear50"></div>

                <p><?=$datas['site']->notice;?></p>

                <hr>
                <form class="form-horizontal" action="<?php echo SITE;?>members/notice/" method="POST"  >
                   <div class="form-group alert alert-info">
                        <fieldset id="notice">
                            <input type="checkbox" value="1" name="notice" class="mgR20"><span class="mgL20">J'accepte les conditions</span>
                        </fieldset>
                    </div>
                    <div class="form-group">
                    <div class="clear20"></div>
                        <div class="col-lg-offset-4 col-lg-10">
                            <button id="savePassword" name="cuNotice" class="btn btn-primary mgR20">J'accepte</button>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>