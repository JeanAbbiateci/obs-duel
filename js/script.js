
/* Récupération des données de la Google Sheet avec Tabletop.js */

var public_spreadsheet_url = 'https://docs.google.com/spreadsheets/d/1dFWriXGI0hduAFC41Y-EL3-nLE-HC59COMkLdHGjKrY/pubhtml';

function init() {
    Tabletop.init( { key: public_spreadsheet_url,
                     callback: showInfo,
                     simpleSheet: true,
                     orderby: "id",
                     reverse: false } )
  	}

/* Récupération des paramètres de l'URL pour savoir quel duel afficher en premier */

function getUrlVars() { 
      var vars = [],
          hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for (var i = 0; i < hashes.length; i++) {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }

/* Pour ajouter un paramètre à l'URL quand on sélectionne un duel */

function insertParam(key, value) {
        key = escape(key); value = escape(value);

        var kvp = document.location.search.substr(1).split('&');
        if (kvp == '') {
            window.history.pushState('', '', '?' + key + '=' + value);
        }
        else {

            var i = kvp.length; var x; while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) { kvp[kvp.length] = [key, value].join('='); }

            
           window.history.pushState('', '', kvp.join('&'));
        }
    }

/* Pour retirer un paramètre existant à l'URL quand on sélectionne un duel */

function removeParam(parameter) {
    var url=document.location.href;
    var urlparts= url.split('?');

    if (urlparts.length>=2) {
    var urlBase=urlparts.shift(); 
    var queryString=urlparts.join("?"); 

    var prefix = encodeURIComponent(parameter)+'=';
    var pars = queryString.split(/[&;]/g);
    for (var i= pars.length; i-->0;)               
        if (pars[i].lastIndexOf(prefix, 0)!==-1)   
            pars.splice(i, 1);
    url = urlBase+'?'+pars.join('&');
    window.history.pushState('',document.title,url); 
    }
}

/* Pour précharger les images des duels sélectionnables (= affichés dans le viewport) */

function preloadImages() {
    $(".fight_choice:in-viewport").each(function( index ) {
      var available_fight_id = $(this).attr('id').replace('fight_choice_','');
      $('#container_fight_' + available_fight_id + " img.lazy").each(function () {
        var img_src = $(this).attr('src');
        /* console.log('Image trouvée :' + img_src); */
        if ((typeof(img_src) == 'undefined') || (img_src == 'undefined') || (img_src == '')) { $(this).lazyload(); } 
      });
    });
}    

/* Pour définir les URL de partage des boutons Facebook et Twitter */

function setShareURL(id) {
    var current_url = window.location.href; 
    var current_adv1 = $('#fight_choice_' + id + " .fight_choice_adv1").text();
    var current_adv2 = $('#fight_choice_' + id + " .fight_choice_adv2").text();
    var fb_share_url_adv1 = "https://www.facebook.com/sharer/sharer.php?u=" + current_url;
    var tw_share_url_adv1 = "https://twitter.com/intent/tweet?via=lenouvelobs&text=" + "Pour moi, " + current_adv1 + " remporte le duel de l’Obs contre " + current_adv2 + "%20" + current_url;
    var fb_share_url_adv2 = "https://www.facebook.com/sharer/sharer.php?u=" + current_url;
    var tw_share_url_adv2 = "https://twitter.com/intent/tweet?via=lenouvelobs&text=" + "Pour moi, " + current_adv2 + " remporte le duel de l’Obs contre " + current_adv1 + "%20" + current_url;
    $('#container_fight_' + id + " .fb_share_adv1").attr("href", fb_share_url_adv1);
    $('#container_fight_' + id + " .tw_share_adv1").attr("href", tw_share_url_adv1);
    $('#container_fight_' + id + " .fb_share_adv2").attr("href", fb_share_url_adv2);
    $('#container_fight_' + id + " .tw_share_adv2").attr("href", tw_share_url_adv2);
} 

/* Pour afficher un des duels en fonction de son id */

function show_fight(id) {

  /* On charge les images du duel sélectionné */

  $('#container_fight_' + id + " img.lazy").lazyload();              
 
  /* On sort les images principales de l'écran et on fait descendre les deux colonnes de texte */

	$('.container_picture_adv1').removeClass('container_picture_adv1_active');
	$('.container_picture_adv2').removeClass('container_picture_adv2_active');
	$('.container_txt').addClass('container_txt_off');
  $('.container_submit').removeClass('container_submit_active');	
  $('.img_mobile_adv').removeClass('img_mobile_adv_active');

  /* On masque tous les duels puis on affiche le nouveau duel actif */

	setTimeout(function() { 
		$('.container_fight').removeClass('container_fight_active');
		$('#container_fight_' + id).addClass('container_fight_active');
	}, 300);

  /* On fait entrer les deux visuels, on fait remonter les deux colonnes de texte, on affiche le visuel sur la version mobile */

	setTimeout(function() { 	
		$('#container_fight_' + id + ' .container_picture_adv1').addClass('container_picture_adv1_active');
		$('#container_fight_' + id + ' .container_picture_adv2').addClass('container_picture_adv2_active');
		$('.container_txt').removeClass('container_txt_off');
    $('#container_fight_' + id + ' .img_mobile_adv').addClass('img_mobile_adv_active');
	 }, 325);
	
  /* On affiche le choix actif dans le menu déroulant et on le déplace en haut */

	$('.fight_choice').removeClass('fight_choice_active');
	$('#fight_choice_' + id).addClass('fight_choice_active');
	var new_top_choice = $('#fight_choice_' + id).detach();
  $('#selector').prepend(new_top_choice);


  /* On modifie l'URL en ajoutant le paramètre du duel actif */ 

    removeParam("duel");
    insertParam("duel",id);

  /* On charge le sondage correspondant au duel actif */

  $('#poll_box_' + id).load("pollbox.php?duel=" + id, function() {
      var $form = $('form');
      $form.submit(function(){
        console.log("A voté !");
        $.post($(this).attr('action'), $(this).serialize(), function(response){
            // do something here on success

        },'json');
        $('#poll_box_' + id).load("poll/results.php?pollid=" + id); 
        return false;
      });
      $('.currentResults a').click( function() {
          event.preventDefault();
          $('#poll_box_' + id).load("poll/results.php?pollid=" + id);
      });
      $('.answer label').click( function() {
        /*
          $('.answer label').removeClass('label_selected');
          $(this).addClass('label_selected');
          */
          if($('.container_submit').hasClass('container_submit_active')) { } else {
            $('.container_submit').addClass('container_submit_active');
          }  
      });
    });  

  /* On définit les URL de partage de tous les boutons Twitter et Facebook */   

    setShareURL(id);
}

function showInfo(data, tabletop) {

	 /* Ecriture de toutes les données du doc avec Handlebars.js */

		var source1 = $("#entry-template-1").html();
		var source2 = $("#entry-template-2").html();
		var template1 = Handlebars.compile(source1);
		var template2 = Handlebars.compile(source2);
		$.each( data, function(i, cat) {
		  var html1 = template1(cat);	
		  var html2 = template2(cat);
		  $('#selector').append(html1);
		  $('#all_fights').append(html2);
		});

    $('img.lazy').load(function() {
   /*  console.log($(this).attr('src') + ' loaded'); */
    });

		/* Si l'URL contient le paramètre duel, on ouvre le duel concerné, sinon on ouvre un duel choisi/le dernier publié */

        parameters = getUrlVars();
        var initial_fight = parameters['duel'];
        if (typeof(initial_fight) != 'undefined' && initial_fight != '' && initial_fight != 'undefined') { 
        	show_fight(initial_fight);
        } else {
            var last_published = $('#all_fights .container_fight:last-child').attr("id").replace("container_fight_","");
		    show_fight(last_published);
        }

		/* Au clic sur le menu, on affiche tous les duels disponibles, on masque l'infobulle, on change le caret */

		$('#selector').click( function() {
			$('.fight_choice').toggleClass('fight_choice_visible');
			$('#selector').toggleClass('selector_on');
      $('#selector_tip').hide('fast');
      $('.chevron_down i').toggleClass('fa-caret-down');
      $('.chevron_down i').toggleClass('fa-caret-up');

      /* On charge les images des duel sélectionnables */

      preloadImages(); 

    });  

    /* Au scroll dans le menu déroulant, on charge les images des duels sélectionnables */

    $(window).scroll(function() {
           if ($('#selector').hasClass('selector_on')) { preloadImages() };
    });

    /* Au clic sur le texte de fermeture de l'infobulle, on la ferme */

    $('#close_tip').click( function() {

      $('#selector_tip').hide('fast');
    });

		/* Au clic sur un des choix du menu, on change le duel affiché */
		
		$('.fight_choice').click( function() {
			var identifier = $(this).attr("id").replace("fight_choice_","");
			if ($(this).hasClass("fight_choice_active")) { } else { show_fight(identifier);  }
		});

		/* Au clic sur le duel suivant, on le charge et on remonte en haut de la page tranquillou */

    $('.next_duel_names').click( function() {
      var next_fight = $(this).attr('id').replace('next_duel_','');
      show_fight(next_fight); 
      setTimeout(function() {   
        $("html, body").animate({ scrollTop: 0 }, "slow");
      }, 100);  
    });


		/* On affiche l'incitation au partage lorsque l'utilisateur a commencé à scroller dans la page */

		$(window).scroll( function(){
			var scrollY = window.pageYOffset;
			if(scrollY < 400) {
	  			$('.fight_share').removeClass('fight_share_visible');
				} else {
				$('.fight_share').addClass('fight_share_visible');
				}
		});	
	}

$(document).ready( function() {

  /* On définir les URL des boutons de partage en haut de page */

  var main_url = window.location.href.split('?')[0];
  var fb_share_main_url = "https://www.facebook.com/sharer/sharer.php?u=" + main_url;
  var tw_share_main_url = "https://twitter.com/intent/tweet?via=lenouvelobs&text=" + "Les duels de l’Obs : chaque semaine, le récit d'un combat entre ceux que l’actu a opposés" + "%20" + main_url;
  var go_share_main_url = "https://plus.google.com/share?url=" + main_url;
  var ln_share_main_url = "https://www.linkedin.com/shareArticle?mini=true&url=" + main_url;

  $('#header_share_fb').attr('href', fb_share_main_url);
  $('#header_share_tw').attr('href', tw_share_main_url);
  $('#header_share_go').attr('href', go_share_main_url);
  $('#header_share_ln').attr('href', ln_share_main_url);

  /* On charge les données du Google doc et on affiche un premier duel */

  init();

}); 

