<div class="modal inmodal" id="myModalNote" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Mentions des notes</h4>
            </div>
            <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Note</th>
                                <th>Caption</th>
                                <th>Description</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php 
                            foreach ($datas['mentions'] as $mMention) {
                                echo '
                                <tr>
                                   <td class="mention-number ';
                                   if($mMention->level > 5)  echo 'text-navy'; else echo'text-warning'; 
                                   echo' ">  '.$mMention->level.'</td>
                                   <td><small>'.$mMention->title.'</small></td>
                                   <td><small>'.$mMention->description.'</small></td>
                               </tr>';

                           }
                           ?>
                       </tbody>
                   </table>
           </div>
    </div>
</div>
</div>