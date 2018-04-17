
  $(function () {
<<<<<<< HEAD
        $('#StartDate').datetimepicker(
=======

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
>>>>>>> d025b40b4e9df524c4ce76c931aae4b67f41d065
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
<<<<<<< HEAD
        );
=======
        );*/
>>>>>>> d025b40b4e9df524c4ce76c931aae4b67f41d065

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
