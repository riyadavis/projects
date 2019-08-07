<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('430fda1055afdc1d70da', {
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
<div class="container">
    <div id="chatBox" style="background-color:white;width:40%;min-height:300px">
    </div>
    <div>
        <form action="" method="post">
            <input type="text" name="userName" id="userName" placeholder="username"><br/>
            <input type="text" name="message" id="message" placeholder="message"><br/>       
            <button type="submit">Send</button>
        </form>    
    </div>
</div>

<script>
    var url = "<?php echo site_url('RecipeApi/chatPusher'); ?>";
    $('form').submit(function(e){
        e.preventDefault();
        ajaxPost();
        async function ajaxPost()
        {
            let formData = new FormData();
            formData.append('userName', $('#userName').val());
            formData.append('message', $('#message').val());
            let request = await fetch(url,{
                method : 'post',
                body : formData,
            });
        }
    })
</script>





<!-- <script>
    var url = "<?php echo site_url('RecipeApi/chatAjax/'); ?>";
    $('form').submit(function(e){
        e.preventDefault();
        ajaxPost();
        async function ajaxPost()
        {
            let formData = new FormData();
            formData.append('userName', $('#userName').val());
            formData.append('message', $('#message').val());
            let request = await fetch(url+'post',{
                method : 'post',
                body : formData,
            });
            let response = await request.json();
            console.log(response);
        }
    })

    var id =0;
    async function ajaxRetrieve()
    {
        let request = await fetch(url+'get');
        let response = await request.json();
        let count;
        response.map((r) => {
            if(r.id>id)
            {
                $('#chatBox').append('<p>'+r.userName+':'+r.message+'</p>');            
            }
        })
        count = response.length;
        id = response[count-1].id;
        // // $('#chatBox').append('<p>'+response[0].userName+':'+response[0].message+'</p>');
        // console.log(response);
    }
    // ajaxRetrieve();
    setInterval(ajaxRetrieve,1000);
</script> -->    
</body>
</html>