
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>


<button onclick="saveUseTime()">Send</button>


<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script type="text/javascript">
    
    // time must be format YYYY-MM-DD HH:mm:ss
    var beginTime = moment('2020-02-05 15:00:00') 
    
    function checkUseTime() {
        var end = moment(Date.now());

        if(!beginTime.isValid()){
          console.error("Invalid moment format")
          return 
        }

        if (beginTime.isBefore(end)) {

            var differenceInMs = end.diff(beginTime.format('YYYY-MM-DD HH:mm:ss')); // diff yields milliseconds
            var duration = moment.duration(differenceInMs); // moment.duration accepts ms
            var differenceInMinutes = duration.asMinutes();

            var useTime = Math.ceil(differenceInMinutes)
            var useTimeText = beginTime.fromNow();
            var result = {text: useTimeText, minute: useTime}
            return result
        }
    }

    function saveUseTime() {
        var data = checkUseTime();
        console.log("data ", data);

        $.ajax({  
            type: 'POST',  
            url: 'test.php', 
            data: data,
            success: function(response) {
                console.log("response form controller ", response)
            },
            error: function() {
                console.error("Error occur to send useTime " + err)
            }
        });
    }
</script>
</body>
</html>


<?php 
    echo "Hello Mink";
?>




