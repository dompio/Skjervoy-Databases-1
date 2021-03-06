<?php
session_start();

mysql_connect("silva.computing.dundee.ac.uk", "19ac3u05", "abc123") or die(mysql_error());
mysql_select_db("19ac3d05") or die(mysql_error());

if(!empty($_GET["action"])) {
  switch($_GET["action"]) {
      case "logout": 
        if (isset($_SESSION['name'])) {
          unset($_SESSION['id']);
          unset($_SESSION['name']);
        }
      break;	
  }
} 

if (isset($_POST['inputted-username']))
{
  $username = $_POST['inputted-username'];
  $password = $_POST['inputted-password'];
  $hashedpw = hash('sha256', $password);
  
  $data = mysql_query("SELECT `Customer ID`, Name, Email, Address FROM Customers WHERE Email=\"$username\" AND Password=\"$hashedpw\"") or die(mysql_error('No Records Found'));
  
  while ($info = mysql_fetch_array($data)) {
    $_SESSION['id'] = $info['Customer ID'];
    $_SESSION['name'] = $info['Name'];
  }
}
?>
<!DOCTYPE html>
<html>

<head>

  <!-- Tab Title-->
  <title>Skjervoy</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

  <!-- Bootstrap Link-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Our External Style Sheet-->
  <link rel="stylesheet" type="text/css" href="style.css">

  <!-- Icon Libary-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <!-- Top Banner Colors-->
  <div class="rainbow_group">
    <div class="bluebar"></div>
    <div class="whitebar"></div>
    <div class="redbar"></div>
  </div>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="col-xs-4 navbar-nav mx-auto justify-content-center">
        <li class="nav-item"><a href="our-pens.php" class="nav-link">Our Pens</a></li>
        <li class="nav-item"><a href="our-notebooks.php" class="nav-link">Our Notebooks</a></li>
        <li class="nav-item"><a href="our-locations.php" class="nav-link">Our Stores</a></li>
      </ul>
    </div>
    <img class="col-xs-4 justify-content-center" src="resources/black_logo.png" alt="logo" height="10%" width="10%" data-toggle="null" data-target="null" onclick="window.location.href = 'index.php';">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="col-xs-4 navbar-nav mx-auto justify-content-center">
        <li class="nav-item"><a href="shopping-cart.php" class="nav-link">&#128722; Your Cart </a></li>
          <?php if (!isset($_SESSION['name'])) { ?>
            <li class="nav-item"><a href="login.php" class="nav-link">&#x1F464; Login </a></li>
          <?php } else { ?>
            <li class="nav-item"><a href="index.php?action=logout" class="nav-link">&#x1F464; Logout </a></li>
          <?php } ?>
        <li>
        <form action="search.php" method="GET" class="form-inline">
          <input class="form-control form-control-sm ml-3 w-75" name="query" type="text" placeholder="Search" aria-label="Search">
        </form>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Splash Home Screen Image-->
  <div class="splash_container">
    <img class="splash" onclick="window.location.href = 'our-notebooks.php';" src="resources/front_page.jpg" alt="notepad with pen" style="width:100%;">
  </div>

  <!-- First Black Description Box-->
  <div class="black_box_desc">
    <p class="center_box_heading">
      <font face="javanese-text" ->- Our Products -</font>
    </p>
  </div>

  <!-- First List Of Product Category-->
  <div class="product_block">
    <div class="row mb-2">
      <div class="col-sm d-flex justify-content-center">
        <div class="card mb-3" style="max-width: 1000px;">
          <div class="row no-gutters">
            <h5 class="card-title">Our Pen Collection</h5>
          </div>
          <div class="row no-gutters">
            <div class="col-md-7">
              <img src="resources/cat_pens.png" class="card-img" alt="Pen Category">
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <p class="card-text">We offer a large range of stunning premium pens of the highest quality from our hand picked partners. We ensure the best products are chosen and pride our self's on ensuring no defects are found.</p>
                <div class="card_button">
                  <button type="button" class="btn btn-outline-dark" style="color:white" onclick="window.location.href = 'our-pens.php';">View Collections</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-2 ">
      <div class="col-sm d-flex justify-content-center">
        <div class="card mb-3" style="max-width: 1000px;">
          <div class="row no-gutters">
            <h5 class="card-title">Our Notebook Collection</h5>
          </div>
          <div class="row no-gutters">
            <div class="col-md-7">
              <img src="resources/cat_notebook.png" class="card-img-top" alt="Notebook Category">
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <p class="card-text">We offer a large range of stunning premium notebooks of the highest quality from our hand picked partners. We ensure the best products are chosen and pride our self's on ensuring no defects are found.</p>
                <div class="card_button">
                  <button type="button" class="btn btn-outline-dark" style="color:white" onclick="window.location.href = 'our-notebooks.php';">View Collections</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Story Of Company Description-->
  <div class="black_box_desc">
    <p class="center_box_heading">- The Story of Skjerv&oslash;y -</p>
    <p class="center_box_desc">Our story begins in 1925 when our beloved founder, Frank, first discovered the fine art of pen craftsmanship. Using only the best and highest quality materials he began to experiment with different designs. His unique sense of style and unparalleled eye for quality lead to him establishing a store and distribution chain which would become far greater then he could ever imagine.</p>
    <img class="flag" src="resources/flag.png" alt="norsk flag" height=auto width=auto>
  </div>

  <!-- Find Other Locations Card-->
  <div class="product_block">
    <div class="row mb-2 ">
      <div class="col-sm d-flex justify-content-center">
        <div class="card mb-3" style="max-width: 1000px;">
          <div class="row no-gutters">
            <h5 class="card-title">Find one of our establishments</h5>
          </div>
          <div class="row no-gutters">
            <div class="col-md-7">
              <img src="resources/shop_scene.png" class="card-img" alt="shop_scene">
            </div>
            <div class="col-md-5">
              <div class="card-body">
                <p class="card-text">We offer a large range of stunning premium pens and notebooks of the highest quality from our hand picked partners. We ensure the best products are chosen and pride our self's on ensuring no defects are found.</p>
                <div class="card_button">
                  <button type="button" class="btn btn-outline-dark"  onclick="window.location.href = 'our-locations.php';" style="color:white">View Locations</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Banner Colors-->
  <div class="bluebar"></div>
  <div class="whitebar"></div>
  <div class="redbar"></div>

  <!-- Footer-->
  <footer id="footer" class="footer-1">
    <div class="main-footer widgets-dark typo-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col text-left">
            <div class="widget">
              <h5 class="widget-title">
                <font face="javanese-text">Quick Links</font><span></span>
              </h5>
              <ul class="thumbnail-widget">
                <li>
                  <div class="thumb-content"><a href="index.php">Home</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="our-pens.php">Our Pen Collection</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="our-notebooks.php">Our Notebooks</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="our-locations.php">Our Stores</a></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col text-center">
            <p><img class="logo" src="resources/Skjervoy@3x.png" alt="Skjervoy logo white" height="50%" width="50%"><br>
              <font face="kollektif">Store Opening Hours<br>
                Mon - Fri: 9 AM - 6 PM<br>
                Sat - Sun: 10 AM - 5 PM<br>
              </font>
            </p>
            <img class="flag" src="resources/flag.png" alt="norsk flag" height=auto width=auto>
            <p>
              <font face="kollektif">Made with &#128149 by Team 5 &copy <?php echo date("Y"); ?></font>
            </p>
          </div>
          <div class="col text-right">
            <div class="widget">
              <h5 class="widget-title">
                <font face="javanese-text">Company Information</font><span></span>
              </h5>
              <ul class="thumbnail-widget">
                <li>
                  <div class="thumb-content"><a href="error.php">Privacy Policy</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="employee-access.php">Employee Access</a></div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>