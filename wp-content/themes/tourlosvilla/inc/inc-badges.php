<?php
    $badges = getAllBadges();
    if (count($badges) > 0) {
?>
<section class="badges">
    
    <ul class="badges-list">
        <?php foreach( $badges as $badge ) { ?>
        <li>
            <?php if ( $badge->url != '' ) { ?>
            <a target="_blank" title="<?php echo $badge->seo_title; ?>" href="<?php echo $badge->url; ?>">
            <?php } ?>    
                <img alt="<?php echo $badge->seo_alt; ?>" data-img="<?php echo $badge->image[0]; ?>" data-hover="<?php echo $badge->image_hover[0]; ?>" src="<?php echo $badge->image[0]; ?>" />
            <?php if ( $badge->url != '' ) { ?>    
            </a>
            <?php } ?>  
        </li>
        <?php } ?>
        <?php /* ?>
        <li class="tripadvisor-reviews">
            <div class="tripadvisor-reviews-wrp">
                
                <div id="TA_cdsscrollingravenarrow218" class="TA_cdsscrollingravenarrow"><ul id="I3LZHyME9F" class="TA_links h5IJnjJ9fdx"><li id="vGjCizppFhH1" class="4hYn26k8IhM"><a target="_blank" href="http://www.tripadvisor.com/"><img src="http://static.tacdn.com/img2/t4b/Stacked_TA_logo.png" alt="TripAdvisor" class="widEXCIMG" id="CDSWIDEXCLOGO"/></a></li></ul></div><script src="http://www.jscache.com/wejs?wtype=cdsscrollingravenarrow&amp;uniq=218&amp;locationId=1774342&amp;lang=en_US&amp;border=false&amp;shadow=true&amp;backgroundColor=gray&amp;display_version=2"></script>
                
            </div>
        </li>
        <?php */ ?>
    </ul>
</section>
<?php } ?>