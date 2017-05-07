<section>
    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Bienvenue </h2>
                <br/>
                <p><?=nl2br($datas['site']->accueil);?></p>

                <p>
                    <small>Si vous avez accédé à cette adresse par hasard,
                    <a href="javascript:gohome();"> cliquez ici</a></small>
                </p>

            </div>
            <div class="col-md-6" id="loginMainBox">
            <div class="clear50"></div>
                <div class="ibox-content">
               		<div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>

					<div id="result"></div>

                    <form class="m-t" role="form" id="login_form_submit"  method="POST">
                        <div class="form-group">
                            <input id="connectname" name="connectname" type="text" class="form-control" placeholder="Utilisateur" required>
                        </div>
                        <div class="form-group">
                            <input id="connectpass" name="connectpass" type="password" class="form-control" placeholder="Mot de passe" required>
                        </div>
                        </form>
                        <button id="connectbutton"  onclick="checkLogin()" class="btn btn-primary  block full-width m-b">Login</button>

                        <a href="#">
                            <small>Forgot password ?</small>
                        </a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Traitement de la connexion avec AJAX -->
<script type="text/javascript">

    function gohome(){
      if (typeof window.home == 'function'){ // The rest of the world
        window.home();
        document.location.href = "about:home";
      } else if (document.all) { // For IE
        window.location.href = "about:home";
      } else {
        document.location.href = "about:home";
      }
    }

    document.getElementById('connectpass').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            checkLogin();
        }
    });

    // Verification de la connexion
    function checkLogin(){
        var login= $('#connectname').val();
        var pass= $('#connectpass').val();

        //alert(""+login+" - "+pass);

        if(pass==""){
            $("#result").html("<div class='alert alert-warning'>Veuiller saisir votre mot de passe.</div>").fadeOut().fadeIn();
        }
        else if(login==""){
            $("#result").html("<div class='alert alert-warning'>Veuiller saisir votre identifiant.</div>").fadeOut().fadeIn();
        }
        else {
            $('#loginMainBox').children('.ibox-content').toggleClass('sk-loading');
            var d = $("#login_form_submit").serialize();
            var id = "user_login_form";

            $.ajax(
            {
                url: '<?php echo SITE;?>/app/php_ajax/general.php',
                type: 'POST',
                dataType: 'html',
                data: d+'&id='+id,
                success: function(res)
                {
                    if(res=="ADMIN"){
                        window.location = "<?php echo SITE;?>administrator/";
                    }else if(res=="USER"){
                        window.location = "<?php echo SITE;?>organizers/";
                    } else{
                            //$('#loginMainBox').children('.ibox-content').slideToggle();
                            $('#loginMainBox').children('.ibox-content').toggleClass('sk-loading');
                            $("#result").html("<div class='alert alert-danger'>"+res+"</div>").fadeOut().fadeIn();
                            $('#connectpass').val("");
                            // return false;
                        }

                    }
                });


        }
    }
</script>
