/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : Mei 2016
 =============================================================================================================== */

 $.fn.generate_height = function () {
  var maxHeight = -1;
  $(this).each(function () {
    $(this).children().each(function () {
      maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
    });

    $(this).children().each(function () {
      $(this).height(maxHeight);
    });
  })
}

function popupShow(){
  $(".popupShow").click(function(e) {
    e.preventDefault();
    var popupID = $(this).attr("href");
    $(".popup_container").hide();
    $(popupID).show();
  });
  $(".close_popup").on('click', function(e){
    e.stopPropagation();
      $(".popup_container").hide();
  });
  $(".bg_popup").on('click', function(e){
    e.stopPropagation();
      $(".popup_container").hide();
  });
}

