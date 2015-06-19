<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<?php ini_set('display_errors', 'On'); ?>

<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les duels de L'Obs</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link href="poll/template/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/tabletop.js"></script>
    <script type="text/javascript" src="js/handlebars-v3.0.3.js"></script>
    <script type="text/javascript" src="js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="js/jquery.viewport.mini.js"></script>
  </head>
  <body id="thebody">
    <div id="header">
      <div></div>
    </div>
    <div id="header_mobile">
      <div id="header_mobile_left"><img src="img/header_mob_left.png"></div>
      <div id="header_mobile_center"><img src="img/header_mob_center.png"></div>
      <div id="header_mobile_right"><img src="img/header_mob_right.png"></div>
    </div>   
    <div id="main">
      <div id="intro">
          <div id="container_title">
            <h1 id="title">Les duels</h1>
          </div>
          <div id="chapo">Chaque semaine, l’Obs raconte un duel au couteau<br />entre ceux que l’actu a opposés.</div>
          <div id="header_share">
            <a href="" onclick="return !window.open(this.href, '', 'width=500,height=500')" id="header_share_fb"><i class="fa fa-facebook fa-2x"></i></a>
            <a href="" onclick="return !window.open(this.href, '', 'width=500,height=500')" id="header_share_tw"><i class="fa fa-twitter fa-2x"></i></a>
            <a href="" onclick="return !window.open(this.href, '', 'width=500,height=500')" id="header_share_go"><i class="fa fa-google-plus fa-2x"></i></a>
            <a href="" onclick="return !window.open(this.href, '', 'width=500,height=500')" id="header_share_ln"><i class="fa fa-linkedin fa-2x"></i></a>                                 
          </div>  
      </div>
      <div id="intro_mobile">
          <img src="img/subheader_mobile.svg" alt="Les duels : chaque semaine, l’Obs raconte un duel au couteau entre ceux que l’actu a opposés.">
      </div>
      <div id="container_selector">
        <div id="selector_tip">Cliquez sur cette barre pour afficher tous les duels de l'Obs. <a id="close_tip">J'ai compris&nbsp;!</a></div>  
        <div id="selector" class="noselect">
          <script id="entry-template-1" type="text/x-handlebars-template">
          <div class="fight_choice transition_collapse_vertical publish_{{publie}}" id="fight_choice_{{id}}" >
              <div class="chevron_down chevron_left">
                <i class="fa fa-caret-down"></i>
              </div>
              <div class="fight_choice_img_adv1 fight_choice_img">
                <img class="grayscale" src="img/photos/{{id}}_adv1_menu.png" alt="{{adv1_titre}}" />
              </div>
              <div class="fight_choice_adv fight_choice_adv1">{{adv1_titre}}</div>
              <div class="fight_choice_separator"> vs </div>
              <div class="fight_choice_adv fight_choice_adv2">{{adv2_titre}}</div>
              <div class="fight_choice_img_adv2 fight_choice_img">
                <img class="grayscale" src="img/photos/{{id}}_adv2_menu.png" alt="{{adv12_titre}}" />
              </div>
              <div class="chevron_down chevron_right">
                <i class="fa fa-caret-down"></i>
              </div>                            
          </script>
        </div>
      </div>
      <div id="all_fights">  
        <script id="entry-template-2" type="text/x-handlebars-template">
        <div class="container_fight publish_{{publie}}" id="container_fight_{{id}}" >
          <div class="container_pictures">
            <div class="container_picture container_picture_adv1 transition_swipe">
              <img class="lazy" data-original="img/photos/{{id}}_adv1_main.jpg?v=3" width="500" height="500">
            </div>
            <div class="container_picture container_picture_adv2 transition_swipe">
              <img class="lazy" data-original="img/photos/{{id}}_adv2_main.jpg?v=3" width="500" height="500">
            </div>
          </div>  
          <div class="container_txt transition_padding container_txt_off">   
            <h2 class="subtitle subtitle_adv1">
                <div class="img_mobile_adv img_mobile_adv1 transition_scale" ><img src="img/photos/{{id}}_adv1_menu.png"></div>
                <div class="title_mobile title_mobile_adv1">{{adv1_titre}}.</div>{{adv1_sous_titre}}
            </h2>  
            <div class="versus_bullet_mobile">vs</div>            
            <h2 class="subtitle subtitle_adv2">
                <div class="title_mobile title_mobile.adv2">{{adv2_titre}}.</div>{{adv2_sous_titre}}
                <div class="img_mobile_adv img_mobile_adv2 transition_scale" ><img src="img/photos/{{id}}_adv2_menu.png"></div>                
            </h2>
            <div class="fight_share show_{{sondage_partage}}">
              <div>
                <div class="fight_share_adv1">
                  <a onclick="return !window.open(this.href, '', 'width=500,height=500')" href="" class="button_share tw_share tw_share_adv1">
                    <i class="fa fa-twitter fa-2x"></i>
                  </a>
                  <a onclick="return !window.open(this.href, '', 'width=500,height=500')" href="" class="button_share fb_share fb_share_adv1">
                    <i class="fa fa-facebook fa-2x"></i>
                  </a>
                </div>  
                <div class="fight_share_txt transition_opacity">
                  <div>
                    <i class="fa fa-angle-left fa-2x"></i>
                    <div class="fight_share_cta">Choisissez votre camp <br /> sur les réseaux sociaux !</div>
                    <i class="fa fa-angle-right fa-2x"></i>
                  </div>  
                </div>
                <div class="fight_share_adv2">
                  <a onclick="return !window.open(this.href, '', 'width=500,height=500')" href="" class="button_share fb_share fb_share_adv2">
                    <i class="fa fa-facebook fa-2x"></i>
                  </a>
                  <a onclick="return !window.open(this.href, '', 'width=500,height=500')" href="" class="button_share tw_share tw_share_adv2">
                    <i class="fa fa-twitter fa-2x"></i>
                  </a> 
                </div>           
              </div>
            </div>  
            <div class="round round1_adv1">
              <div class="round_name_adv round_name_adv1">Côté {{adv1_titre}}…</div>
              {{{adv1_round1_texte}}}
            </div>
            <div class="round round1_adv2">
              <div class="round_name_adv round_name_adv2">Côté {{adv2_titre}}…</div>
              {{{adv2_round1_texte}}}
            </div>
            <div class="round_stroke" id="round_stroke1"></div>
            <div class="round round2_adv1">
              <div class="round_name_adv round_name_adv1">Côté {{adv1_titre}}…</div>
              {{{adv1_round2_texte}}}
            </div>
            <div class="round round2_adv2">
              <div class="round_name_adv round_name_adv2">Côté {{adv2_titre}}…</div>
              {{{adv2_round2_texte}}}
            </div>
            <div class="round_stroke"></div>
            <div class="round round3_adv1">
              <div class="round_name_adv round_name_adv1">Côté {{adv1_titre}}…</div>
              {{{adv1_round3_texte}}}
            </div>
            <div class="round round3_adv2">
              <div class="round_name_adv round_name_adv2">Côté {{adv2_titre}}…</div>
              {{{adv2_round3_texte}}}
            </div> 
            <div class="verdict" id="verdict_fight_{{id}}">
              <div class="verdict_kicker">Le verdict de l’Obs</div>
              <div class="verdict_txt winner_img_{{vainqueur}}">
                <div class="verdict_img verdict_img_adv1" style="background-image: url(img/photos/{{id}}_adv1_menu.png)"></div>
                <div class="verdict_img verdict_img_adv2" style="background-image: url(img/photos/{{id}}_adv2_menu.png)"></div>
                {{{verdict}}}
                <p>Duel arbitré par&nbsp;: <a class="signature" href="{{url_signature}}" target="_parent">{{{signature}}}</a></p>
              </div>
            </div>
            <div class="show_{{sondage_partage}}">
              <div class="poll_kicker">A vous de choisir !</div>
              <div class="poll_box" id="poll_box_{{id}}"></div>
              
            </div>
            <div class="container_next_duel_pub">
              <div class="next_duel" >
                <div class="kicker_next_duel">
                  Ils s’affrontent aussi…
                </div>
                <div class="next_duel_names" id="next_duel_{{next_duel_id}}">
                  <div class="next_duel_adv next_duel_adv1">
                    <div class="next_duel_adv_img"><img src="img/photos/{{next_duel_id}}_adv1_menu.png" alt="{{next_duel_adv1}}" / ></div>
                    <div class="next_duel_adv_txt">{{next_duel_adv1}}</div> 
                  </div>  
                  <div class="next_duel_vs"><span>vs</span></div>
                  <div class="next_duel_adv next_duel_adv2">
                    <div class="next_duel_adv_img"><img src="img/photos/{{next_duel_id}}_adv2_menu.png" alt="{{next_duel_adv2}}" / ></div>
                    <div class="next_duel_adv_txt">{{next_duel_adv2}}</div>
                  </div>
                </div>
              </div>  
              <div class="pub">
               <div>
                <img src="img/ad_example.png">
               </div>
              </div> 
            </div>  
          </div>  
        </div> 
        </script>
      </div>  
    </div>
    <div id="footer">
      <div></div>      
    </div>  
    <script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
