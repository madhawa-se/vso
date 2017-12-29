$(document).ready(function() {
    $('*[data-size="fullscreen"]').fullscreenconainer();
    $('.imgsslider').imgslider();
    $('.imgssliderBackground').imgssliderBackground();
    
    if (!isMobile.ismobile()) {
        var wow = new WOW({
          boxClass:     'wow',      // animated element css class (default is wow)
          animateClass: 'animated', // animation css class (default is animated)
          offset:       0,          // distance to the element when triggering the animation (default is 0)
          mobile:       false        // trigger animations on mobile devices (true is default)
        });
        wow.init();
    } 
    
    if ($('.shorttext-wrp').length > 0)
    $('.shorttext-wrp').maincontent_show_hide(); 
    
    $('.gallery-grid-container-holder').photoGalleryGrid();
    
    if ( $('.mainnavbar-wrp').length > 0 )
    $('.mainnavbar-wrp').mainmenuCss();
    
    if ( $(".fancybox").length > 0 ) {
    $(".fancybox").fancybox({
        helpers: { 
            title: null
        }
    });
    }
    
    //if ( isMobile.ismobile() ) {
        $('.hamburger-icon').mobileNavigation();
    //}
    
    $(".hotelIcons a").on('click', function(e){
        e.preventDefault();
    });
    
    if ( $('#contact_form').length > 0 ) {
        $('#contact_form').requestQuoteForm({
            hiddenfields : '#thisformtype'
        });
    }
    
    if ( $('#booking_form').length > 0 ) {
        $('#booking_form').requestQuoteForm({
            hiddenfields : '#thisformtype'
        });
    }
    
    
    //$('a.bookbtnredirect').on('click', function(e){
    //    var url = $(this).attr('href').replace(/&amp;/g,'&');
    //    $(this).attr('href','/?booking-button-redirect&url='+url);
    //});
    
    
    if ( $(".upbtn").length > 0 )
        $('.upbtn').backtotop();
    
    if ( $(".scrolldownbtn").length > 0 )
        $('.scrolldownbtn').scrolltopos();
    
    if ( $('form').length > 0 )
        $('form').x2datepicker();
    
    if($('.excol-action').length > 0)
        $('.excol-action').excol();
    
    if ( $('.badges-list li').length > 0 ) {
    $('.badges-list li')
    .mouseover(function(e) {
      var self = $(this);
      var img = self.find('img');
      img.attr('src',img.data('hover'));
    })
    .mouseout(function(e) {
      var self = $(this);
      var img = self.find('img');
      img.attr('src',img.data('img'));
    });
    }
    
});

$(window).load(function() {
    setTimeout(function(){
        $('.preloader-overlay').fadeOut(1500,function(){
            $('.logo-main-slide img').show().addClass('animated fadeInDown');
        });
    }, 200);
    
    if ( $(".gmapslide").length > 0 ) 
    $(".gmapslide").googleMap({
        'imgpin':pin_img,
        'map_lat':pin_lat,
        'map_long':pin_long,
        'zoom':pin_zoom
    });

    if ( $(".backtotop").length > 0 )
    $('.backtotop').backtotop();

    if ( $(".loadimage-cont").length > 0 )
    $('.loadimage-cont').setImg();

    if ( $(".weathercont").length > 0 ) {
        $.ajax({
            url: "?getweather",
            dataType: "html",
            type: "POST",
            cache: true
        }).done(function(e) {
            $('.weathercont-temp').html(e);
        });
    }
    
    
    
    $('body').prepend('<div id="fb-root"></div>');
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=187469201312992&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    var addthis_config = {"data_track_addressbar":true};
    var addthisScript = document.createElement('script');
    addthisScript.setAttribute('src', 'http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53ba91e263578730&domready=1');
    document.body.appendChild(addthisScript);
    
    
});