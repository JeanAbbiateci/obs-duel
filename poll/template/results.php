<?php

	/*
	 * You may customize this page with your own results message. 
	 */

?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Résutlats du vote</title>
<link href="poll/template/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container_results">
	<div class="results_poll">
		<?php the_current_poll_results(); ?>
		<!-- <a class="go_back" href="<?php the_return_to_url(); ?>">Retour</a>-->
		<?php the_credits(); ?>
	</div>	
</div>
<div class="newsletter">
                <div>
                <form action="" name="" class="" target="_blank">
                  <label for="subscribe_e-mail">Pour ne pas rater le prochain duel, inscrivez-vous<br /> à la newsletter <strong>L’actu</strong> de L’Obs !</label>
                  <div class="container_input">
                    <input type="email" value="Tapez votre e-mail" name="" class="input_email">
                    <input type="submit" value="OK" name="" id="" class="button">
                  </div>  
                </div>
              </div>
<script type="text/javascript">    
    //* Vide la case du formulaire au click
    $(".input_email").click( function() {
       $(this).val("");
    });
</script>    
</body>
</html>