<html>
<style>
  .card.main {
    margin-top: 20px;
    margin-left: 30%;
    background-color: lightblue;
    width: 500px;
    height: 300px;
    padding-left: 20px;
  }

  .submit {
    width: 100px;
    height: 50px;
    margin-bottom: 10px;
    border-radius: 40px;
    margin-left: 30%;
    background-color: peru;
  }
</style>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <script type="text/javascript">
    function getdata() {
      var a = document.getElementById("month");
      var b = document.getElementById("year");
      var c = document.getElementById("opt");
      var con = a.value + "," + b.value + "," + c.value;
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
          document.getElementById("rep").innerHTML = xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET", "report.php?name=" + name, true);
      xmlhttp.send();
    }
  </script>
  <script>
    function opt(name) {
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
      xmlhttp.open("GET", "option.php?name=" + name, true);
      xmlhttp.send();
    }
  </script>
</head>

<body>
  <div class="card main">
    <h1 style="margin-left: 30%;">Report</h1><br>
    <h4>Get report :
      <select onchange="opt(this.value)" id=opt name="opt">
        <option selected value="M">Monthly</option>
        <option value="Y">Yearly</option>
        <option value="Q">Quartile</option>
      </select>
    </h4>
    <div id="show">
      <h4>Enter Month :
        <select name=month id="month">
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option selected value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </h4><br>
      <h4>Enter Year :
        <select name=year id=year>
          <option value='2021'>2021</option>
          <option value='2022'>2022</option>
          <option selected value='2023'>2023</option>
        </select>
      </h4><br>
    </div>
    <button class=submit onclick="getdata()">Submit</button>
  </div>
  <div id="rep">
  </div>

</body>

</html>