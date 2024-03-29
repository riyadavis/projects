<!DOCTYPE html>
<html>
<head>
  <title>Pusher Test</title>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>    
  <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('e6256b34427ca9b29815', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <form action="" method="post">
            <button type="submit">Click Me</button>
        </form>
</body>
<script>
var url = "<?php echo site_url('MyWebsiteApi/confirmMessage'); ?>";
    $('form').submit(function(e){
        e.preventDefault();
        // document.getElementById('chatbox').innerText = "";
        ajaxPost();
        async function ajaxPost()
        {
            let request = await fetch(url);
        }
    });
    
</script>
</html>