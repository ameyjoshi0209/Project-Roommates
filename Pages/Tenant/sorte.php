<?php
$con=pg_connect("host=127.0.0.1 port=5432 user=postgres dbname=project password=postgres") or die("Error");
$c=$_GET['name'];

$data=explode(",",$c);
    $len=sizeof($data);
    $sql="select * from property where status='accepted'";
for($i=0;$i<$len;$i++){
    
    if(($data[$i]=="Pune")||($data[$i] =="Mumbai")||($data[$i]=="Delhi")||($data[$i]=="Hyderabad")||($data[$i]=="Bangalore")||($data[$i]=="Kolkata")||($data[$i]=="Gujarat")||($data[$i]=="Kerala")){
        $sql.=" AND p_city='$data[$i]'";
    }
    else if(($data[$i]=="1 RK")||($data[$i]=="1 BHK")||($data[$i]=="2 BHK")||($data[$i]=="3 BHK")){
        $sql.=" AND p_bhk='$data[$i]'";
    }
    else if($data[$i]=="+3 BHK"){
        $sql.=" AND p_bhk>'$data[$i]'";
    }
    else if(($data[$i]=="Furnished")||($data[$i]=="Unfurnished")||($data[$i]=="Semi-furnished")||($data[$i]=="3 BHK")){
        $sql.=" AND p_furnish ='$data[$i]'";
    }
    else if(($data[$i]=="10000")||($data[$i]=="30000")||($data[$i]=="50000")){
        $sql.=" AND p_rent < $data[$i]";
    }
    else if($data[$i]=="60000"){
        $sql.=" AND p_rent > $data[$i]";
    }
    else if($data[$i] ==" "){
        $sql.=" ";
    }
}

$result=pg_query($con,$sql) or die("incorrect");
?><br>
<div class='row'>
<?php
if(pg_num_rows($result) > 0)
{
    while($row = pg_fetch_assoc($result))
    {
    ?>
    <div class="col-sm-4" style="padding:1rem;">
    	<div class="card" style="opacity: 0.5;background-color: black;height: 13.8em; color: black;">
    		<div class="card-body">
    			<h5 class="card-title">
    				<?php echo $row['name']; ?></h5>
    			<i>Address:<?php echo $row['p_addr']; ?></i><br>
    			<b>Rent:<?php echo $row['p_rent']; ?>
    				<p class="card-text">Type:<?php echo $row['p_bhk']; ?><br>Furnished:<?php echo $row['p_furnish']; ?><br>Address:<?php echo $row['p_addr']; ?></p>
    			</b>
    		</div>
    	</div>
    </div>
    <?php
    }
}
else{
    echo "<h3 style='justify-content:center;'>Property Not Found</h3>";
}

?>
</div>