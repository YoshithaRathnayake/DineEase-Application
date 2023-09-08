<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form has been submitted
    if (isset($_POST['save_profile'])) {
        // Retrieve the updated data from the form
        $newName = $_POST['new_name'];
        $newMobileNumber = $_POST['new_mobile_number'];
        // $newEmail = $_POST['new_email'];

        // Update the database with the new data
        $updateQuery = "UPDATE users SET name='$newName', mobile_number='$newMobileNumber', WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        mysqli_query($conn, $updateQuery);

        // Redirect to a success page or refresh the current page
        // You can add appropriate redirection logic here
    }
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $name = $row['name'];
    $email = $row['email'];
    $mobileNumber = $row['mobile_number'];
    echo "
    <head>

        <!-- Meta Tags -->
        <meta charset='utf-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
        <meta name='description'
        content='This is the Web Application of DineEase App. We are giving you a help to take food at anytime from a restaurant without telling them to a waiter.' />
        <meta name='author' content='DineEase' />
        <meta name='keywords' content='Your Profile' />

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

        <!-- CSS-->
        <link rel='stylesheet' type='text/CSS' href='css/style.css' />

        <!-- Favicon -->
        <link rel='icon' type='image/png' href='../assets/img/favicon.png' alt='Favicon' />

        <!-- Title -->
        <title>Your Profile | DineEase</title>

    </head>
       
       <!-- Back to Top Button goes here -->
       <div id='backToTop'></div>

       <body id='home'>
            <header class='nav-bar text-capitalize'>
            
            <div class='image'>
            <a href='../' class='logo' data-toggle='tooltip' title='DineEase'><img src='../assets/img/logo.png'><span class='logo-text'>DineEase</span></a>
            </div>
            
            <nav class='navbar'>
            <a href='../' id='home-btn' data-toggle='tooltip' title='Home'>home</a>
            <a href='../#about' id='about-btn' data-toggle='tooltip' title='About'>about</a>
            <a href='../#review' id='review-btn' data-toggle='tooltip' title='Review'>review</a>
            <a href='../#contact' id='contact-btn' data-toggle='tooltip' title='Contact Us'>contact us</a>
            </nav>
            
            <div class='icons'>
            <a href='../qrScanner' class='fas fa-qrcode' id='qrcode' data-toggle='tooltip' title='Scan To Order'></a>
            <a href='#' class='fas fa-plate-wheat' data-toggle='tooltip' title='Watch Your Plate'></a>
            <a href='../registration/' class='fas fa-user' data-toggle='tooltip' title='Your Profile'></a>
            <i class='fas fa-bars' id='menu-bars' data-toggle='tooltip' title='Menu'></i>
            </div>
            </header>
            
            <div class='container profile bg-white mt-5 mb-5' style='font-size: 120%;'>
                <form method='POST' action='update_profile.php' style='font-size: 100%;'>
                    <div class='row'>
                        <div class='col-md-3 border-right'>
                            <div class='d-flex flex-column align-items-center text-center p-3 py-5'><img class='rounded-circle mt-5' width='150px' src='https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'>
                            <span class='font-weight-bold'>$name</span>
                            <span class='text-black-50'>$email</span>
                            <span class='text-black-50'>$mobileNumber</span>
                            <span> </span>
                            </div>
                        </div>
                        <div class='col-md-5 border-right'>
                            <div class='p-3 py-5'>
                                <div class='d-flex justify-content-between align-items-center mb-3'>
                                    <h4 class='text-right' style='font-size: 140%;'>Profile Settings</h4>
                                </div>
                                <div class='row mt-2'>
                                    <div class='col-md-6'><label style='font-size: 120%;' class='labels mt-4'>Full Name</label><input style='font-size: 100%;' type='text' class='form-control mt-2' name='new_name' value='$name'></div>
                                </div>
                                <div class='row mt-3'>
                                    <div class='col-md-12'><label style='font-size: 120%;' class='labels mt-3'>Mobile Number</label><input style='font-size: 100%;' type='text' class='form-control mt-2' name='new_mobile_number' value='$mobileNumber'></div>
                                </div>
                                <div class='d-flex' style='width: 150%;'>
                                <div class='mt-5 text-center'><button class='profile-button mt-3' type='submit' name='save_profile' style='font-size: 100%;'>Save Profile</button></div>
                                <div class='mt-5 text-center'><button class='profile-button logout' type='button' style='font-size: 100%;'><a class'logout-btn text-white' href='logout.php'>Logout</a></button></div>
                                <div class='mt-5 text-center'><button class='profile-button logout' type='button' style='font-size: 100%;'><a class'logout-btn text-white' href='logout.php'>Add Restaurant</a></button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </body>

       <div id='footer'></div>
       
       <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
       <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
       <script src='https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js'></script>
       <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js'></script>
       <script type='text/javascript' src='js/script.js'></script>
    ";
}
?>