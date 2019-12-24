<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>
    <link rel="stylesheet" href="/resource/css/style.css">
    <link rel="stylesheet" href="/resource/css/authorization.css">
</head>
<body>
    <div class="center">
        <h1>Authorization</h1>
        <form action="/resource/controller/Authorization.php" method="post">
            <input type="text" name="name" id="name" placeholder="It's name">
            <input type="password" name="password" id="password" placeholder="It's password">
            <input type="submit" value="Authorization" name="submit">
        </form>
        <div class="help"><small>Not registered? <a href="/resource/view/add_update_user.php">Click to register</a></small></div>
    </div>
</body>
</html>