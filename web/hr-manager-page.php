<!DOCTYPE html>
<html>

<head>

  <!-- Tab Title-->
  <title>Skjervoy Pens</title>

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
        <li href="#"><i class="nav-link fa fa-fw fa-search"></i> Search</li>
        <li href="#"><i class="nav-link fa fa-shopping-cart"></i> Your Cart</li>
        <li href="#"><i class="nav-link fa fa-fw fa-user"></i> Login</li>
      </ul>
    </div>
  </nav>

  <div class="splash-container">
    <img class="splash" src="resources/fjord.jpg" alt="black and white fjord" style="width:100%;">
  </div>


  <?php
  $server = "silva.computing.dundee.ac.uk";
  $user = "19ac3u05";
  $pass = "abc123";
  $database = "19ac3d05";


  $mysql = new PDO("mysql:host=" . $server . ";dbname=" . $database, $user, $pass);
  //not sure what the next line is, from
  //https://www.w3schools.com/php/php_mysql_prepared_statements.asp
  $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ?>

  <?php
  try {

    //$mysql = new mysqli($server, $user, $pass, $database);

      $stmt = $mysql->prepare(
        "SELECT `Employee ID`, Name, Email, Phone, Salary, Role, `Bank Details` FROM Employees"
      );

      $stmt->execute();
      echo "<table>\n
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email address</th>
            <th>Phone number</th>
            <th>Salary</th>
            <th>Role</th>
            <th>Bank details</th>
        </tr>";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $employee_id_found = $row['Employee ID'];
        $name = $row['Name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $salary = $row['Salary'];
        $role = $row['Role'];
        $bank_details = $row['Bank Details'];
        echo "<tr>
            <td>$employee_id_found</td>
            <td>$name</td>
            <td>$email</td>
            <td>$phone</td>
            <td>$salary</td>
            <td>$role</td>
            <td>$bank_details</td>
            <td><form><button formmethod=\"post\" formaction=\"edit-employee.php\"
            formtarget=\"_blank\"
            type=\"submit\" value=\"$employee_id_found\" name=\"employee-id-button\">
                Edit</button></form></td>
        </tr>";
      }
      echo "</table>";
      if (!isset($employee_id_found)) {
        echo "No employees found 😢 <br/>";
      }

  } catch (PDOException $e) {
  }
  ?>

  </div>


  <!-- Bottom Banner Colors-->
  <div class="bluebar"></div>
  <div class="whitebar"></div>
  <div class="redbar"></div>

  <!-- Footer -->
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
                  <div class="thumb-content"><a href="#.">Home</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="#.">Products</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="#.">Store Guide</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="#.">Track Orders</a></div>
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
                  <div class="thumb-content"><a href="#.">Privacy Policy</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="#.">Employee Access</a></div>
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