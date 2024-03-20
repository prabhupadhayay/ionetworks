$(document).ready(function(){                         
  if ($.cookie('preloader')) {         
      $('#loader-wrapper').hide();         
      $('.wrapper').show();         
  } 
  else 
  {         
     $(window).on('load', function () {   
         $('#loader-wrapper').fadeOut(1000);                           
      });       
      $('.wrapper').show();
      $.cookie('preloader', true, {         
          path: '/',         
          expire: 1         
      });         
   }                                                                           
});  

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

//Match title height
function MatchHeight1() {
  $('.match')
    .matchHeight({})
  ;
}

$(window).scroll(function(){
  var sticky = $('.header');
  var dropsticky = $('.innerpage');
  scroll = $(window).scrollTop();    
  if (scroll >= 200) {
    sticky.addClass('header-fixed');
    dropsticky.addClass('classbody');
  }else{
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


$(document).ready(
    function(){
        $('.searchclick').click(
            function(){
                $('.searchbar').show('slide',{direction:'right'},500);

            });
        $('.closesearch').click(
            function(){
                $('.searchbar').hide('slide',{direction:'right'},500);

            });

    $(".scrollbox, .faqs-list").mCustomScrollbar();
});





$('.lefthomeslider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.righthomeslider',
  swipe:false,
    autoplay: true,
    autoplaySpeed: 5000,
    speed:3000
});
$('.righthomeslider').slick({
  arrows:false,
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.lefthomeslider',
  dots: true,
    autoplay: true,
  focusOnSelect: true,
    autoplaySpeed: 5000,
    speed:3000
});

$('.supproductslider').slick({ 
    arrows:true,
    dots:false,
    speed:3000,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover:false,
    fade:false,
});

$('.empoweringind-slider').slick({ 
    arrows:false,
    dots:true,
    speed:3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover:false,
    fade:false,
});

$('.headlineimgslider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.headlinetextslider',
  swipe:false,
  autoplay: true,
    autoplaySpeed: 5000,
    speed:3000,
    pauseOnHover:false,
});
$('.headlinetextslider').slick({
  arrows:false,
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.headlineimgslider',
  dots: true,
  focusOnSelect: true,
  autoplay: true,
    autoplaySpeed: 5000,
    speed:3000,
    pauseOnHover:false,
});

$('.spectrum-slider').slick({ 
    arrows:true,
    dots:false,
    speed:3000,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover:false,
    fade:false,
});

$('.peoplespeks-slider').slick({ 
    arrows:true,
    dots:false,
    speed:3000,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover:false,
    fade:false,
});

$('.inoutslider').slick({ 
    arrows:true,
    dots:false,
    speed:3000,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    pauseOnHover:false,
    fade:false,
});


$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    e.target
    e.relatedTarget
    $('.spectrum-slider, .inoutslider').slick('setPosition');
});

