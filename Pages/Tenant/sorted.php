<?php session_start();
if (!empty($_SESSION["uname"])) { ?>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Styles/sorted.css" />
  </head>

  <body>

    <!-- NAVIGATION BAR -->
    <div class="sem-bag">
      <div class="container-fluid position-absolute" id="nav-contain">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pb-2 pt-2" style="border-radius: 20px ; background-color:black">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand text-primary" href="../Tenant/home.php">ROOMMATES</a>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a id="navlink" class="nav-item nav-link" href="../Tenant/home.php">Home</a>
              <a id="navlink" class="nav-item nav-link" href="#">Features</a>
              <a id="navlink" class="nav-item nav-link active" href="../Tenant/sorted.php">Pricing</a>
            </div>
          </div>
          <div class="btn-group dropstart">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="top: 10px;right: 5px;border: none;">
              <img src="https://t3.ftcdn.net/jpg/00/64/67/52/360_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" class="rounded-circle">
            </button>
            <ul class="dropdown-menu">
              <h6 class="dropdown-header"><?php echo $_SESSION["uname"] ?></h6>
              <li><a class="dropdown-item" href="../Tenant/tenant_logout.php">Logout</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <br><br>
    <div class="container">
      <div class="row" style="justify-content: center;margin-bottom: 25px;">
        <div class="col-sm-2 col-sm-offset-2">
          <select class="fil">BHK<option>1BHK</option>
            <option>2 BHK</option>
            <option>3 BHK</option>
            <option>+3 BHK</option>
          </select>
        </div>
        <div class="col-sm-2">
          <select class="fil">Price<option>0 - 10000</option>
            <option>10000 - 30000</option>
            <option>30000 - 50000</option>
            <option>+50000</option>
          </select>
        </div>
        <div class="col-sm-2">
          <select class="fil">Furnished<option>Nonfurnished</option>
            <option>Semi-Furnished</option>
          </select>
        </div>
        <div class="col-sm-2">
          <select class="fil">City
            <option>Pune</option>
            <option>Mumbai</option>
            <option>Delhi</option>
            <option>Hyderabad</option>
            <option>Bangalore</option>
          </select>
        </div>
      </div>
      <div class="row" id=cd style="padding-top: 20px;">
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="hm.webp">
              <h5 class="card-title">Special Title </h5>
              <b>10,000</b>
              <p class="card-text">2 BHK<br>Pune, Maharashtra.</p>
              <a href="detail.html" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home2.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>20,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home3.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>30,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home4.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>25,000</b>
              <p class="card-text">1 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id=cd style="padding-top: 20px;">
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home1.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>10,000</b>
              <p class="card-text">2 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home2.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>20,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home3.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>30,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home4.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>25,000</b>
              <p class="card-text">1 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id=cd style="padding-top: 20px;">
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home1.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>10,000</b>
              <p class="card-text">2 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home2.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>20,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home3.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>30,000</b>
              <p class="card-text">3 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card" id="property-card" style="width:280px;">
            <div class="card-body">
              <img src="home4.jpg">
              <h5 class="card-title">Special Title </h5>
              <b>25,000</b>
              <p class="card-text">1 BHK<br>Pune, Maharashtra.</p>
              <a href="#" class="btn btn-primary">More Detail</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>

  </html>
<?php } else {
  echo "<script>window.location.href='../Tenant/login.php';</script>";
} ?>