<?php 
 require_once 'modalBoxes.php';
 ?>
<script type="text/javascript" language="javascript">
	jQuery('#modal').css({width: jQuery(document.body).width(), height: jQuery(document.body).height()});

	$('#btnClose, .headline img').click(function()
	{
		$('.modalbox').slideUp();
		$('#modal').fadeOut();
		$('#modal .modcontent input').val('');
		$('#messageBox .modcontent p.text').html('');
		$('#messageBox .modcontent p.redirect').html('');
	});

</script>