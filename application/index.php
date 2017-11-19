<?php
require_once('data/employee.php');
//require_once('data/customer.php');

$user;
if(isset($_POST['type'])) {
    switch ($_POST['type']){
        case "customer":
            $user = doCustomerLogin($_POST['username'], $_POST['password']);
            break;
        case "employee":
            $user = doEmployeeLogin($_POST['username'], $_POST['password']);
            var_dump($user);
            break;
    }
    if ($user != false) {
        session_start();
        $_SESSION['user'] = $user;
        switch ($user['role']) {
            case 'manager':
                header("Location: admin/admin_home.php");
                break;
            case 'driver':
                header("Location: driver/driver_home.php");
                break;
            case 'mechanic':
                header("Location: mechanic/mechanic_home.php");
                break;
            default:
                header("Location: customer/customer_home.php");
                break;

        }
    }
    else {
        echo "wrong username or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <title>Login</title>
</head>
<body background="pics/loginBackground.jpg">
<div class="jumbotron  d-flex align-items-center">
    <div class="container">
        <form class="form-signin" method="post" action="#">
            <h2 class="form-signin-heading">Please Sign In</h2>
            <label for="inputUsername" class="sr-only">Email Address</label>
            <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus name="username">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
            <div class="btn-group" role="group">
                <button class="btn btn-outline-primary" type="submit" name="type" value="customer">Customer Sign In</button>
                <button class="btn btn-outline-success" type="submit" name="type" value="employee">Employee Sign In</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>