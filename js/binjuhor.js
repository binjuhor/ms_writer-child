/**
 * Js for btcmonday.com
 * @author Binjuhor - <binjuhor@gmail.com>
 * @version 1.0.0
 */
(function($){
    "use strict";
    $('.btc-search').click(function(){
        if (!$('#btc-mondaysearch').hasClass('active')) {
            return $('#btc-mondaysearch').addClass('active');
        }
        return $('#btc-mondaysearch').removeClass('active');
    });
    
    var nt_title = $('#hotnews_item').newsTicker({
        row_height: 30,
        max_rows: 1,
        duration: 10000,
        pauseOnHover: 0
    });
})(jQuery)