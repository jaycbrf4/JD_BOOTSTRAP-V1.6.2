
 (function($){   //Declare jQuery NameSpace

  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });

    $('a.nivo').nivoLightbox({effect: 'fade' });

  });

$(window).scroll(function(){
          if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
            } else {
            $('.scrollup').fadeOut();
        }
          }); 
            // function for scroll to top link to scroll to top
            $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
           });


            // header animation
            $(window).scroll(function(){
          if ($(this).scrollTop() > 200) {
            $('.navbar-fixed-top').addClass('scrolled');
            } else {
             $('.navbar-fixed-top').removeClass('scrolled');
        }
          }); 


})(jQuery); //Close jQuery

// init wow.js to trigger animations
new WOW().init();
