 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>Pass on</title>
     <!--

Template 2095 Level

http://www.tooplate.com/view/2095-level
$sql = 'SELECT * FROM testone WHERE contact_subject = "'.$_POST['subject'].'"';

-->
     <!-- load stylesheets -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> <!-- Google web font "Open Sans" -->
     <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css"> <!-- Font Awesome -->
     <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- Bootstrap style -->
     <link rel="stylesheet" type="text/css" href="slick/slick.css" />
     <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
     <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
     <link rel="stylesheet" href="css/tooplate-style.css"> <!-- Templatemo style -->

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
 </head>

 <body>

     <div class="tm-main-content" id="top">
         <div class="tm-top-bar-bg"></div>
         <div class="tm-top-bar" id="tm-top-bar">
             <!-- Top Navbar -->
             <div class="container">
                 <div class="row">

                     <nav class="navbar navbar-expand-lg narbar-light">
                         <a class="navbar-brand mr-auto" href="#">
                             <img src="img/logo.png" alt="Site logo">
                             Pass On !
                         </a>
                         <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                         </button>
                         <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                             <ul class="navbar-nav ml-auto">
                                 <li class="nav-item">
                                     <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="BuyPage.php">Buy</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="sell.html">Sell</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#tm-section-6">Contact Us</a>
                                 </li>
                             </ul>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>

         <!-- Connect the DB -->
         <?php
            $conn = mysqli_connect("localhost", "root", "", "dbmsproj");
            if (!$conn) {
                echo 'Connection error: ' . mysqli_connect_error();
            }

            //for Branch wise Query
            if (isset($_POST['CSE'])) {
                $sql = 'SELECT * FROM testone WHERE contact_subject = "CSE"';
                $query = 'SELECT contact_name FROM testone WHERE contact_subject = "CSE"';
            } elseif (isset($_POST['ME'])) {
                $sql = 'SELECT * FROM testone WHERE contact_subject = "ME"';
                $query = 'SELECT contact_name FROM testone WHERE contact_subject = "ME"';
            } elseif (isset($_POST['BTE'])) {
                $sql = 'SELECT * FROM testone WHERE contact_subject = "BTE"';
                $query = 'SELECT contact_name FROM testone WHERE contact_subject = "BTE"';
            } elseif (isset($_POST['CVE'])) {
                $sql = 'SELECT * FROM testone WHERE contact_subject = "CVE"';
                $query = 'SELECT contact_name FROM testone WHERE contact_subject = "CVE"';
            }

            //Search Bar Query test:
            if (isset($_POST['search'])) {
                $sql = 'SELECT * FROM testone WHERE contact_name = "' . $_POST['search'] . '"';
                $query = 'SELECT contact_name FROM testone WHERE contact_name = "' . $_POST['search'] . '"';
            }


            //EXECUTE QUERY
            $result = mysqli_query($conn, $sql);
            $test = mysqli_fetch_all($result, MYSQLI_ASSOC);

            //For Getting Number of Rows
            mysqli_free_result($result);

            // Execute the query and store the result set
            $result = mysqli_query($conn, $query);

            if ($result) {
                // it return number of rows in the table.
                $row = mysqli_num_rows($result);

                // if ($row) {
                //     printf("Number of row in the table : " . $row);
                // }
                // close the result.
                mysqli_free_result($result);
            }
            //End of getting row count
            ?>

         <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
             <div class="container">
                 <!-- Search Bar: -->
                 <div class="search-container" style="position: relative;right:-410px;">
                     <form action="/Branchwise.php" method="post" class="branch-form" enctype="multipart/form-data">
                         <input type="text" placeholder="Search for a book?" name="search" style="height:40px; width:280px; border-radius:5%;">
                         <button type="submit" style="height: 40px; padding:bottom 30px;"><i class="fa fa-search"></i></button>
                     </form>
                 </div>
                 <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                         <div class="tm-article-carousel">
                             <!-- Main Php code to get data from DB and Display -->
                             <?php
                             if($row==0){
                                echo '<br><h1>No Results Found :(</h1><br>';
                             }
                             else{
                                for ($x = 0; $x < $row; $x++) {
                                    $imag = '<img src="data:bookimage/jpeg;base64,' . base64_encode($test[$x]['bookimage']) . '" height="375" width="300" class="img-thumnail" />';
                                    print "
                                <article class=\"tm-bg-white mr-2 tm-carousel-item\">
                                   {$imag}
                                    <br>
                                    <div class=\"tm-article-pad\">
                                        <header>
                                            <h3 class=\"text-uppercase tm-article-title-2\">{$test[$x]['contact_name']}</h3>
                                        </header>
                                        <p>{$test[$x]['contact_message']}</p>
                                        <a href=\"#\" class=\"text-uppercase btn-primary tm-btn-primary\">Contact the seller: {$test[$x]['contact_email']}</a>
                                    </div>
                                ";
                                }
                                }
                                ?>
                         </div>
                     </div>

                     <!-- Code to be modified -->
                     <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-recommended-container">
                         <div class="tm-bg-white">
                             <div class="tm-bg-primary tm-sidebar-pad">
                                 <h3 class="tm-color-white tm-sidebar-title">Branch Wise Categories</h3>
                                 <p class="tm-color-white tm-margin-b-0 tm-font-light">Select desired branch to view related material</p>
                             </div>
                             <div class="tm-sidebar-pad-2">

                                 <form action="Branchwise.php" method="post" class="branch-form" enctype="multipart/form-data">
                                     <a href="#" class="media tm-media tm-recommended-item">
                                         <img src="img/7.jpg" alt="Image">
                                         <div class="media-body tm-media-body tm-bg-gray">
                                             <button input type="submit" name="CSE" value="CSE">
                                                 <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Computer Science and Engineering</h4>
                                             </button>
                                         </div>
                                     </a>

                                     <a href="#" class="media tm-media tm-recommended-item">
                                         <img src="img/8.jpg" alt="Image">
                                         <div class="media-body tm-media-body tm-bg-gray">
                                             <button input type="submit" name="ME" value="ME">
                                                 <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Mechanical Engineering</h4>
                                             </button>
                                         </div>
                                     </a>
                                     <a href="#" class="media tm-media tm-recommended-item">
                                         <img src="img/9.jpg" alt="Image">
                                         <div class="media-body tm-media-body tm-bg-gray">
                                             <button input type="submit" name="BTE" value="BTE">
                                                 <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Biotech Engineering</h4>
                                             </button>
                                         </div>
                                     </a>
                                     <a href="#" class="media tm-media tm-recommended-item">
                                         <img src="img/10.jpg" alt="Image">
                                         <div class="media-body tm-media-body tm-bg-gray">
                                             <button input type="submit" name="CVE" value="CVE">
                                                 <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Civil Engineering</h4>
                                             </button>
                                         </div>
                                     </a>
                                 </form>

                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>

         <div class="tm-section tm-section-pad tm-bg-img tm-position-relative" id="tm-section-6">
             <div class="container ie-h-align-center-fix">
                 <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
                         <div id="google-map"></div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 mt-3 mt-md-0">
                         <div class="tm-bg-white tm-p-4">
                             <form action="index.html" method="post" class="contact-form">
                                 <div class="form-group">
                                     <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name" required />
                                 </div>
                                 <div class="form-group">
                                     <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email" required />
                                 </div>
                                 <div class="form-group">
                                     <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="Subject" required />
                                 </div>
                                 <div class="form-group">
                                     <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Message" required></textarea>
                                 </div>
                                 <button type="submit" class="btn btn-primary tm-btn-primary">Send Message Now</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <footer class="tm-bg-dark-blue">
             <div class="container">
                 <div class="row">
                     <p class="col-sm-12 text-center tm-font-light tm-color-white p-4 tm-margin-b-0">
                         Copyright &copy; <span class="tm-current-year">2020</span> Pass On! ® ™

                         - Design: CSN</p>
                 </div>
             </div>
         </footer>
     </div>