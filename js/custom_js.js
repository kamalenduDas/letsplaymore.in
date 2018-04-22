
$(document).ready(function() {

// effects & animations
  var u_v=0;

  $('input').focus(function() {

    $(this).css('background', 'pink');
  });

  $('input').blur(function() {

    $(this).css('background', '#e0e0e0');
  });

   
  //validation


  //fname

  $('#inputFname').on('input', function() {
    var fname = $(this).val();

    if ($.trim(fname).length != 0) {

      if ($.isNumeric($(this).val())) {

        $('#ErrorFname').html('<p class="font-weight-bold">Name must be letters </p>');

      } else {

        if (fname.length < 2) {
          $('#ErrorFname').html('<p class="font-weight-bold">Name must be more than 3 letters </p>');
        } else {
          $('#ErrorFname').html('<p class="text-success" >OK </p>');
            u_v = u_v + 1;
        }
      }

    } else {
      $('#ErrorFname').html('<p class="font-weight-bold">Name must be letters </p>');
    }
  });

  //fname

  $('#inputSname').on('input', function() {
    var sname = $(this).val();
    if ($.trim(sname).length != 0) {

      if ($.isNumeric($(this).val())) {

        $('#ErrorSname').html('<p class="font-weight-bold">Surname must be letters </p>');

      } else {

        if (sname.length < 2) {
          $('#ErrorSname').html('<p class="font-weight-bold">Surname must be more than 3 letters </p>');
        } else {
          $('#ErrorSname').html('<p class="text-success" >OK </p>');
             u_v = u_v + 1;
        }
      }

    } else {
      $('#ErrorSname').html('<p class="font-weight-bold">Surname must be letters </p>');
    }
  });

  //email validation

  $('#inputEmail4').on('input', function() {
    var sEmail = $(this).val();
    if ($.trim(sEmail).length == 0) {
      $('#ErrorEmail').html('<p class="font-weight-bold" >Provide An Email Address</p>');
      e.preventDefault();
    }
    if (validateEmail(sEmail)) {
      $('#ErrorEmail').html('<p class="text-success" >OK</p>');
          u_v = u_v + 1;
    } else {
      $('#ErrorEmail').html('<p class="font-weight-bold" >Provide a Valid Email Address</p>');
      e.preventDefault();
    }
  });

  function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
      return true;
    } else {
      return false;
    }
  }

  //passwords

  $('#inputPassword4').on('input',function(){

         var pass = $(this).val();

        if($(pass).length < 6){

          $('#ErrorPass').html('<p class="font-weight-bold" >Passwords Must Be more than 6 characters</p>');
        }
        else{
          $('#ErrorPass').html('<p class="text-success" >OK</p>');
        }
  });



  $('#inputPassword5').keyup('input',function(){


              if($(this).val() == $('#inputPassword4').val()){
                  $('#ErrorPass').html('<p class="text-success" >OK</p>');
              }
              else{
                  $('#ErrorPass').html('<p class="font-weight-bold" >Passwords Dont match</p>');
              }


  })
  //contact

  $('#inputContact').on('input', function() {

    var conn = $(this).val();

    if ($.isNumeric(conn)) {

                if ($.trim(conn).length == 10) {
                  $('#ErrorConn').html('<p class="text-success" >OK</p>');

                 }
                 else {
                   $('#ErrorConn').html('<p class="font-weight-bold" >contact no. must be 10 digits</p>');
                 }
       }
     else {
      $('#ErrorConn').html('<p class="font-weight-bold" >contact no. must be numeric</p>');
    }
  });

  //member alteration

  $('#btnAlter').click(function() {
    alert('Pressed Slot will be changed ! press again to change satus');

  });

  //member registration

  $('#inputClubname').on('input', function(){
    var club = $(this).val();
    if ($.trim(club).length == 0) {
      $('#ErrorClub').html('<p class="font-weight-bold" >Enter a valid Clubname</p>');
    } else {
      if ($.trim(club).length > 4)
        $('#ErrorClub').html('<p class="text-success" >OK</p>');
      else
        $('#ErrorClub').html('<p class="font-weight-bold" >Enter a valid Clubname</p>');
    }


  });

  // sports validation

  $('#inputSport').on('input',function(){
    var sport = $(this).val();
    if ($.trim(sport).length == 0) {
      $('#ErrorSpt').html('<p class="font-weight-bold" >Enter a valid Sports name</p>');
    } else {
      if ($.trim(sport).length > 4)
        $('#ErrorSpt').html('<p class="text-success" >OK</p>');
      else
        $('#ErrorSpt').html('<p class="font-weight-bold" >Enter a valid Sports name</p>');
    }

  });

// Address validation

$('#inputAddress').on('input',function(){
  var addr = $(this).val();
  if ($.trim(addr).length == 0) {
    $('#ErrorAddr').html('<p class="font-weight-bold" >Enter a valid Address</p>');
  } else {
    if ($.trim(addr).length > 4)
      $('#ErrorAddr').html('<p class="text-success" >OK</p>');
    else
      $('#ErrorAddr').html('<p class="font-weight-bold" >Enter a valid Address</p>');
  }

});

//pincode validation

$('#inputPincode').on('input', function() {

  var pin = $(this).val();

  if ($.isNumeric(pin)) {

              if ($.trim(pin).length == 6) {
                $('#ErrorPin').html('<p class="text-success" >OK</p>');

               }
               else {
                 $('#ErrorPin').html('<p class="font-weight-bold" >Pincode no. must be 6 digits</p>');
               }
     }
   else {
    $('#ErrorPin').html('<p class="font-weight-bold" >Pincode no. must be numeric</p>');
  }

});

//price validation

$('#inputPrice').on('input', function() {

  var price = $(this).val();
  var p = parseInt(price);

  if ($.isNumeric(price)) {

              if (p < 9999 && p > 99) {
                $('#ErrorPrice').html('<p class="text-success" >OK</p>');

               }
               else {
                 $('#ErrorPrice').html('<p class="font-weight-bold" >Price is out of terms</p>');
               }
     }
   else {
    $('#ErrorPrice').html('<p class="font-weight-bold" >Price must be numeric</p>');
  }

});



}); // end document
