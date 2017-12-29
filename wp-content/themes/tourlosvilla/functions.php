<?php
require_once ('admin/index.php');

if ( current_user_can( 'manage_options' ) ) {
    show_admin_bar( true );
}
get_template_part('framework/framework');

function x2_global_var() {
    global $x2postmeta, $BOOKONLINEURL;
    $x2postmeta = json_decode(json_encode(x2_get_page_meta()));
    $BOOKONLINEURL = getBookonlineLink_themeoptions();
}
add_action( 'wp_head', 'x2_global_var', 11 );

function inslinecss() {
    echo '
       <style type="text/css" media="screen">
           html {
            margin-top: 0px !important;
           }
           div#wpadminbar {
            top: auto;
            bottom: 0px;
            position: fixed;
            background: #222;
            background: rgba(0,0,0,0.5);
           }
       </style>
    ';
}
if ( is_admin_bar_showing() ) {
    add_action( 'wp_head', 'inslinecss', 11 );
}

function inslinecss_theme_icons() {
    $icons = get_static_icons();

    echo '
       <style type="text/css" media="screen">
    ';

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

    echo '
       </style>
    ';
}
//add_action( 'wp_head', 'inslinecss_theme_icons', 12 );

function setfavicon() {
    $icons = get_static_icons();
    $fav_img = get_stylesheet_directory_uri().'/images/icons/favicon.ico';

    if ( $icons['favicon'] != '' ) {
        $fav_img = $icons['favicon'];
    }

    $favicon = '<link rel="shortcut icon" href="'.$fav_img.'" />';
    echo $favicon;
}
add_action( 'wp_head', 'setfavicon', 14 );

function inslinecss_theme() {
    $themeFont = themeColorAndMoreOptions();
    if ( $themeFont['font'] != '' && $themeFont['status'] == 1 ) {
    $themeFont['font'] = str_replace("+", " ", $themeFont['font']);
    echo '
       <style type="text/css" media="screen">
           .fck, .title-big, .title-medium, .slogans a, .helpers--price-medium, .btns, ul.nav a, section.footer div.left a, div.left p {
            font-family: "'.$themeFont['font'].'","Open Sans",Arial !important;
           }
       </style>
    ';
    }
    if ( $themeFont['color'] != '' && $themeFont['status'] == 1 ) {
        echo '
       <style type="text/css" media="screen">
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


       </style>
    ';
    }
}
//add_action( 'wp_head', 'inslinecss_theme', 13 );

function jsglobals() {
    $icons = get_googlemap_options();
    $pin = ($icons['pin'] != '' ? $icons['pin'] : get_stylesheet_directory_uri().'/images/icons/pin.png');
    $pin_lat = $icons['lat'];
    $pin_long = $icons['long'];
    $pin_zoom = ($icons['zoom']!='' ? intval($icons['zoom']) : 14);
    echo '
       <script>
        var directory_uri = "'.get_stylesheet_directory_uri().'";
        var pin_img = "'.$pin.'";
        var pin_lat = "'.$pin_lat.'";
        var pin_long = "'.$pin_long.'";
        var pin_zoom = '.$pin_zoom.';
       </script>
    ';
}
//add_action( 'wp_footer', 'jsglobals', 0 );
$weather_info = get_weather_info();
if ( isset( $_REQUEST['getweather'] ) && $weather_info['weather_id'] != '' ) {
    locate_template('/framework/libs/YahooWeather.class.php', true, true);
    $weather = new YahooWeather(24543964, 'c');
    $weather_tempature_c= floor($weather->getTemperature(false));
    $weather_tempature_f = floor($weather_tempature_c  *  9/5 + 32);
    echo $weather_tempature_c.'°C | '.$weather_tempature_f .'°F';
    die();
}

add_action( 'phpmailer_init', 'my_phpmailer', 10, 1  );
function my_phpmailer( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->SMTPDebug  = 0;
    $phpmailer->Debugoutput = 'html';
    $phpmailer->Host = 'mail.villamykonosaquapearl.gr';
    $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
    $phpmailer->Port = 25;
    $phpmailer->Username = 'noreply@villamykonosaquapearl.gr';
    $phpmailer->Password = '?^W?x%NKPXMbJd3Q';
}

if ( isset( $_REQUEST['sendmail'] ) ) {

    if ( ! wp_verify_nonce( $_POST['str'], 'thisismycontacthoho' ) ) {
        $ar['returnStatus'] = false;
        echo json_encode($ar);
        die();
    }
    $mails = get_forms_email();
    $to_ = 'kotsakis@x2interactive.gr';

    if ( $_POST['thisformtype'] == 'cf' ) {
    $mform .= '&nbsp;&nbsp;<table cellpadding="6" cellspacing="1" border="1" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">';
    $mform .= "<tr><td>Name</td><td>" . $_POST['name'] ."</td></tr>";
    $mform .= "<tr><td>Surname</td><td>" . $_POST['surname'] ."</td></tr>";
    $mform .= "<tr><td>Email</td><td>" . $_POST['email'] ."</td></tr>";

    $mform .= "<tr><td>Country</td><td>" . $_POST['country'] ."</td></tr>";
    $mform .= "<tr><td>Telephone</td><td>" . $_POST['telephone'] ."</td></tr>";
    $mform .= "<tr><td>Fax</td><td>" . $_POST['fax'] ."</td></tr>";

    $mform .= "<tr><td>Purpose of contact</td><td>" . $_POST['msg'] ."</td></tr>";
    $mform .= '</table>';

        if ( $mails['contactform'] !='' ) {
            $to_ = $mails['contactform'];
        }

    }

    if ( $_POST['thisformtype'] == 'bf' ) {
    $mform .= '&nbsp;&nbsp;<table cellpadding="6" cellspacing="1" border="1" style="font-family:Arial, Helvetica, sans-serif; font-size:12px">';
    $mform .= "<tr><td>Name</td><td>" . $_POST['name'] ."</td></tr>";
    $mform .= "<tr><td>Surname</td><td>" . $_POST['surname'] ."</td></tr>";
    $mform .= "<tr><td>Email</td><td>" . $_POST['email'] ."</td></tr>";
    $mform .= "<tr><td>Telephone</td><td>" . $_POST['telephone'] ."</td></tr>";

    $mform .= "<tr><td>Arrival Date</td><td>" . $_POST['arrivaldate'] ."</td></tr>";
    $mform .= "<tr><td>Departure Date</td><td>" . $_POST['departuredate'] ."</td></tr>";
    $mform .= "<tr><td>Adults</td><td>" . $_POST['adults'] ."</td></tr>";
    $mform .= "<tr><td>Kids</td><td>" . $_POST['kids'] ."</td></tr>";

    $mform .= "<tr><td>Extra information</td><td>" . $_POST['msg'] ."</td></tr>";
    $mform .= '</table>';

        if ( $mails['bookingform'] !='' ) {
            $to_ = $mails['bookingform'];
        }

    }

    $fromname = $_POST['name'] .' '. $_POST['surname'];
    $subject = 'Contact form ' . $_SERVER['HTTP_HOST'];
    $headers = 'From: '.$fromname.' <'.$_POST['email'].'>' . "\r\n";
    $message = nl2br($mform);
    //$to = 'kotsakis@x2interactive.gr';
    $to = $to_;
    $fromemail = $_POST['email'];


    add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
    $ar['returnStatus'] = wp_mail($to, $subject, $message, $headers);
    
    if ( $ar['returnStatus'] == false ) {
        remove_action( 'phpmailer_init', 'my_phpmailer', 10, 1  );
        $ar['returnStatus'] = wp_mail($to, $subject, $message, $headers);
    }
    
    echo json_encode($ar);
    die();
}

// custom admin login logo
function custom_login_logo() {
	echo '<style type="text/css">
	.login h1 a {
            background-image: url('.get_bloginfo('template_directory').'/images/x2logo.png) !important;
            background-size: 130px 130px;
            width: 130px;
            height: 130px;
        }
	</style>';
}
add_action('login_head', 'custom_login_logo');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/css/admin.css" type="text/css" media="all" />';
}

add_action( 'wp', 'my_404' );
function my_404()  {
    if ( is_404() )
    {
        header("Status: 404 Not Found");
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
}

function meta_hreflang_attr() {
    //$url = site_url();
	$url = 'http://www.hotel28santorini.com';
  $hreflang = '
  <link rel="alternate" href="'.$url.'" hreflang="en" />
  ';

  $hreflang .= '<link rel="alternate" href="'.$url.'" hreflang="x-default" />
  ';

  if ( is_home() || is_front_page() ) {
    echo $hreflang;
  }
}
add_action('wp_head', 'meta_hreflang_attr', 100);

remove_action('wp_head', 'wp_generator');


function googleanalytics() {
    if (!is_admin()) {

$new = "


        ";

echo $new;
    }
}
add_action( 'wp_head', 'googleanalytics', 200 );
