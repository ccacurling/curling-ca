//wpgmza_map
jQuery(document).ready(function($) { 


    if ( $(".wpgmza_map").length > 0 ){
        let html = "<div class='map-switcher'><p class='listview-button selected'>List View</p><p class='mapview-button'>Map View</p></div>";

        $(".wpgmza_sl_query_div").append(html);

        $(".listview-button").click(function(){
            if ( !$(this).hasClass('selected') ){
                
                $(this).addClass('selected');
                $('.mapview-button').removeClass('selected');

                //Hide the Map
                $('.wpgmza_map').removeClass("map-reveal");
                $('.wpgmza_marker_holder').show();
            }
        });

        $(".mapview-button").click(function(){
            if ( !$(this).hasClass('selected') ){
                
                $(this).addClass('selected');
                $('.listview-button').removeClass('selected');

                //Show the Map
                $('.wpgmza_marker_holder').hide();
                $('.wpgmza_map').addClass("map-reveal");
            }
        });

    }

});
