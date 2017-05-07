<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Parametres</h2>
        <small>Definir les parametres du systeme</small>
        <a href="<?php echo SITE;?>administrator/mentions/" class="btn btn-success btn-sm floatR "><i class="fa fa-home mgR10"></i>Dashboard</a>
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Modifier le logo du site</h3>
                </div>
                <div class="ibox-content col-lg-12">

                    <div class="col-lg-7">
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
                        <form class="form-horizontal" action="<?php echo SITE;?>administrator/parametres/logo/" method="POST" enctype="multipart/form-data"  >

                                <div class="form-group col-lg-12">
                                   <img src="<?= SITE;?>public/images/<?=$site->logo;?>" alt="Page Banner">
                                </div>

                                <div class="clear20"></div>
                                <div class="form-group col-lg-8">
                                    <label class=" control-label">Fichier</label><br/>
                                        <input type="file"  name="photo" required class="form-control form-control-expand" />
                                </div>

                				<div class="clear50"></div>

                                <div class="form-group col-lg-8">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="uploadLogo" class="btn btn-w-m btn-success mgR20" type="submit">Changer</button>

                                         <a href="<?= SITE;?>administrator/parametres/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
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
p
