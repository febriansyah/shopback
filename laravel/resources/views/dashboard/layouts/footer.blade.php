<!--Footer -->
<footer id="footer">

</footer>
@include('dashboard.layouts.javascript')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var emailInput =$("#email");
    var email_regex = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.(?:com|org|co.id|net|id))+$/;
    //var email_regex2 = /.com\s*$/;
    //var email_regex3 = /.net\s*$/;

    $('#emailpopup').bind('keyup blur',function(){
      var emailVal = $("#emailpopup").val();
      //console.log($('#email').val(emailVal.substring(emailVal.lastIndexOf('.'))));

      if (!$.trim($("#emailpopup").val()).length) {
        $('#sendUrlMail').attr('disabled', true);
      }

          else if(!(emailVal).match(mailformat)){
              $('#sendUrlMail').attr('disabled', true);
          }
          /*else if(!mailformat.test($("#email").val())){
              $('#nextPage4').attr('disabled', true);
          }*/
          /*else if (!/.com\s*$/|/.co.id\s*$/.test(emailVal) ){
            $('#nextPage4').attr('disabled', true);
          }*/
          else{
              $('#sendUrlMail').attr('disabled',false);
          }
      });
    </script>
 @yield('javascript')
</body>
</html>
