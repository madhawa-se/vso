<?php
header("Content-type: text/css; charset: UTF-8");
require_once('../../../../wp-load.php');
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header, $post;

$icons = get_static_icons(); 
if ( $icons['logo_desktop'] != '' ) { 
echo '
        .mainnavbar-wrp .container-navi div.logo {
            background-image: url("'.$icons['logo_desktop'].'");
        }
        ';
}
if ( $icons['logo_mobile'] != '' ) { 
echo '
        @media (max-width: 900px) {
            .mainnavbar-wrp .container-navi div.logo {
                background-image: url("'.$icons['logo_mobile'].'");
            }
        }
 ';
}

$themeFont = themeColorAndMoreOptions();
if ( $themeFont['font'] != '' && $themeFont['status'] == 1 ) {
$themeFont['font'] = str_replace("+", " ", $themeFont['font']);
echo '

       .fck, .title-big, .title-medium, .slogans a, .helpers--price-medium, .btns, ul.nav a, section.footer div.left a, div.left p {
       font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
       }
       
       body.galleryfullscreen #navigation ul.menu li.mainlist > a {
       font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
       }
       body.galleryfullscreen #navigation ul.menu li.mainlist div.galleries-wrp ul.galleries li a {
       font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
       }
       body.galleryfullscreen div#controls-wrapper div#controls div#slidecounter {
       font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
       }
       body.galleryfullscreen div#controls-wrapper div#controls div#slidecaption {
       font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
       }

';
}
if ( $themeFont['color'] != '' && $themeFont['status'] == 1 ) {
    echo '

       .mythemecolor-background-color {
            background-color: '.$themeFont['color'].' !important;
       }
       .mythemecolor-background-color:hover {
            background-color: '.$themeFont['hover'].' !important;
       }

       .light.mythemecolor-background-color {
            background-color: '.$themeFont['hover'].' !important;
       }
       .light.mythemecolor-background-color:hover {
            background-color: '.$themeFont['color'].' !important;
       }
       .mythemecolor {
            color: '.$themeFont['color'].' !important;
       }
       .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li.lang::before {
            border-left: thin solid '.$themeFont['color'].';
       }
       .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li ul.dropdown-menu li:hover > a {
            background-color: '.$themeFont['color'].';
       }
       .upbtn {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background: url("'.get_template_directory_uri().'/images/icons/pageup-nobg.png") no-repeat 0 0 '.$themeFont['color'].';
            background-size: 40px 40px;    
        }
        section.footer .content-wep .container .row .right .addthis-container .socialfooter li a:hover {
            color: '.$themeFont['color'].' !important;
        }

        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li.active a,
        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li.current-menu-parent a,
        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li a:hover,
        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li a:focus {
            color: '.$themeFont['menu-hoveractive'].';
        }

        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li.boldcategory:hover {
            background: '.$themeFont['bookonline-hover'].';
        }
        .mainnavbar-wrp .container-navi .navbar-collapse ul.nav > li.boldcategory a:hover {
            color: #ffffff;
        }

        .fck a {
            color: '.$themeFont['fck-link'].';
        }
        .fck a:hover {
            color: '.$themeFont['fck-link-hover'].';
        }

        section.footer .content-wep .container .row .right .addthis-container .weathercont {
            border-right: thin solid '.$themeFont['color'].'; 
        }
        
        .btns.blueBtn.light {
            background: '.$themeFont['buttons-light'].' !important; 
        }
        .btns.blueBtn.light:hover {
            background: '.$themeFont['buttons-light-hover'].' !important; 
        }
        


        body.galleryfullscreen #navigation div.close.close-btn-custom a.closebtn {
            background: '.$themeFont['color'].';
        }
        body.galleryfullscreen div#controls-wrapper div#controls a#play-button {
            border-right: 1px solid '.$themeFont['color'].';
        }
        body.galleryfullscreen div#controls-wrapper div#controls a#tray-button {
            border-left: 1px solid '.$themeFont['color'].'; 
        }
        body.galleryfullscreen div#controls-wrapper div#controls ul#slide-list li.current-slide a {
            background: '.$themeFont['color'].'; 
        }
        body.galleryfullscreen div#controls-wrapper div#controls a#play-button::before {
            color: '.$themeFont['color'].'; 
        }
        body.galleryfullscreen div#controls-wrapper div#controls a#tray-button::before {
            color: '.$themeFont['color'].';
        }
        

';
}