<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>    
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('430fda1055afdc1d70da', {
        cluster: 'ap2',
        forceTLS: true
        });

        var channel = pusher.subscribe('channelRiya');
        channel.bind('eventChat', function(data) {
            $('#chatBox').append('<p>'+data.message+'</p>');
        });
    </script>    
</head>
<body>
<div class="container">
    <div id="chatBox" style="background-color:white;width:40%;min-height:300px">
    </div>
    <div>
        <form action="" method="post">
            <button type="submit">Click Me</button>
        </form>    
    </div>
</div>

<script>
    var url = "<?php echo site_url('MyWebsiteApi/notification'); ?>";
    $('form').submit(function(e){
        e.preventDefault();
        ajaxPost();
        async function ajaxPost()
        {
            let request = await fetch(url);
        }
    });
</script>
   
</body>
</html>