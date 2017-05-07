<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-sm-12">
       <h2>Evènements</h2>
       <a href="<?= SITE;?>administrator/events/desactivate/">
       <button class="btn btn-sm btn-danger floatR" type="button"><i class="fa fa-ban"></i>
       <span class="bold">Désactiver tous</span></button></a>

       <a href="<?= SITE;?>administrator/events/activate/">
       <button type="button" class="btn btn-sm btn-info floatR mgR20"><i class="fa fa-check"></i>
       <span class="bold">Activer tous</span></button></a>

       <a href="<?= SITE;?>administrator/events/grid/">
       <button type="button" class="btn btn-sm btn-valid floatR mgR20"><i class="fa fa-th-large"></i>
       <span class="bold">Mode Grille</span></button></a>

       <a href="<?= SITE;?>administrator/events/add/">
       <button type="button" class="btn btn-sm btn-success floatR mgR20"><i class="fa fa-plus "></i>
       <span class="bold">Créer</span></button></a>


       <form action="<?=SITE;?>administrator/events/">
           <div class="col-md-6">
               <div class="form-group">
                   <label class="col-sm-2 control-label mgR10">Periode (mois/annee)</label>
                   <div class="col-sm-8">
                       <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-2" name="mois">
                           <option value="1" >Janvier</option>
                           <option value="2">Fevrier</option>
                           <option value="3">Mars</option>
                           <option value="4">Avril</option>
                           <option value="5">Mai</option>
                           <option value="6">Juin</option>
                           <option value="7">Juillet</option>
                           <option value="8">Aout</option>
                           <option value="9">Septembre</option>
                           <option value="10">Octobre<option>
                           <option value="11">Novembre</option>
                           <option value="12">Decembre</option>
                       </select></div>

                       <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-2 pull-right" name="annee">
                           <?php
                           for($i=2017; $i<=2030; $i++)
                           {
                               echo'<option value="'.$i.'">'.$i.'</option>';
                           }

                           ?>
                        </select></div>
                       <div class="clear20"></div>
                       <div class="col-sm-5"><button type="submit" class="btn btn-valid" >Valider</button></div>
                   </div>
           </div>
           </div>
       </form>
   </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
       <div class="col-lg-12">
       <div class="ibox float-e-margins">
           <div class="ibox-content">

               <div class="table-responsive">
                   <table class="table table-striped table-bordered table-hover dataTables-example" >
                   <thead>
                   <tr>
                       <th class="no-print">Options</th>
                       <th>Titre</th>
                       <th>Organisateur</th>
                       <th>Adresse</th>
                       <!-- <th>Pondération</th> -->
                       <th>Période</th>
                       <th>Création</th>
                       <th>Etat</th>
                       <th>Echéance</th>
                       <th>Statut</th>
                   </tr>
                   </thead>
                       <tbody>
                        <?php

                           $mEvaluations =(isset($datas['evaluations'])? (object)($datas['evaluations']): array());

                           if(count($mEvaluations)>0){
                               foreach ($mEvaluations as $mEvaluation) {
                                   echo '<tr class="gradeU odd" role="row">
                                           <td>
                                               <div class="btn-group">
                                                   <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="true">Action <span class="caret"></span></button>
                                                   <ul class="dropdown-menu">
                                                       <li><a href="'.SITE.'administrator/events/view/?idu='.$mEvaluation->id.'">Dossier Evenement</a></li>
                                                       <li><a href="'.SITE.'administrator/events/edit/?idu='.$mEvaluation->id.'">Editer </a></li>
                                                       ';
                                                       if($mEvaluation->etat<2)
                                                       echo'<li><a href="'.SITE.'administrator/events/finalize/?idu='.$mEvaluation->id.'">Finaliser</a></li>';
                                                       else
                                                       echo'<li><a href="'.SITE.'administrator/events/open/?idu='.$mEvaluation->id.'">Ouvrir</a></li>';

                                                       echo '<li>';

                                                       if($mEvaluation->statut==0)
                                                           echo '<a href="'.SITE.'administrator/events/enable/?idu='.$mEvaluation->id.'">Activer</a></li>';
                                                       else echo '<a href="'.SITE.'administrator/events/disable/?idu='.$mEvaluation->id.'">Desactiver</a></li>';


                                                       echo '</li>
                                                       <li class="divider"></li>
                                                       <li><a href="#">Supprimer</a></li>
                                                   </ul>
                                               </div>
                                           </td>
                                       <td class=""><a href="'.SITE.'administrator/events/view/?idu='.$mEvaluation->id.'">'.$mEvaluation->alttitle.'</a></td>
                                       <td class="sorting_1">'.$mEvaluation->evalue->firstname.' '.strtoupper($mEvaluation->evalue->lastname).'</td>
                                        <td class="sorting_1">'.$mEvaluation->evaluateur->firstname.' '.strtoupper($mEvaluation->evaluateur->lastname).'</td>
                                       <td class="">'.$mEvaluation->nomMois.'/'.$mEvaluation->annee.'</td>
                                       <td class="">'.date_format(date_create($mEvaluation->datecreated), "d M Y").'</td>
                                       <td class="center">';

                                       if($mEvaluation->etat == 1)echo '<span class="label label-warning">En cours</span>';
                                       elseif($mEvaluation->etat == 2)echo '<span class="label label-valid">Finale</span>';
                                       else echo '<span class="label label-white">En Attente</span>';

                                       echo '</td></td>
                                       <td class=""><span class="';

                                       if($mEvaluation->datediff<=0) echo 'inforedlarge';

                                       echo'">'.date_format(date_create($mEvaluation->targetdate), "d M Y").'</sapn></td>
                                       <td class="center">';

                                       if($mEvaluation->statut == 0)echo '<span class="label label-danger">Inactif</span>';
                                       else echo '<span class="label label-info">Actif</span>';
                                       echo '</td>

                                   </tr>';
                               }
                           }
                           else
                               echo '    <tr> <td colspan="10"><div class="row"> <div class="col-lg-12">
                           <div class="alert alert-warning">Aucun évènement trouvé.</div>
                       </div></td></tr>';
                       ?>

                   </tbody>
                   <tfoot>
                   <tr>
                       <th class="no-print">Options</th>
                       <th>Titre</th>
                       <th>Organisateur</th>
                       <th>Adresse</th>
                       <!-- <th>Pondération</th> -->
                       <th>Période</th>
                       <th>Création</th>
                       <th>Etat</th>
                       <th>Echéance</th>
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
           {extend: 'excel', title: 'HEC_Ev&egrave;nement_Organisateur'},
           {extend: 'pdf', title: 'HEC_Ev&egrave;nement_Organisateur'},
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
