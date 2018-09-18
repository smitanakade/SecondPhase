var mainPagePath = '/content/index.php';

var loginCheck = new StaffLogin(loginConfig);
loginCheck.checkIfLoggedIn(function (isLoggedIn) {
    if (isLoggedIn) {
        include('player/js/scriptLoader.js');
        ga('set', 'userId', loginCheck.getUserID());
    } else {
        redirect();
    }
});

function redirect() {
    document.location.href = '/index.html';
}

function startsWith(str, word) {
    return str.lastIndexOf(word, 0) === 0;
}
$(document).ready(function () {
    if (startsWith(window.location.pathname, mainPagePath)) {
        $(this).scroll(function () {
            var pagew = window.innerWidth;
            var sheight = $(window).scrollTop();
            if (sheight >= 300) {
                $('.logo-myeracademy2').css("opacity", "1");
                $('#menu').css("background", "rgba(255, 255, 255, 1)");
            } else {
                var menustatus = $('.menustatus').width();
                if(menustatus == 5)
                {
                    $('.logo-myeracademy2').css("opacity", "0");
                }
                $('#menu').css("background", "rgba(0, 0,0, 0)");
            }

            if (sheight >= 150) {
                if (pagew <= 640) {
                    $('.logo-myeracademy2').css("opacity", "1");
                    $('#menu').css("background", "rgba(255, 255, 255, 1)");
                }
            }
        });
    }
});

function include(filename) {
    var head = document.getElementsByTagName('head')[0];

    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';

    head.appendChild(script)
}

function logout() {
    loginCheck.logout();
    redirect();
}

function openmenu() {
    var menustatus = $('.menustatus').width();
    var mainmenuh = $('#mainmenu').height();
    var mainmenuh2 = 0 - mainmenuh - 110;
    $('.logo-myeracademy2').css("transform", "scale(1.00)");
    if (menustatus == 5) {
        $('#mainmenu').animate({
            marginTop: "0px"
        }, 800);
        $('.menustatus').css("width", "10");
        if (mainPagePath == window.location.pathname) {
            $('.logo-myeracademy2').css("opacity", "1");
        }
        $('#mainmenu').css("opacity", "1");
        $('html, body').css('overflowY', 'hidden');

    }

    if (menustatus == 10) {
        $('#mainmenu').animate({
            marginTop: mainmenuh2
        }, 600);
        $('.menustatus').css("width", "5");
        $('.logo-myeracademy2').css("transform", "scale(1.00)");
        $('html, body').css('overflowY', 'visible');
        if (mainPagePath == window.location.pathname) {
            $('.logo-myeracademy2').css("opacity", "0");
        }
    }
    resize();
}

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
    resize();
}

function resize() {
    var pageh = window.innerHeight;
    var pageh2 = pageh - 70;
    var pagew = window.innerWidth;
    var tilewrap = pagew * .66;

    if (pagew >= 1600) {
        pagew = 1600;
    }
    if (pagew >= 768) {
        tilewrap = pagew * .5;
    }

    var menuh = $('#mainmenuinner').height();
    var menuh2 = menuh + 105;
    $('#mainmenu').css("height", menuh2);

    if (pageh <= menuh2) {
        var pageh4 = window.innerHeight - 105;
        $('.scrollheight2').css("height", pageh4);
    } else {
        $('.scrollheight2').css("height", menuh);
    }

    $('.iframeh').css("height", pageh2);
    $('.tilewrap').css("height", tilewrap);

    var menustatus = $('.menustatus').width();

    if (menustatus == 5) {
        var mainmenuh = $('#mainmenu').height();
        var mainmenuh2 = 0 - mainmenuh - 110;
        $('#mainmenu').animate({
            marginTop: mainmenuh2
        }, 0);
    }

}

function menuInit() {
    var mainmenuh = $('#mainmenu').height();
    var mainmenuh2 = 0 - mainmenuh - 110;
    $('#mainmenu').css("margin-top", mainmenuh2);
    $('.menustatus').css("width", "5");
    if (mainPagePath != window.location.pathname) {
        $('.logo-myeracademy2').css("opacity", "1");
    }

};

window.onresize = function (e) {
    if (window.jQuery) {
        resize();
    }
}

var initInterval;
window.onload = function () {
    initInterval = setInterval(function () {
        if (window.jQuery) {
            menuInit();
            clearInterval(initInterval);
        }
    }, 100)
}