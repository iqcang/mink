<body onLoad="begintimer()">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script type="text/javascript">

    //'<?php echo $_SESSION["ucredit"].beginTime;?>';
    // time must be format YYYY-MM-DD HH:mm:ss
    // moment('2020-02-02 12:00:00') or moment({ year: 2020, month: 1, day :2, hour :12, minute: 00})
    var beginTime = moment({ year: 2020, month: 1, day :1, hour :14, minute: 30})

    
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

        $.ajax({  
            type: 'POST',  
            url: 'test.php', 
            data: data,
            success: function(response) {
                // {isExpired: false, remain: 50, limit: 100}
                if (response.isExpired) {
                    alert("Your account had expired")
                } else {
                    alert("Remainng time " + response.remain + " minutes")
                }
            },
            error: function(err) {
                console.error("Error occur to send useTime " + err)
            }
        });
    }

</script>


<div id=dplay ></div>


<?php echo"curmin= $curmin";?>



<form name="frmTest" action="Modules/logout.php">

<!--updatetime beforelogout-->
<!--ใส่ Form-->
</form>
