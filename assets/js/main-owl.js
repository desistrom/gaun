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
   $(".client #owl-demo").owlCarousel({
 
           autoPlay: 2000, //Set AutoPlay to 3 seconds
 
            items : 8,
            itemsDesktop : [1199,6],
            itemsDesktopSmall : [979,4]
 
        });
      $(".testimonial #owl-demo").owlCarousel({
 
           autoPlay: 5000, //Set AutoPlay to 3 seconds
 
            items : 1,
            itemsDesktop : [1199,1],
            itemsDesktopSmall : [979,1],
             itemsTablet : [768, 1],
            itemsMobile : [479, 1]
 
        });
         $(".album-galery #owl-demo").owlCarousel({
            navigation:true,
           autoPlay: 2000, //Set AutoPlay to 3 seconds
 
            items : 3,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,2]
 
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