/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : November 2016
 =============================================================================================================== */
$(document).ready(function() {
	$('.bxslider').bxSlider({
		auto:true,
		pause:4000
	});
  if ($(window).width() < 767) {
   $('.sliderFlip').bxSlider({
      minSlides: 2,
      maxSlides: 2,
      autoControls: false
    });
  }
  

	var slider = $('.unggulanSLider').bxSlider({
		mode:'fade',
		auto:true,
		pause:4000,
    autoControls: true,
    stopAutoOnClick: true,
    });
    $('.next-bt').click(function(){
      slider.goToNextSlide();
      console.log('nextbt');
      return false;
    });

    $('.prev-bt').click(function(){
      slider.goToPrevSlide();
      console.log('prevbt');
      return false;
    });

	$('.trigger_card').click(function(){
		//var arParent = $(this).closest('article_card');
		//console.log(arParent);
	  	$(this).closest('.article_card').toggleClass('flipped');
	});
  $("#triggerVisit").click(function (e) { 
      e.stopPropagation(); 
      $(".popup_menu").toggle("slow");
  });
  $(document).click(function () { // you don't need the else part to fadeout
      var $el = $(".popup_menu");
      if ($el.is(":visible")) {
          $el.fadeOut(200);
      }
   });
	
});


$(window).scroll(function(){
	if($(window).scrollTop()<=20){
		$('#mainHeader').removeClass('fixNav');
	}else{
		$('#mainHeader').addClass('fixNav');
	}
});
