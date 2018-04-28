
  $(function () {

      //$(function () {
          $('#StartDate').datetimepicker({
              useCurrent: false,
              minDate: moment(),
              allowInputToggle: true,
              widgetPositioning:{
                  horizontal: 'auto',
                  vertical: 'bottom'
              }
          });
          $('#EndDate').datetimepicker({
              useCurrent: false,
              minDate: moment(),
              allowInputToggle: true,
              widgetPositioning:{
                  horizontal: 'auto',
                  vertical: 'bottom'
              }
          });
          $("#StartDate").on("change.datetimepicker", function (e) {
              $('#EndDate').datetimepicker('minDate', e.date);

          });
          $("#EndDate").on("change.datetimepicker", function (e) {
              $('#StartDate').datetimepicker('maxDate', e.date);
          });
      //});
        /*$('#StartDate').datetimepicker(
            {
                useCurrent: false,
                minDate: moment(),
                allowInputToggle: true,
                widgetPositioning:{
                    horizontal: 'auto',
                    vertical: 'bottom'
                }
            }
        );

        $('#EndDate').datetimepicker(
            {
                useCurrent: false,
                minDate: moment(),
                allowInputToggle: true,
                startDate:  new Date(),
            }
        );*/

    });

    $(document).ready(function(){
        $('#gType').on('change', function() {
            if ( this.value == 'Team')
            {
                $("#selectteam").show();
                $("#numteam").show();
            }
            else
            {
                $("#selectteam").hide();
                $("#numteam").hide();
            }
        });
    });

    $('#spnCharLeft').css('display', 'none');
    var maxLimit = 150;
    $(document).ready(function () {
        $('#description').keyup(function () {
            var lengthCount = this.value.length;
            if (lengthCount > maxLimit) {
                this.value = this.value.substring(0, maxLimit);
                var charactersLeft = maxLimit - lengthCount + 1;
            }
            else {
                var charactersLeft = maxLimit - lengthCount;
            }
            $('#spnCharLeft').css('display', 'block');
            $('#spnCharLeft').text(charactersLeft + ' Characters left');
        });
    });



    function fetch_team(val){
            $.ajax({
                type: 'post',
                url: 'fetch_team.php',
                data: {
                    get_option:val
                },
                success: function (response) {
                document.getElementById("new_select").innerHTML=response;
           }
        });

    }

  function deleteTM(val){

      $.ajax({
          type: 'post',
          url: 'deleteTM.php',
          data: {
              get_id:val,
          },
          success: function (data) {
              $(".status").html(data);
          }
      });
  }

  function updateTM(val){
    var name = document.getElementById('tmname'+val).value;
    var des =  document.getElementById('desc'+val).value;
  $.ajax({
      type: 'post',
      url: 'update_tournament.php',
      data: {get_id:val,
          tm_name:name,
          desc:des
      },
      success: function (response) {
          // process on data
          alert("got response as "+"'"+response+"'");
      }
  });
  
}

function trans_Approve(val) {
    //get tm id
    // get creator email
    // send to deny. php
    $.ajax({
        type: 'post',
        url: 'approved.php',
        data: {get_id: val,
        },
        success: function (response) {
            // process on data
            alert("got response as "+"'"+ response + "'");
        }
    });
}


function trans_Deny(val){
    //get tm id
    // get creator email
    // send to deny. php
    var reason = document.getElementById('denyreason'+val).value;
    $.ajax({
        type: 'post',
        url: 'deny.php',
        data: {get_id:val,
            get_reason:reason,
        },
        success: function (response) {
            // process on data
            alert("got response as "+"'"+response+"'");
        }
    });


}