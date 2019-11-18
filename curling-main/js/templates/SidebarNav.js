jQuery(document).ready(function($) {
    $(".trigger-subnav-links").click(function() {

        console.log("Trigger Subnavs"); 

        if ( $(".sidebar-list.sidebar-collapsed").length > 0 ) {
            $(".sidebar-list.sidebar-collapsed").each(function(){
                $(this).removeClass("sidebar-collapsed");
                $(this).addClass("sidebar-expanded");
            });
        } else if ( $(".sidebar-list.sidebar-expanded").length > 0 ) {
            $(".sidebar-list.sidebar-expanded").each(function(){
                $(this).removeClass("sidebar-expanded");
                $(this).addClass("sidebar-collapsed");
            });
        }


    });
});