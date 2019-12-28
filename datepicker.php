<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
        var noOfWeeks = 0;
        var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          minDate: "+1d",
          changeMonth: true,
          numberOfMonths: 1,
          beforeShowDay: (date) => {
                Date.prototype.getWeek = function() {
                    return $.datepicker.iso8601Week(this);
                }
                if (date.getDate() == 1) {
                    noOfWeeks = 0;
                }
                var day = date.getDay();

                if (day == 6) {
                    noOfWeeks += 1;
                    if (noOfWeeks == 2 || noOfWeeks == 4) {
                        var satDay = date.getDate();
                    } else {
                        var satDay = null;
                    }
                }

                if (day != 6 || date.getDate() != satDay) {
                    return [day != 0, null];
                } else {
                    return day;
                }            
            }

        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
      	dateFormat: "dd/mm/yy",
        minDate: $( "#from" ).datepicker( "option", "defaultDate"),
        changeMonth: true,
        numberOfMonths: 1,
        beforeShowDay: (date) => {
            Date.prototype.getWeek = function () { return $.datepicker.iso8601Week(this); }
            var day = date.getDay();
            var weekday = Math.ceil(date.getWeek()) % 2;
              if (weekday || day != 6) {
                 return [day != 0, null];
              } else {
                return day;
              }
            }
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }

    function disableWeekends(date) {
            Date.prototype.getWeek = function () { return $.datepicker.iso8601Week(this); }
            var day = date.getDay();
            var weekday = Math.ceil(date.getWeek()) % 2;
              if (weekday || day != 6) {
                 return [day != 0, null];
              } else {
                return day;
              }
    }
  } );
  </script>
</head>
<body>
 
<label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
 
 
</body>
</html>