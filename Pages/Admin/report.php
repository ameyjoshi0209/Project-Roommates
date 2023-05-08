<?php
//echo "hello";
$c = $_GET['name'];
//echo $c;
$data = explode(",", $c);
//echo "$data Month=$data[0]  Year=$data[1]  opt=$data[2]";
$dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
$property = "select * from property";
$tenant = "select * from logindata";
$owner = "select * from owner_login";
if ($data[2] == "Y") {
  $tenant .= " where reg_time between '" . $data[1] . "-01-01 12:0:0' and '" . ($data[1] + 1) . "-01-01 12:0:0'";
  $owner .= " where reg_time between '" . $data[1] . "-01-01 12:0:0' and '" . ($data[1] + 1) . "-01-01 12:0:0'";
  $property .= " where p_reg_time between '" . $data[1] . "-01-01 12:0:0' and '" . ($data[1] + 1) . "-01-01 12:0:0'";
  //echo $property;
  //echo $tenant;

} else if ($data[2] == "M") {
  $tenant .= " where reg_time between '" . $data[1] . "-" . $data[0] . "-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  $owner .= " where reg_time between '" . $data[1] . "-" . $data[0] . "-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  $property .= " where p_reg_time between '" . $data[1] . "-" . $data[0] . "-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  //echo $property;
  //echo $tenant;
} else if ($data[2] == "Q") {
  if ($data[0] == "4") {
    $property .= " where p_reg_time between '" . ($data[1]) . "-1-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
    //echo $property;
  } else if ($data[0] == "3") {
    $property .= " where p_reg_time between '" . ($data[1] - 1) . "-12-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  } else if ($data[0] == "2") {
    $property .= " where p_reg_time between '" . ($data[1] - 1) . "-11-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  } else if ($data[0] == "1") {
    $property .= " where p_reg_time between '" . ($data[1] - 1) . "-10-01 12:0:0' and '" . $data[1] . "-" . ($data[0] + 1) . "-01 12:0:0'";
  } else {
    $property .= " where p_reg_time between '" . $data[1] . "-" . ($data[0] - 4) . "-01 12:0:0' and '" . $data[1] . "-" . $data[0] . "-01 12:0:0'";
  }
}

?>
<br>

<head>
  <style>
    #dt {
      width: 900px;
    }
  </style>
</head>
<div class="col-sm-9 card sc" style="width:1350px;margin-left:37px">
  <h3>Property Overview</h3>
  <div class="user-table">
    <table id="dt" class="table table-striped table-bordered table-sm" cellspacing="0">
      <thead>
        <tr>
          <th class="th-sm">Property_id
          </th>
          <th class="th-sm">Name
          </th>
          <th class="th-sm">Username
          </th>
          <th class="th-sm">Gender
          </th>
          <th class="th-sm">Address
          </th>
          <th class="th-sm">City
          </th>
          <th class="th-sm">BHK Type
          </th>
          <th class="th-sm">Age
          </th>
          <th class="th-sm">Property Type
          </th>
          <th class="th-sm">Status
          </th>
          <th class="th-sm">Rent
          </th>
          <th class="th-sm">Furnished
          </th>
          <th class="th-sm">About
          </th>
          <th class="th-sm">Rules
          </th>
          <th class="th-sm">Image</th>
          <th class="th-sm">Deposit
          </th>
          <th class="th-sm">Rent Status
          </th>
          <th class="th-sm">Register date
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dbconn = pg_connect("host=localhost port=5432 dbname=project user=postgres password=postgres");
        $records = pg_query($dbconn, $property) or die("Q fail");
        while ($data = pg_fetch_array($records)) {
        ?>
          <tr>
            <td><?php echo $data['p_id']; ?></td>
            <td><?php echo $data['p_name']; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['gender']; ?></td>
            <td><?php echo $data['p_addr']; ?></td>
            <td><?php echo $data['p_city']; ?></td>
            <td><?php echo $data['p_bhk']; ?></td>
            <td><?php echo $data['p_age']; ?></td>
            <td><?php echo $data['p_type']; ?></td>
            <?php
            if ($data['status'] == "accepted") {
              echo "<td><button style='background-color:#2EFF2E;border-radius:8px;'>$data[status]</button></td>";
            }
            if ($data['status'] == "pending") {
              echo "<td><button style='background-color:#FFFF00;border-radius:8px;'>$data[status]</button></td>";
            }
            ?>
            <td><?php echo $data['p_rent']; ?></td>
            <td><?php echo $data['p_furnish']; ?></td>
            <td><?php echo $data['p_about']; ?></td>
            <td><?php echo $data['p_rules']; ?></td>
            <td><?php echo $data['image']; ?></td>
            <td><?php echo $data['p_deposit']; ?></td>
            <td><?php echo $data['rented_status']; ?></td>
            <td><?php echo $data['p_reg_time']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="row ut">
    <div class="col-sm-9 card sc" style="margin-left: 60px;">
      <h3>USER OVERVIEW</h3>
      <div class="user-table">
        <table id="dt" class="table table-striped table-bordered table-sm" cellspacing="0">
          <thead>
            <tr>
              <th class="th-sm">Login_id
              </th>
              <th class="th-sm">Name
              </th>
              <th class="th-sm">Gender
              </th>
              <th class="th-sm">Date of Birth
              </th>
              <th class="th-sm">Phone No.
              </th>
              <th class="th-sm">Email
              </th>
              <th class="th-sm">Username
              </th>
              <th class="th-sm">Password
              </th>
              <th class="th-sm">Status
              </th>
              <th class="th-sm">Image
              </th>
              <th class="th-sm">Register date
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $records = pg_query($dbconn, $owner);
            while ($data = pg_fetch_array($records)) {
            ?>
              <tr>
                <td><?php echo $data['login_id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo $data['dob']; ?></td>
                <td><?php echo $data['ph_no']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <?php
                if ($data['status'] == "accepted") {
                  echo "<td><button style='background-color:#00FF00;border-radius:8px;'>$data[status]</button></td>";
                }
                if ($data['status'] == "pending") {
                  echo "<td><button style='background-color:#FFFF00;border-radius:8px;'>$data[status]</button></td>";
                }
                ?>
                <td><?php echo $data['image']; ?></td>
                <td><?php echo $data['reg_time']; ?></td>
              </tr>
            <?php
            }
            $records = pg_query($dbconn, $tenant);
            while ($data = pg_fetch_array($records)) {
            ?>
              <tr>
                <td><?php echo $data['login_id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo $data['dob']; ?></td>
                <td><?php echo $data['ph_no']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <?php
                if ($data['status'] == "accepted") {
                  echo "<td><button style='background-color:#00FF00;border-radius:8px;'>$data[status]</button></td>";
                }
                if ($data['status'] == "pending") {
                  echo "<td><button style='background-color:#FFFF00;border-radius:8px;'>$data[status]</button></td>";
                }
                ?>
                <td><?php echo $data['image']; ?></td>
                <td><?php echo $data['reg_time']; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>