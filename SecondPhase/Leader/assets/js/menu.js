function initMenu() {
    $(".menu-child").slideToggle(); // hide all child menus

    $(".menu-container > div").each(function (index) {
        // add right arrow to containers
        $(this).html($(this).html() + '<i class="fa fa-chevron-right" aria-hidden="true"></i>');
    });

    $(".menu-container").click(function () {

        $(this).next(".menu-child").slideToggle(500);
        $child = $(this).children('div').first().children('i');
        $child.toggleClass("fa-chevron-right").toggleClass("fa-chevron-down");
        return false; // prevent scrolling
    });
}


function parseMenu(json)
{

    

}