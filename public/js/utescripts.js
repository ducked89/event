// Redirection sur demande
var root=document.getElementById("site").value;
var number =1;
var url = "";
var mess = "";

var executerApres = (function(){
  var timer = 0;
  return function(callback, ms){
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();


var validation = {
    isEmailAddress:function(str) {
        var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return pattern.test(str);  // returns a boolean
    },
    isNotEmpty:function (str) {
        var pattern =/\S+/;
        return pattern.test(str);  // returns a boolean
    },
    isNumber:function(str) {
        var pattern = /^\d+$/;
        return pattern.test(str);  // returns a boolean
    },    isSame:function(str1,str2){
        return str1 === str2;
    }
};   


function redirection(num, link) {
	setParams(num, link);
	countdown();
}

function countdown() {
	if(number>0){
		// alert('ngcgcghc');
		setTimeout(countdown, 1000);
		$('#messageBox p.redirect').html("Redirection dans " + number + " secondes.");
		$('#modal').show();
		$('#messageBox').show();
		number--;
	}
	else { 	window.location = url;	}
}


function valideDateSuperAll(j, m, a){
	var today = new Date();

	// Annee inferieure ou egale
	if(today.getFullYear()<=a)
	{
		if(today.getFullYear()==a)
		{
			if(today.getMonth()<=m)
			{
				if(today.getMonth()==m)
				{
					if(today.getDay()<j)
					return true;
					else
					return false;
				}
			}
			else
			return false;

		}
		return true;
	}
	else
	return false;
}

function checkEmail(em){
	var atpos = em.indexOf("@");
	var atdot = em.lastIndexOf(".");
	verify = false;

	if(em!="" && atpos>2 && atdot>atpos+2 && atdot+2<=em.length)
	{   verify = true;  }
    else{ verify = false; }
    return verify;
}

function checkNumber(em){
	return true;
}


 $(document).on("change", ".noteCritere", function (e)
{
	e.preventDefault();
	var ids = $(this).attr("data-id");
	var select = document.getElementById("noteCritere"+ids);
	var idm= select.options[select.selectedIndex].value;
	if(idm==""){$("#noteDetail"+ids).html("<span class='label label-danger'>Veuillez selectionner une note valide !</span>").fadeOut().fadeIn();}
	else{
	    $.ajax({
	        type: "POST",
	        url: root+'app/php_ajax/actionsCriteres.php',
	        dataType: 'html',
	        data: "id=ajax_detail_mention&idu="+idm,
	        cache: false,
	        success: function(code)
	        {                        
	        	$("#noteDetail"+ids).html(code).fadeOut().fadeIn();
	        }
	    });
	}
});


// Activation & Desactivation d'un critere
$(document).on("click", ".toolTipJs", function(e)
{
    e.preventDefault();
    var id = $(this).attr('data-id');
    $("#"+id).fadeOut().fadeIn();

});

$(".select2_demo_1").select2();


