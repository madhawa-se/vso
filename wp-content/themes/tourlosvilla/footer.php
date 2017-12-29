     <script>
        var directory_uri = '<?php echo get_site_url(); ?>';
        var template_uri = '<?php echo get_template_directory_uri(); ?>';
    </script>
    <?php wp_footer(); ?>

    <?php
        if ( isset( $_REQUEST['booking-button-redirect'] ) ) {
            
              $link = $_REQUEST['url'];  
              $str = <<<EOF
    <script>
    window.location = '$link';                  
    </script>   
        
EOF;
              
echo $str;

        }
    ?>
    
<?php echo '</div>'; //http://schema.org/LocalBusiness ?>

  </body>
</html>