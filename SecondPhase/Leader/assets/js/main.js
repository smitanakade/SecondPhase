
var loginCheck = new StaffLogin(loginConfig);
loginCheck.checkIfLoggedIn(function (isLoggedIn) {
    if (isLoggedIn) {
        include('adapt/js/scriptLoader.js');
        ga('set', 'userId', loginCheck.getUserID());
    } else {
        redirect();
    }
});

function redirect() {
    document.location.href = '/index.html';
}

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
    

    if (menustatus == 5) {
        $('#mainmenu').animate({marginTop: "0px"}, 800);
        $('.menustatus').css("width", "10");
        $('#mainmenu').css("opacity", "1");
    }

    if (menustatus == 10) {
        $('#mainmenu').animate({marginTop: mainmenuh2}, 600);
        $('.menustatus').css("width", "5");
    }
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
    }
    else {
        $('.scrollheight2').css("height", menuh);
    }

    $('.iframeh').css("height", pageh2);
    $('.tilewrap').css("height", tilewrap);

    var menustatus = $('.menustatus').width();

    if (menustatus == 5) {
        var mainmenuh = $('#mainmenu').height();
        var mainmenuh2 = 0 - mainmenuh - 110;
        $('#mainmenu').animate({marginTop: mainmenuh2}, 0);
    }

}

function menuInit() {
    var mainmenuh = $('#mainmenu').height();
    var mainmenuh2 = 0 - mainmenuh - 110;
    $('#mainmenu').css("margin-top", mainmenuh2);
    $('.menustatus').css("width", "5");
};

window.onresize = function (e) {
    if(window.jQuery){
        resize();
    }
}

var initInterval;
window.onload = function () {
    initInterval = setInterval(function(){
        if(window.jQuery){
            menuInit();
            clearInterval(initInterval);
        }
    }, 100)
}