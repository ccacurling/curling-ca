jQuery(document).ready(function($) { 

    if ( $("section.ctrs-container").length > 0 ){

        $(".ctrs-menu ").click(function(){
            if ( $(this).hasClass("selected") == false ){

                $(".ctrs-menu.selected").removeClass("selected");
                $(this).addClass("selected");

                if ( $(this).hasClass("ctrs-menu-standings") ) {
                    $(".ctrs-standings").removeClass("hide");
                    $(".ctrs-doubles").addClass("hide");
                    $(".ctrs-cup").addClass("hide");
                } else if ( $(this).hasClass("ctrs-menu-doubles") ) {
                    $(".ctrs-doubles").removeClass("hide");
                    $(".ctrs-standings").addClass("hide");
                    $(".ctrs-cup").addClass("hide");
                } else if ( $(this).hasClass("ctrs-menu-cup") ) {
                    $(".ctrs-cup").removeClass("hide");
                    $(".ctrs-standings").addClass("hide");
                    $(".ctrs-doubles").addClass("hide");
                }
            }
        });
    }

});
