 <?php  
    $mPonderation = (object)($datas['mdatas']);
    $mCritere =$datas['criteres'];
    $mAllCriteres =$datas['allcriteres'];
?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Ponderations</h2>
        <small>Liste des ponderations d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/ponderations/" class="btn btn-primary btn-sm floatR">Liste ponderations</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Affecter des criteres a un profil de ponderation</h3>
                    <span>Cet objet va vous permettre de definir un pourcentage de la note de chaque criteres affectes.</span>
                </div>
                <div class="ibox-content col-lg-12">
                    <div class=" col-lg-6">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                                <div class='clear50'></div>";                           

                        ?>
                        <form class="form-horizontal" method="POST"  >
                                <div class="clear50"></div>
                                <input type="hidden" name="idponderation" id="idponderation" value="<?= $mPonderation->id;?>">
                                <div class="form-group"><label class="col-lg-2 control-label">Ponderation</label>
                                    <div class="col-lg-10"><input value="<?= $mPonderation->title;?>" name="title" placeholder="Titre du profil de ponderation" required class="form-control" type="text " disabled> </div>
                                </div>
                                

                                <div class="form-group"><label class="col-lg-2 control-label">Criteres</label>
                                    <div class="col-lg-10">
                                        <select class="form-control select2_demo_1" name="idcritere" id="idcritere">
                                            <?php
                                                foreach ($mAllCriteres as $mAllCritere) {
                                                    echo '<option value="'.$mAllCritere->id.'">'. $mAllCritere->title.'</option> ';
                                                }
                                            ?>   
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group"><label class="col-lg-2 control-label">Pourcentage</label>
                                    <div class="col-lg-10">
                                    <div class="row">
                                    <div class="col-md-10">
                                    <select class="form-control" name="percent" id="percent" class="mgR10">
                                        <?php
                                            for ($i=1; $i<=100; $i++) {
                                                if($i%5==0)
                                                echo '<option value="'.$i.'">'. $i.'</option> ';
                                            }
                                        ?>   
                                    </select></div><div class="col-md-2">%</div>
                                    </div>
                                    </div>
                                </div>

                                 <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  id="description" name="description" class="form-control sm-textarea"></textarea></div>
                                </div>

                                <div id="percenterror"></div>

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button id="ajaxAddPonderationCritere" class="btn btn-w-m btn-success mgR20" >Affecter</button>

                                         <a href="<?= SITE;?>admin/ponderations/"><button type="button" class="btn btn-w-m btn-danger">Annuler</button></a>
                                    </div>
                                </div>
                        </form>
                        <div class="clear50"></div>
                    </div>

                    <div class=" col-lg-5">
                        <div class="clear50"></div>
                        <h3>Liste des criteres affectes</h3>
                        <div id="ponderationCritereLoading">
                            <div class="ibox-content no-bg">
                                <div class="sk-spinner sk-spinner-wave">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                                <div id="ponderationCritereBox">
                                    <?php
                                        if(count($mCritere)>0){
                                            foreach ($mCritere as $mCrit) {
                                                echo '<ol class="dd-list" >
                                                        <li class="dd-item" data-id="2">
                                                        <div class="dd-handle">
                                                                <button  data-id="'.$mCrit->id.'" class="ajax_delete_critere_ponderation btn btn-xs btn-danger pull-right"> Del</button>
                                                                <span class="pull-right mgR20"> '.$mCrit->percent.' %</span>
                                                                <span class="label label-info mgR10" data-toggle="collapse" href="#desc-'.$mCrit->id.'">
                                                                <i class="fa fa-angle-double-right "></i></span>'.$mCrit->title.'
                                                            
                                                                <div id="desc-'.$mCrit->id.'" class="panel-collapse collapse ibox-content">
                                                                    '.$mCrit->description.'
                                                                </div>
                                                            </div>


                                                             <p id="delete'.$mCrit->id.'" class="delete-data">Etes-vous sur? 
                                                                <button class="ajax_delete_critere_ponderation_yes btn btn-xs btn-success mgR10" data-idu="'.$mPonderation->id.'" data-id="'.$mCrit->idcriteres.'" >Oui</button>
                                                                <button class="ajax_delete_critere_ponderation_no btn btn-xs btn-danger" data-id="'.$mCrit->id.'">Non</button>
                                                            </p> 
                                                        </li>
                                                    </ol>
                                                ';
                                            }
                                        }
                                        else echo'<div class="alert alert-warning">Aucun criteres affectes.</div>';
                                    ?>
                                </div>
                            </div>                            
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //AJAX Recharger la liste des employes
    function refreshCriteres ()
    {
        $('#ponderationCritereLoading').children('.ibox-content').toggleClass('sk-loading'); 
        var val= $("#idponderation").val();
        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsCriteres.php',
            dataType: 'html',
            data: "id=refresh_critere_ponderation&idu="+val,
            cache: false,
            success: function(html)
            {
                $("#ponderationCritereBox").html(html).fadeIn();
                $('#ponderationCritereLoading').children('.ibox-content').toggleClass('sk-loading'); 
            }
        });         
    }

    // Activation & Desactivation d'un employe
    $(document).on("click", "#ajaxAddPonderationCritere", function(e)
    {
        e.preventDefault();
        var idp= $("#idponderation").val();
        var sCritere= document.getElementById("idcritere");
        var idc= sCritere.options[sCritere.selectedIndex].value;
        var sPercent= document.getElementById("percent");
        var per= sPercent.options[sPercent.selectedIndex].value;
        var desc= $("#description").val();
        if(per!=""){
            $.ajax({
                type: "POST",
                url: root+'app/php_ajax/actionsCriteres.php',
                dataType: 'html',
                data: "id=ajouter_ponderation_critere&idu="+idp+"&idc="+idc+"&percent="+per+"&desc="+desc,
                cache: false,
                success: function(code)
                {
                    if(code=="YES"){
                        toastr.info('Operation effectuee avec success','Notification !');
                        $("#percent").val("");
                        $("#description").val("");
                    }
                    else if(code=="EXIST")
                    {
                        $("#percenterror").html('<div class="alert alert-danger">Ce profil de ponderation contient deja ce critere.</div>').fadeOut().fadeIn();
                    }
                    else if(code=="PERCENT")
                    {
                        $("#percenterror").html('<div class="alert alert-danger">La somme des critères pour les ponderations ne peut depasser les 100%.</div>').fadeOut().fadeIn();
                    }
                    else{
                       toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');    
                    } 
                    refreshCriteres ();
                }
            });
        }
        else $("#percenterror").html('<div class="alert alert-danger">Veuillez saisir une valeur de pourcentage du critere selectionne.</div>').fadeOut().fadeIn();
    });


    $(document).on("click", ".ajax_delete_critere_ponderation", function (e)
    {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

    $(document).on("click", ".ajax_delete_critere_ponderation_yes", function (e)
    {
        var idup = $(this).attr('data-idu');
        var idct = $(this).attr('data-id');
        // $("p."+id).hide();

        $.ajax({
            type: "POST",
            url: root+'app/php_ajax/actionsCriteres.php',
            dataType: 'html',
            data: "id=delete_critere_ponderation&idu="+idup+"&idc="+idct,
            cache: false,
            success: function(code)
                {
                    if(code=="YES")
                    toastr.info('Operation effectuee avec success','Notification !');
                    else 
                    toastr.error('Erreur d\'execution. Contactez votre administrateur','Notification !');
                    refreshCriteres();          
                }
            });

    });

    $(document).on("click", ".ajax_delete_critere_ponderation_no", function (e)
    {
        var id = $(this).attr('data-id');
        $("#delete"+id).slideToggle();
    });

</script>
