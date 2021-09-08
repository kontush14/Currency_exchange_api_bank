<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <?php
        require "db.php";

        $data = $_POST;
        if(isset($data['do_signup']))
        {
            $errors = array();
            if( trim($data['login']) == '')
            {
                $errors[] = 'Enter login';
            }

            if( trim($data['email']) == '')
            {
                $errors[] = 'Enter Email';
            }

            if( $data['password'] == '')
            {
                $errors[] = 'Enter password';
            }

            if( $data['password_2'] != $data['password'])
            {
                $errors[] = 'The repeated password was entered incorrectly!';
            }

            if( R::count('users', "login = ?", array($data['login'])) > 0)
            {
                $errors[] = 'User with this login already exists!';
            }

            if( R::count('users', "email = ?", array($data['email'])) > 0)
            {
                $errors[] = 'User with this email already exists!';
            }

            if(empty($errors))
            {
                // all OK
                $user = R::dispense('users');
                $user->login = $data['login'];
                $user->email = $data['email'];
                $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
                R::store($user);
                echo '<div style = "color: green;">You have successfully registered</div><hr>'; 
            }
            else 
            {
                echo '<div style = "color: red;">'.array_shift($errors).'</div><hr>';    
            }
        }
    ?>
    <form action = "/signup.php" method = "POST">
        <p>
            <strong>Your login :</strong>
            <br>
            <input type = "text" name = "login" value = "<?php echo @$data['login']; ?>"> 
        </p>
        <p>
            <strong>Your Email :</strong>
            <br>
            <input type = "email" name = "email" value = "<?php echo @$data['email']; ?>">
        </p>
        <p>
            <strong>Your password :</strong>
            <br>
            <input type = "password" name = "password" value = "<?php echo @$data['password']; ?>">
        </p>
        <p>
            <strong>Enter your password again :</strong>
            <br>
            <input type = "password" name = "password_2"value = "<?php echo @$data['password_2']; ?>">
        </p>
        <p>
            <button type = "submit" name = "do_signup">Register now</button>
        </p>
    </form>
</body>
</html>