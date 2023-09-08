<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
    } else {
        if ($password === $confirm_password) {
            $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
                    $mail->isSMTP(); //Send using SMTP
                    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
                    $mail->SMTPAuth = true; //Enable SMTP authentication
                    $mail->Username = 'dine.ease23@gmail.com'; //SMTP username
                    $mail->Password = "gewlcgaqyelntrdb"; //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('dine.ease23@gmail.com');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = 'no reply';
                    $mail->Body = 'Here is the verification link <b><a href="http://localhost/demo/DineEase-Application/registration/?verification=' . $code . '">http://localhost/demo/DineEase-Application/registration/?verification=' . $code . '</a></b>';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";
                $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta Tags -->
    <meta charset='utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
    <meta name='description'
        content='This is the Web Application of DineEase App. We are giving you a help to take food at anytime from a restaurant without telling them to a waiter.' />
    <meta name='author' content='DineEase' />
    <meta name='keywords' content='Register' />

    <!-- Facebook OG Tags -->
    <meta property='og:title' content='DineEase' />
    <meta property='og:type' content='website' />
    <meta property='og:url' content='https://yoshitharathnayake.github.io/DineEase-Application' />
    <meta property='og:image' content='assets/img/logo.png' alt='DineEase Logo' />
    <meta property='og:description'
        content='This is the Web Application of DineEase App. We are giving you a help to take food at anytime from a restaurant without telling them to a waiter.' />
    <meta property='og:site_name' content='DineEase' />
    <meta property='og:locale' content='en_US' />

    <!-- Font Awesome -->
    <link rel='stylesheet'
        href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css'
        integrity='sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7' crossorigin='anonymous' />
    <link rel='stylesheet'
        href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'>

    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous' />

    <!-- Jquery -->
    <script src='https://code.jquery.com/jquery-1.10.2.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.1/animate.min.css'
        integrity='sha512-E5hbw9GiuYofTcrbba1gAU64dn/54A9nmk4IEMzmp+YmiLc0WnRLOfzofb/r6spu5CVilyob07HWGhXq7Ht7dQ=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Swipers JS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css' />

    <!-- AOS -->
    <link rel='stylesheet' href='https://unpkg.com/aos@next/dist/aos.css' />

    <!-- Scroll Reveal -->
    <script src='https://unpkg.com/scrollreveal'></script>

    <!-- LineIcons -->
    <link href='your-project-dir/icon-font/lineicons.css' rel='stylesheet' />
    <link href='https://cdn.lineicons.com/3.0/lineicons.css' rel='stylesheet' />

    <!-- Google -->
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap' rel='stylesheet' />

    <!-- Favicon -->
    <link rel='icon' type='image/png' href='../assets/img/favicon.png' alt='Favicon' />

    <!-- Title -->
    <title>Register | DineEase</title>

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <a href="../#home"><i class="fa fa-close text-white"></i></a>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p>DineEase | Browse Restaurants</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $name;
                                } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $email;
                                } ?>" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password"
                                required>
                            <input type="password" class="confirm-password" name="confirm-password"
                                placeholder="Confirm Your Password" required>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>