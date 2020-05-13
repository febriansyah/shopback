/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : November 2016
 =============================================================================================================== */
$(document).ready(function() {
  popupShow();
  $(".trigger_dropdown").click(function(e){
    e.preventDefault();
    $(".dropdownMenu_expand").slideToggle();
  });

  $("#trigger_drop").click(function(e){
    e.preventDefault();
    $(".dropdownMenu_header").slideToggle();
  });
	
});


$(window).scroll(function(){
	if($(window).scrollTop()<=20){
		$('#mainHeader').removeClass('fixNav');
	}else{
		$('#mainHeader').addClass('fixNav');
	}
});
