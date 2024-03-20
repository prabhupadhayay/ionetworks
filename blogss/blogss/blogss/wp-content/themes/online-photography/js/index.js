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
$(document).ready(function() {
    $('.searchclick').click(function() {
        $('.searchbar').show('slide', {
            direction: 'down'
        }, 500);
    });
    $('.closesearch').click(function() {
        $('.searchbar').hide('slide', {
            direction: 'down'
        }, 500);
    });
    $(".scrollbox, .faqs-list").mCustomScrollbar();
});
$(document).ready(function(){
  $('.popularblog-slider').slick({
    arrows:true,
    dots:true,
    speed:2000,
    slidesToShow: 3,
    slidesToScroll: 3,
        //autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover:false,
        fade:false,
        responsive: [
        {
          breakpoint: 769,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        ]
      });
})
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