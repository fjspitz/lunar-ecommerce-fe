<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="text" name="email">
        </div>

        <div>
            <label for="email">Password</label>
            <input type="password" name="password">
        </div>

        <input type="submit" value="Login">
    </form>
</body>

</html>
