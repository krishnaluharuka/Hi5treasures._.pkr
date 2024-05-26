<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../includes/connect.php');
include('../functions/common_functions.php');
include('../include_aboutus.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="../images/logo.jpg" rel="icon" type="image/icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        * {
            user-select: none;
        }

        input.captcha {
            pointer-events: none;
        }

        .mbtn5 {
            height: 50px;
            width: 50%;
            outline: none;
            border: none;
            padding: 5px;
            margin: auto;
            color: white;
            background: rgb(197, 12, 99);
            border-radius: 50px;
            transition: all 0.4s;
        }

        .mbtn5:hover {
            background-color: antiquewhite;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>

<body class="bg-light">
    <section class="inserting">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="text-center">
                        <h1><?php echo $company_name; ?></h1>
                        <img src="../admin_area/admin_images/<?php echo $logo; ?>" alt="Logo" class="img-fluid m-auto" width="350px" height="350px">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 border shadow my-3">
                    <h1 class="text-center py-3">USER <span class="px-4"> LOGIN </span></h1><br>

                    <form action="" method="post">
                        <!-- username field-->
                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter your username" required="required">
                        </div>

                        <!-- password field -->
                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required="required" autocomplete="off">
                        </div>

                        <!-- captcha -->



                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="confirm_captcha" class="form-label">Captcha</label>
                            <input type="text" name="confirm_captcha" placeholder="Enter Captcha" class="form-control m-0" required="required" autocomplete="off">
                        </div>



                        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="captcha" class="form-label">Captcha Code</label>
                            <input type="text" name="captcha" id="captcha" class="form-control captcha" value=<?php echo substr(uniqid(), 5); ?> required="required" autocomplete="off">
                        </div>




                        <!-- Submit -->
                        <div class="mb-4 w-50 m-auto">
                            <input type="submit" name="user_login" class="mbtn5 m-auto" value="Login">
                            <p class="small fw-bold my-2 py-1 ">Don't have an account ?
                                <a href="user_registration.php" class="text-danger">Register</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<footer class="bg-light">
    <p class="text-center py-3"><a href="https://github.com/krishnaluharuka/Hi5treasures._.pkr" class="text-decoration-none text-dark"> By Krishna Luharuka | All Rights Reserved</a></p>
</footer>

<?php
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $captcha = $_POST['captcha'];
    $confirm_captcha = $_POST['confirm_captcha'];

    $select_query = "Select * from user_table where username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_data = mysqli_fetch_assoc($result);
    $row_count = mysqli_num_rows($result);
    $user_ip = getIPAddress();
    $user_id = $row_data['user_id'];

    //cart item

    if ($row_count == 1) {
        if ($row_data['user_type'] == 'Admin') {
            if (password_verify($user_password, $row_data['user_password']) and $captcha == $confirm_captcha) {
                $_SESSION['admin_name'] = $user_username;
                $_SESSION['admin_id'] = $user_id;
                echo "<script>alert('Login Successfully')</script>";
                echo "<script>window.open('../admin_area/index.php','_self')</script>";
            } else {
                echo "<script>alert('Invalid Credentials')</script>";
            }
        } else if ($row_data['user_type'] == 'User') {
            if (password_verify($user_password, $row_data['user_password']) and $captcha == $confirm_captcha) {
                $_SESSION['username'] = $user_username;
                $_SESSION['user_id'] = $user_id;
                $user_id = $_SESSION['user_id'];
                $select_query_cart = "Select * from cart_details where ip_address='$user_ip'";
                $select_cart = mysqli_query($con, $select_query_cart);
                $row_count_cart = mysqli_num_rows($select_cart);

                if ($row_count_cart == 0) {
                    echo "<script>alert('Login Successfully')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";
                } else {
                    while ($row_cart = mysqli_fetch_array($select_cart)) {
                        $product_id = $row_cart['product_id'];
                        $quantity = $row_cart['quantity'];
                        $update_cart = "UPDATE cart_details SET user_id={$_SESSION['user_id']} WHERE ip_address='$user_ip' AND product_id=$product_id AND quantity=$quantity";
                        mysqli_query($con, $update_cart);
                    }
                    echo "<script>alert('Login Successfully')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                }
            } else {
                echo "<script>alert('Invalid Credentials during login')</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>
<?php mysqli_close($con); ?>