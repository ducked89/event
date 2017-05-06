<?php
$mdatas = (isset($datas['employes']))? get_object_vars($datas['employes'][0]) : null;
?>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-12">
      <h2>Profil</h2>
      <small>Affichage des informations générales sur mon profil.</small>
      <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/profile/view/">Voir mon profil</a>
  </div>
</div>
<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
      <div class="col-lg-offset-1 col-lg-10">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h3>Modifier mon profil</h3>
              </div>
              <div class="ibox-content">
                  <form class="form-horizontal" action="<?php echo SITE;?>members/profile/edit/" method="POST" >   
                      <div class="form-group"><label class="col-sm-2 control-label">Nom</label>
                          <div class="col-sm-10">
                             <input name="lastname" type="text" class="form-control" 
                             <?php if(isset($mdatas['lastname']) && !empty($mdatas['lastname'])) echo 'value="'.$mdatas['lastname'].'"';?>  />
                         </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                 
                      <div class="form-group"><label class="col-sm-2 control-label">Prénom</label>
                        <div class="col-sm-10">
                            <input name="firstname" type="text" class="form-control" 
                            <?php if(isset($mdatas['firstname']) && !empty($mdatas['firstname'])) echo 'value="'.$mdatas['firstname'].'"';?>  />
                        </div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                             <input name="email" type="text" class="form-control"  disabled="true"
                             <?php if(isset($mdatas['email']) && !empty($mdatas['email'])) echo 'value="'.$mdatas['email'].'"';?>  />
                         </div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <div class="form-group"><label class="col-sm-2 control-label">Téléphone</label>
                        <div class="col-sm-10">
                           <input name="phone" type="text" class="form-control" 
                           <?php if(isset($mdatas['phone']) && !empty($mdatas['phone'])) echo 'value="'.$mdatas['phone'].'"';?>  />
                       </div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <div class="form-group"><label class="col-sm-2 control-label">Adresse</label>
                        <div class="col-sm-10">
                           <input name="adresse" type="text" class="form-control" 
                           <?php if(isset($mdatas['adresse']) && !empty($mdatas['adresse'])) echo 'value="'.$mdatas['adresse'].'"';?>  /> 
                         </div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <div class="form-group">
                           <label class="col-sm-2 control-label">Extension</label>
                           <div class="col-sm-10">
                               <input name="extension" type="text" class="form-control" 
                              <?php if(isset($mdatas['extension']) && !empty($mdatas['extension'])) echo 'value="'.$mdatas['extension'].'"';?> />
                            </div>
                      </div>
                      <div class="hr-line-dashed"></div>

                      <div class="form-group">
                          <div class="col-sm-6 col-sm-offset-2">
                              <button class="btn btn-primary" name="modifyProfile" type="submit">Modifier</button>
                              <a class="btn btn-danger pull-right" href="<?php echo SITE;?>members/profile/">Annuler</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

</div>