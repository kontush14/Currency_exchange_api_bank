<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization</title>
</head>
<body>
    <?php
        require "db.php";

        $data = $_POST;

        if(isset($data['do_login']))
        {
            $errors = array();
            $user = R::findOne('users', 'login = ?', array($data['login']));
            if($user)
            {
                //login exists
                if(password_verify($data['password'], $user->password))
                {
                    $_SESSION['logged_user'] = $user;
                    echo '<div style = "color: green;">You are successfully logged in, you can go  <a href = "/currencyapi.php">home</a> page</div><hr>';
                }
                else 
                {
                    $errors[] = 'Incorrect password entered';    
                }
            }
            else 
            {
                $errors[] = 'User with this username was not found';
            }
            if( ! empty($errors))
            {
                echo '<div style = "color: red;">'.array_shift($errors).'</div><hr>';  
            }
            
        }
    ?>
    <form action = "login.php" method = "POST">
        <p>
            <strong>Login :</strong>
            <br>
            <input type = "text" name = "login" value = "<?php echo @$data['login']; ?>"> 
        </p>
        <p>
            <strong>Password :</strong>
            <br>
            <input type = "password" name = "password" value = "<?php echo @$data['password']; ?>"> 
        </p>
        <p>
            <button type = "submit" name = "do_login">Log in</button>
        </p>
    </form>
</body>
</html>