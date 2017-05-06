<!-- Header -->
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Organisateurs</h2>
        <small>Liste des organisateurs d'évènements disponibles dans le système.</small>
        <a href="<?php echo SITE;?>admin/employes/" class="btn btn-info btn-sm floatR">Profiles</a>
        <a href="<?php echo SITE;?>admin/employes/add/" class="btn btn-primary btn-sm floatR mgR20">Ajouter un organisateur</a>
    </div>
</div>
<div class="clear20"></div>

<div class="row animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Extension</th>
                        </tr>
                        </thead>
                            <tbody>
                             <?php
                                // var_dump($datas['employes']);die();
                                foreach ($datas['employes'] as $mUser) {
                                    echo '<tr class="gradeU odd" role="row">
                                            <td>'.$mUser->lastname.'</td>
                                            <td>'.$mUser->firstname.'</td>
                                            <td>'.strtoupper($mUser->sex).'</td>
                                            <td>'.$mUser->email.'</td>
                                            <td>'.$mUser->phone.'</td>
                                            <td>';
                                            if(isset($mUser->service)) echo $mUser->service->title;
                                            else echo '<span class="infored">Inconnu</span>';
                                            echo'</td>
                                            <td>'.$mUser->extension.'</td>
                                          </tr>';
                                }
                            ?>
                           
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service</th>
                            <th>Extension</th>
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
// DataTables for employes
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
            {extend: 'excel', title: 'HEC_Profiles_Orgsnisateur'},
            {extend: 'pdf', title: 'HEC_Profiles_Organisateur', orientation: 'landscape',pageSize: 'LEGAL'},
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