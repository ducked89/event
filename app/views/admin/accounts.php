<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Utilisateurs</h2>
        <small>Liste des comptes utilisateurs du système. Cliquer sur le nom du compte pour plus de détails.</small>
            
            <a href="<?= SITE;?>admin/accounts/desactivate/">
           <button class="btn btn-sm btn-danger floatR" type="button"><i class="fa fa-ban"></i> 
           <span class="bold">Désactiver tous</span></button></a>

           <a href="<?= SITE;?>admin/accounts/activate/">
           <button type="button" class="btn btn-sm btn-info floatR mgR20"><i class="fa fa-check"></i> 
           <span class="bold">Activer tous</span></button></a>

           <a href="<?= SITE;?>admin/accounts/add/">
           <button type="button" class="btn btn-sm btn-success floatR mgR20"><i class="fa fa-plus "></i> 
           <span class="bold">Créer</span></button></a>

    </div>
</div>


 <div class="row row-bg animated fadeInRight">
    <div class="clear20"></div>
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th class="no-print">Options</th>
                        <th>Compte</th>
                        <th>Type</th>
                        <th>Date création</th>
                        <th>Dernière connexion</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                        <tbody>
                         <?php

                            $mUsers = (object)($datas['users']);
                            $mTypes = (object)($datas['types']);
                            foreach ($mUsers as $mUser) {
                                echo '<tr class="gradeU odd" role="row">
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="true">Action <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="'.SITE.'admin/employes/view/?idu='.$mUser->empid.'">Profil utilisateur</a></li>
                                                    <li><a href="'.SITE.'admin/accounts/edit/?idu='.$mUser->id.'">Editer compte</a></li>
                                                    <li><a href="'.SITE.'admin/accounts/password/?idu='.$mUser->id.'">Changer mot de passe</a></li>
                                                     <li>';

                                                    if($mUser->status==0) 
                                                        echo '<a href="'.SITE.'admin/accounts/enable/?idu='.$mUser->id.'">Activer</a></li>';
                                                    else echo '<a href="'.SITE.'admin/accounts/disable/?idu='.$mUser->id.'">Désactiver</a></li>';


                                                    echo '</li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Supprimer</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    <td class=""><a href="'.SITE.'admin/employes/view/?idu='.$mUser->empid.'">'.$mUser->login.'</a></td>
                                    <td class="sorting_1">';

                                    foreach ($mTypes as $mType) {
                                        if($mType->id==$mUser->roleid){
                                            echo $mType->description;
                                            break;
                                        }
                                        else echo '';
                                    }

                                echo '</td>
                                    <td class="">'.$mUser->datecreated.'</td>
                                    <td class="center">'.$mUser->lastattempts.'</td>
                                    <td class="center">';

                                    if($mUser->status == 0)echo '<span class="label label-danger">Inactif</span>';
                                    else echo '<span class="label label-info">Actif</span>';
                                    echo '</td>
                                    
                                </tr>';
                            }
                        ?>
                       
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Options</th>
                        <th>Compte</th>
                        <th>Type</th>
                        <th>Date création</th>
                        <th>Dernière connexion</th>
                        <th>Statut</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
// DataTables for Accounts
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        "oTableTools": {
            "aButtons": [
                {
                    "sExtends": "excel",
                    "sButtonText": "Special columns",
                    "mColumns": [ 2,3,4,5 ]
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Visible columns",
                    "mColumns": "visible"
                }
            ]
        },
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        },    
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'UTE_Comptes_Utilisateurs'},
            {extend: 'pdf', title: 'UTE_Profiles_Employes'},
            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]

    });

});
</script>