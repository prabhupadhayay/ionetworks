$(document).ready(function() {
    if ($.cookie('preloader')) {
        $('#loader-wrapper').hide();
        $('.wrapper').show();
    } else {
        $(window).on('load', function() {
            $('#loader-wrapper').fadeOut(1000);
        });
        $('.wrapper').show();
        $.cookie('preloader', true, {
            path: '/',
            expire: 1
        });
    }
});

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
//Match title height
function MatchHeight1() {
    $('.match').matchHeight({});
}
$(window).scroll(function() {
    var sticky = $('.header');
    var dropsticky = $('.innerpage');
    scroll = $(window).scrollTop();
    if (scroll >= 200) {
        sticky.addClass('header-fixed');
        dropsticky.addClass('classbody');
    } else {
        sticky.removeClass('header-fixed');
        dropsticky.removeClass('classbody');
    }
});

//Functions that run when all HTML is loaded
$(document).ready(function() {
    MatchHeight1();
});
$(document).resize(function() {
    MatchHeight1();
});

$(document).ready(function() {
    $('.searchclick').click(function() {
        $('.searchbar').show('slide', {
            direction: 'right'
        }, 500);
    });
    $('.closesearch').click(function() {
        $('.searchbar').hide('slide', {
            direction: 'right'
        }, 500);
    });
    $(".scrollbox, .faqs-list").mCustomScrollbar();
});

$('.lefthomeslider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.righthomeslider',
    swipe: false,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 3000
});

$('.righthomeslider').slick({
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.lefthomeslider',
    dots: true,
    autoplay: true,
    focusOnSelect: true,
    autoplaySpeed: 5000,
    speed: 3000
});


$('.empoweringind-slider').slick({
    arrows: false,
    dots: true,
    speed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover: false,
    fade: false,
        responsive: [{
            breakpoint: 600,
            settings: {
                dots:true,
                adaptiveHeight:true
            },
        }, ],
});

$('.headlineimgslider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.headlinetextslider',
    swipe: false,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 3000,
    pauseOnHover: false,
        responsive: [{
            breakpoint: 600,
            settings: {
                swipe:true,
            },
        }, ],
});

$('.headlinetextslider').slick({
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.headlineimgslider',
    dots: true,
    focusOnSelect: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 3000,
    pauseOnHover: false,
        responsive: [{
            breakpoint: 600,
            settings: {
                dots: false,
                adaptiveHeight:true
            },
        }, ],
});




$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    e.target
    e.relatedTarget
    $('.spectrum-slider, .inoutslider').slick('setPosition');
});
if ($(window).width() < 991) {
    $(window).scroll(function() {
        var homestickey = $('.homepage');
        scroll = $(window).scrollTop();
        if (scroll >= 200) {
            homestickey.addClass('classbody');
        } else {
            homestickey.removeClass('classbody');
        }
    });
}
var q = $(window).width();
if (q < 750) {
    $('.togglemenus').click(function() {
        $('.menuoutbox').toggleClass('slide');
        $('.mobilepatch').toggleClass('show');
        $('html').css({
            "overflow": "hidden"
        });
    });
    // $('.menuhover').click(function(event){
    //   $('.menuhover').not(this).removeClass('active')
    //   $('.menuhover').not(this).find('.dropmenu').slideUp(500);
    //   $(this).find('.dropmenu').slideToggle(500);
    //   $(this).toggleClass('active');
    //    event.stopPropagation();
    // })
    $('.mobilepatch').click(function(event) {
        $('.menuoutbox').removeClass('slide');
        $(this).removeClass('show');
        $('html').css({
            "overflow": "initial"
        });
    });
    $('.menuhover').on("click", function(event) {
        $('.menuhover').not(this).removeClass('active')
        $('.menuhover').not(this).find('.dropmenu').slideUp(500);
        $(this).find('.dropmenu').slideToggle(500);
        $(this).toggleClass('active');
        event.stopPropagation();
    });
    $('.dropmenu').on("click", function(event) {
        event.stopPropagation();
    });
    $(document).on("click", function(event) {
        $('.menuhover').not(this).removeClass('active')
        $('.menuhover').not(this).find('.dropmenu').slideUp(500);
    });
    $('.drophead').not(this).click(function() {
        $('.drophead').not(this).parent().find('ul').slideUp(500);
        $('.drophead').not(this).removeClass('active');
        $(this).parent().find('ul').slideToggle(500);
        $(this).toggleClass('active');
    });

}


var f = $(window).width();
if (f > 992){
    $('.peoplespeks-slider').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
    });
}

var l = $(window).width();
if (l > 605) {

    $('.supproductslider').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        }, {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            },
        }, ],
    });

    $('.inoutslider').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
    });

    $('.spectrum-slider').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
    });
}
var d = $(window).width();
if (d < 600) {

    $('.flip-items').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        adaptiveHeight:true
    });



    $('.inoutslider').not('.slick-initialized').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 1,
        slidesToScroll: 1,
        //autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
            rows:2,
            slidesPerRow: 1,
    });
}

var s = $(window).width();
if (s < 991) {


    $(function() {
        $('.peoplespeks-slider').not('.slick-initialized').slick({
            arrows: true,
            dots: false,
            speed: 3000,
            slidesToShow: 2,
            slidesToScroll: 1,
            //autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: false,
            fade: false,
            rows:2,
            slidesPerRow: 1,
            adaptiveHeight:true,
            responsive: [{
                breakpoint: 600,
                settings: {
                    rows:1,
                    slidesToShow: 1,
                },
            }, ],
        });
    });

    $('.blogshowbox').slick({
        arrows: true,
        dots: false,
        speed: 3000,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
        fade: false,
            responsive: [{
                breakpoint: 600,
                settings: {
                    
                },
            }, ],
    })

}