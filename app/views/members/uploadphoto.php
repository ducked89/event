 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Profil</h2>
        <small>Affichage des informations générales sur mon profil.</small>
        <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/profile/view/?idu=<?= $datas['employes']->iduser ?>">Voir mon profil</a>
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h3>Modifier la photo de profil</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-12">
                        <?php
                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>".$datas['error']['error']."</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['size']))
                            echo "<div class='alert alert-warning'>".$datas['error']['size']."</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['upload']))
                            echo "<div class='alert alert-warning'>".$datas['error']['upload']."</div>
                                <div class='clear50'></div>";

                            if(isset($datas['error']['format']))
                            echo "<div class='alert alert-danger'>".$datas['error']['format']."</div>
                                <div class='clear50'></div>";                            

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE.'members/profile/photo/';?>" method="POST" enctype="multipart/form-data"  >                                

                                <div class="form-group col-lg-4">
                                    <?php
                                        if(!empty($datas['employes']->photo)) 
                                            echo '<img src="'.SITE.'public/images/profiles/'.$datas['employes']->photo.'" class="img-lg" />';
                                        else echo '<img src="'.SITE.'public/images/profiles/profile.jpg" class="img-lg" />';
                                    ?>
                                    <br/><br/><h3><?= $datas['employes']->firstname.' '.$datas['employes']->lastname;?></h3>
                                </div>
                                
                                <div class="form-group col-lg-8">
                                    <label class=" control-label">Fichier</label><br/>
                                        <input type="file"  name="photo" required class="form-control form-control-expand" />
                                    <div class="clear50"></div>

                                    <div class="col-lg-offset-2 col-lg-8">
                                        <button name="uploadphoto" class="btn btn-w-m btn-success mgR20" type="submit">Changer</button>

                                         <a href="<?= SITE;?>members/profile/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
                                    </div>
                                </div>
                        </form>
                        <div class="clear50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

