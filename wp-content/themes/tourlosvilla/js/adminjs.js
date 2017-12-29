(function() {
    
    $(window).load(function() {
        if ( $("#wpadminbar").length > 0 ) {
            var adminbar = $('#wpadminbar');
            adminbar.find('ul#wp-admin-bar-root-default').append('<li id="" class="hover"><a class="ab-item x2hidebar" href="#">Hide</a></li>');
            //$('a.x2hidebar').on('click', function(e){
            $('a.x2hidebar').click(function(e){
                e.preventDefault();
                adminbar.remove();
            });
        }
    }); 
    
})();