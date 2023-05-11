 <?php session_start();
  if (!empty($_SESSION["uname"])) {
    $a = $_GET['name']; ?>
   <html>

   <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
     <title></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <link rel="stylesheet" href="../../Styles/sorted.css" />
     <script type="text/javascript">
       function getdata() {
         var a = document.getElementById("city");
         var b = document.getElementById("rent");
         var c = document.getElementById("furn");
         var d = document.getElementById("bhk");
         var con = a.value + "," + b.value + "," + c.value + "," + d.value;
         detail(con)
       }

       function detail(name) {
         if (window.XMLHttpRequest) {
           xmlhttp = new XMLHttpRequest();
         } else {
           xmlhttp = new ActiveXObject("Microsoft.XMLHttp");
         }
         xmlhttp.onreadystatechange = function() {
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             document.getElementById("show").innerHTML = xmlhttp.responseText;
           }
         }
         xmlhttp.open("GET", "sorte.php?name=" + name, true);
         xmlhttp.send();
       }
     </script>
   </head>

   <body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-1 pb-1">
       <a class="navbar-brand text-primary" href="../Tenant/home.php" style="margin-left: 20px;">ROOMMATES</a>
       <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
       </div>
       <div class="align">
         <div class="btn-group dropstart">
           <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="top: 6px;right: 5px;border: none;">
             <img src="<?php echo $_SESSION["uimage"]; ?>" class="rounded-circle-1">
           </button>
           <ul class="dropdown-menu">
             <h6 class="dropdown-header"><?php echo $_SESSION["uname"] ?></h6>
             <li><a class="dropdown-item" href="../Tenant/tenant_profile.php"><img src="../../Img/Admin-Home/profile.svg" height="20" width="25" style="margin-right: 4px;"> My Profile</a></li>
             <li><a class="dropdown-item" href="../Tenant/tenant_rented_prop.php"><img src="../../Img/Admin-Home/houses.svg" height="20" width="25" style="margin-right: 4px;"> My Property</a></li>
             <li><a class="dropdown-item" href="../Tenant/tenant_logout.php"><img src="../../Img/Admin-Home/logout.svg" height="18" width="22" style="margin-right: 8px;"> Logout</a></li>
           </ul>
         </div>
       </div>
     </nav>
     <br>
     <div class="container">
       <div class="row" style="justify-content: center;margin-bottom: 25px;">
         <div class="col-sm-2">
           <select class="fil" id=city name=city>
             <?php $city = array("Pune", "Mumbai", "Delhi", "Hyderabad", "Banglore", "Kolkata", "Gujarat", "Kerala");
              for ($i = 0; $i < sizeof($city); $i++) {

                if ($a == $city[$i]) {  ?>
                 <option value=<?php echo "$city[$i]" ?> selected><?php echo "$city[$i]" ?></option>
               <?php } else {
                ?>
                 <option value=<?php echo "$city[$i]" ?>><?php echo "$city[$i]" ?></option>
             <?php
                }
              }
              ?>
           </select>
         </div>
         <div class="col-sm-2 col-sm-offset-2">
           <select class="fil" id=bhk name=bhk>
             <option value="">BHK</option>
             <option value="1 RK">1 RK</option>
             <option value="1 BHK">1 BHK</option>
             <option value="2 BHK">2 BHK</option>
             <option value="3 BHK">3 BHK</option>
             <option value="+3 BHK">+3 BHK</option>
           </select>
         </div>
         <div class="col-sm-2">
           <select class="fil" id=furn name=furn>
             <option value="">Furnished</option>
             <option value="Furnished">Furnished </option>
             <option value="Unfurnished">Unfurnished </option>
             <option value="Semi-furnished">Semi-furnished</option>
           </select>
         </div>
         <div class="col-sm-2">
           <select class="fil" id=rent name=rent>
             <option value="">Price</option>
             <option value="10000">Less than 10000</option>
             <option value="30000">Less than 30000</option>
             <option value="50000">Less than 50000</option>
             <option value="60000">More than 50000</option>
           </select>
         </div>

         <div class=col-sm-2>
           <button class="btn btn-primary fil" type="button" name=drop onclick="getdata()" style="color:black;">
             Filter
           </button>
         </div>
       </div>
       <br>
       <div id=show>
         <?php if (!(isset($_GET['drop']))) {
            $con = pg_connect("host=127.0.0.1 port=5432 user=postgres dbname=project password=postgres") or die("Error");
            $sql = "select * from property where status='accepted'";
            if ($a) {
              $sql .= " and p_city='$a';";
            }
            $result = pg_query($con, $sql) or die("incorrect");
          }
          ?>
         <br>
         <div class='row'>
           <?php
            if (pg_num_rows($result) > 0) {
              while ($row = pg_fetch_assoc($result)) {
                if (empty($row['t_name'])) {
            ?>
                 <div class="col-sm-4" style="padding:1rem;justify-content:center;">
                   <div class="card">
                     <div class="card-body">
                       <h5 class="card-title">
                         <?php echo $row['p_name']; ?></h5>
                       <b>Rent: <?php echo $row['p_rent']; ?>
                         <p class="card-text">Type: <?php echo $row['p_bhk']; ?><br>Furnished: <?php echo $row['p_furnish']; ?><br>City: <?php echo $row['p_city']; ?></p>
                       </b>
                       <a href="../Tenant/detail.php?pid=<?php echo $row['p_id']; ?>">
                         <button name="detail" class="mt-4 btn view">View</button>
                       </a>
                     </div>
                   </div>
                 </div>
           <?php
                }
              }
            } else {
              echo "No Data found";
            }
            ?>
         </div>
         <br>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   </body>

   </html>
 <?php } else {
    echo "<script>window.location.href='../Tenant/login.php';</script>";
  } ?>