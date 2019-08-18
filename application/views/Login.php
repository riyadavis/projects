<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo site_url('SemiWebsiteApi/LoginToken'); ?>" class="form-group" method="post">
        <div class="form-control">
            <input type="text" name="uid" placeholder="enter your id">
        </div>
        <div class="form-control">
            <input type="text" name="uname" placeholder="enter your name">
        </div>
        <div class="form-control">
        <input type="text" name="urole" placeholder="enter your role">
        </div>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>