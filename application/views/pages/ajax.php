<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax</title>
</head>
<body>
    
</body>
<script>
    var url = "http://localhost/MyWebsite/MyWebsiteApi/ajaxApi";
    async function Fetch()
    {
        var request = await fetch(url);
        var response = await request.json();
        console.log(response);
    }
    Fetch();
</script>
</html>