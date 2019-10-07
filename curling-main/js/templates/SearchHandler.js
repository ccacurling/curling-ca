jQuery(document).ready(function($) { 

    if ( $(".search-menu-link").length > 0 ){

        $(".search-menu-link").click(function(e){
            e.preventDefault();
            $(".search-bar").removeClass("hide");
            
            $(".search-menu").addClass("hide");

            $(".search-bar .orig").focus();
            
        });

        /*
        $(".search-bar .orig").blur(function(){
            $(".search-bar").addClass("hide");
            $(".search-menu").removeClass("hide");
        });*/

    } 

});