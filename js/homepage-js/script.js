/*========================================================
                        SERVICES
========================================================*/

$(function() {
    
    //animate on scroll
    new WOW().init();   
});

/*========================================================
                        TEAM
========================================================*/

$(function() {
   $("#team-members").owlCarousel({
       items: 3,
       autoplay: true,
       smartSpeed: 700,
       loop: true,
       autoplayHoverPause: true,
       responsive: {
           // breakpoint from 0 up
           0 : {
               items: 1
           },
           // breakpoint from 480 up
           480 : {
               items: 2
           },
           // breakpoint from 768 up
           768 : {
               items: 3
           }
       }
   });
});

/*========================================================
                        STATS
========================================================*/

$(function() {
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });
});