<?php           // Adapted from "https://phppot.com/php/simple-php-shopping-cart/"
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
case "add":
if(!empty($_POST["quantity"])) {
  $productByCode = $db_handle->runQuery("SELECT * FROM Products WHERE Name=\"" . $_GET["Name"] . "\"");
  $itemArray = array($productByCode[0]["Name"]=>array('Name'=>$productByCode[0]["Name"], `Product ID`=>$productByCode[0]["Product ID"], 'quantity'=>$_POST["quantity"],`Selling Price`=>$productByCode[0]["Selling Price"], 'Picture'=>$productByCode[0]["Picture"]));
  if(!empty($_SESSION["cart_item"])) {
    if(in_array($productByCode[0]["Name"],array_keys($_SESSION["cart_item"]))) {
      foreach($_SESSION["cart_item"] as $k => $v) {
        if($productByCode[0]["Name"] == $k) {
          if(empty($_SESSION["cart_item"][$k]["quantity"])) {
            $_SESSION["cart_item"][$k]["quantity"] = 0;
          }
          $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
        }
      }
    } else {
    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
    }
  } else {
    $_SESSION["cart_item"] = $itemArray;
  }
}
break;
case "remove":
if(!empty($_SESSION["cart_item"])) {
foreach($_SESSION["cart_item"] as $k => $v) {
if($_GET["Name"] == $k)
unset($_SESSION["cart_item"][$k]);				
if(empty($_SESSION["cart_item"]))
unset($_SESSION["cart_item"]);
}
}
break;
case "empty":
unset($_SESSION["cart_item"]);
break;	
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Tab Title-->
    <title>Skjervoy Pens
    </title>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- Our External Style Sheet-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Icon Libary-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Top Banner Colors-->
    <div class="rainbow_group">
      <div class="bluebar">
      </div>
      <div class="whitebar">
      </div>
      <div class="redbar">
      </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="col-xs-4 navbar-nav mx-auto justify-content-center">
          <li class="nav-item">
            <a href="our-pens.php" class="nav-link">Our Pens
            </a>
          </li>
          <li class="nav-item">
            <a href="our-notebooks.php" class="nav-link">Our Notebooks
            </a>
          </li>
          <li class="nav-item">
            <a href="our-locations.php" class="nav-link">Our Stores
            </a>
          </li>
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
          <li>
            <form action="search.php" method="GET" class="form-inline">
              <input class="form-control form-control-sm ml-3 w-75" name="query" type="text" placeholder="Search" aria-label="Search">
            </form>
          </li>
        </ul>
      </div>
    </nav>
    <div class="splash-container">
      <img class="splash" src="resources/cart.jpg" alt="black and white fjord" style="width:100%;">
    </div>
    <!-- Cart -->
    <div class="flex container">
      <?php
if(isset($_SESSION["cart_item"])){ ?>
      <!-- Section Divider -->
      <div class="cart-divider">
      </div>
      <div class="cart-block">
        <p class="">
          <font face="javanese-text">Your Current Cart Contents
          </font>
        </p>
      </div>
      <!-- Button things -->
      <div class="cart-divider">
      </div>  
      <table style="width: 100%">
        <tr>
          <th>Item
          </th>
          <th>Price
          </th>
          <th>Quantity
          </th>
          <th>Total Cost
          </th>
        </tr> 
        <?php
$total_quantity = 0;
$total_price = 0;
foreach ($_SESSION["cart_item"] as $item){
$item_price = $item["quantity"]*$item[`Selling Price`]; ?>
        <tr>
          <td>
            <?php echo $item["Name"]; ?>
          </td>
          <td>
            <?php echo $item[`Selling Price`]; ?>
          </td>
          <td>
            <?php echo $item["quantity"]; ?>
          </td>
          <td>
            <?php echo $item_price; ?>
          </td>
          <td>
            <a href="shopping-cart.php?action=remove&Name=<?php echo $item["Name"]; ?>" class="btnRemoveAction">Delete
            </a>
          </td>
        </tr>
        <?php
$total_quantity += $item["quantity"];
$total_price += ($item[`Selling Price`]*$item["quantity"]);  
} ?>
        <td>Total Price
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>
          <?php echo $total_price; ?>
        </td> 
      </table>
      <?php
      $_SESSION['total_price'] = $total_price;
} else { ?>
      <!-- Section Divider -->
      <div class="cart-divider">
      </div>
      <div class="cart-block">
        <p class="">
          <font face="javanese-text">Your Cart Is Currently Empty
          </font>
        </p>
      </div>
      
      <!-- Section Divider -->
      <div class="cart-divider">
      </div>
      <?php } ?>
      <!-- Button things -->
      <div class="cart-divider-bottom">
      </div>
      <div class="flex container">
        <div class="row">
          <div class="d-flex justify-content-start">
            <a href="our-pens.php">
              <button type="button" class="btn btn-black mr-1 rounded-0">Keep Shopping Pens
              </button>
            </a>
          </div>
          <div class="d-flex justify-content-start">
            <a href="our-notebooks.php">
              <button type="button" class="btn btn-black mr-1 rounded-0">Keep Shopping Notebooks
              </button>
            </a>
          </div>
          <div class="d-flex justify-content-start">
            <a href="checkout.php">
              <button type="button" class="btn btn-black mr-1 rounded-0">Go to Checkout
              </button>
            </a>
          </div>
          <div class="d-flex justify-content-start">
            <form class="form" method="post" action="shopping-cart.php?action=empty">
              <input type="submit" class="btn btn-black mr-1 rounded-0" value="Clear Cart"/>
            </form>
          </div>
        </div>
      </div>
      <div class="cart-divider">
      </div>
    </div>
    <!-- Find Other Locations Card-->
    <div class="product_block">
      <div class="row mb-2 ">
        <div class="col-sm d-flex justify-content-center">
          <div class="card mb-3" style="max-width: 1000px;">
            <div class="row no-gutters">
              <h5 class="card-title">Find one of our establishments
              </h5>
            </div>
            <div class="row no-gutters">
              <div class="col-md-7">
                <img src="resources/shop_scene.png" class="card-img" alt="shop_scene">
              </div>
              <div class="col-md-5">
                <div class="card-body">
                  <p class="card-text">We offer a large range of stunning premium notebooks of the highest quality from our hand picked partners. We ensure the best products are chosen and pride our self's on ensuring no defects are found.
                  </p>
                  <div class="card_button">
                  <button type="button" class="btn btn-outline-dark" href="our-locations.php" style="color:white">View Locations</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
<!-- Bottom Banner Colors-->
<div class="bluebar">
</div>
<div class="whitebar">
</div>
<div class="redbar">
</div>
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
