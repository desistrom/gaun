jQuery(document).ready(function($){
      // var navigasi = $('.header-bottom .nav').offset().top;
      //  var nav = $('.nav-container');

      // $(window).scroll(function () {
      //    if ($(this).scrollTop() > navigasi) {
      //       nav.addClass("f-nav");
      //    } else {
      //     nav.removeClass("f-nav");
      //   }
      // });
  // var nav = $('.navigation');

  //     $(window).scroll(function () {
  //        if ($(this).scrollTop() > 2) {
  //           nav.addClass("f-navigation");
  //        } else {
  //         nav.removeClass("f-navigation");
  //       }
  //     });
   $(".testimonial #owl-demo").owlCarousel({
 
           autoPlay: 5000, //Set AutoPlay to 3 seconds
 
            items : 3,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]
 
        });
      $(".logo-comp #owl-demo").owlCarousel({
 
           autoPlay: 2000, //Set AutoPlay to 3 seconds
 
            items : 6,
            itemsDesktop : [1199,6],
            itemsDesktopSmall : [979,6]
 
        });

// var stickyNavTop = $('#nav-con').offset().top;

//         var stickyNav = function(){

//           var scrollTop = $(window).scrollTop();

//           if (scrollTop > stickyNavTop) {

//             $('#nav-con').css({ 'position': 'fixed', 'top':0, 'z-index':9999 });

//           } else {

//             $('#nav-con').css({ 'position': 'relative' });

//           }

//         };

//         stickyNav();

//         $(window).scroll(function() {

//           stickyNav();

//         });


    //    wow = new WOW(
    //   {
    //     animateClass: 'animated',
    //     offset:       100,
    //     callback:     function(box) {
    //       console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
    //     }
    //   }
    // );
    // wow.init();
    //   {
    //   var section = document.createElement('section');
    //   section.className = 'wow fadeInDown';
    // };




 

});