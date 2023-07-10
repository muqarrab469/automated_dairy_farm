<?php require('conn.php'); ?>
<?php
$error = "";
$message = "";
if(isset($_REQUEST["addMedicalRecord"])){
  
  $id = $_REQUEST["id"];
  $condition = $_REQUEST["condition"];
  $treatment = $_REQUEST["treatment"];
  $sdate = $_REQUEST["start"];
  $edate = $_REQUEST["end"];

  $sql = "INSERT INTO medicalrecords (a_id, m_condition, treatment, s_date, e_date) 
                       VALUES ('$id', '$condition', '$treatment', '$sdate', '$edate')";
  if ($conn->query($sql) === TRUE) {
     $message = "Medical Record Added Successfully!";
  }
  else {
   $error = "Error In Adding Medical Record!";
   }
  }
?>

<!DOCTYPE html>
<html>
  <head>
<title>Medical Records-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="addanimalstyle.css">
  </head>
  <body>
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>
  <br>
  <h1 class="headings">Medical Records</h1>
  <div id="container1">
		<form action="medical.php" method="POST">
			<h2>Add medical record</h2>
		
    	    <input type="text" placeholder="Enter Animal ID" name="id" required/>
		    <input type="text" placeholder="Enter Condition" name="condition" required/>
            <input type="text" placeholder="Enter Treatment" name="treatment" required/>
			<input  pattern="\d{4}-\d{2}-\d{2}" placeholder="Enter Start Date YYYY-MM-DD"  name="start" required/>
			<input  pattern="\d{4}-\d{2}-\d{2}" placeholder="Enter End Date YYYY-MM-DD"  name="end" required/>
            <button name="addMedicalRecord">Add Record</button>
            <br>
			<span style='color:red'><?php echo $error ?></span>
            <span style='color:green'><?php echo $message ?></span>
		</form>
</div>
<br><br>
<h2 class="headings">Records</h2>
<br>
    <?php
    $error="";
    $sql1 = "SELECT a_id, m_condition, treatment,s_date,e_date,m_id FROM medicalrecords";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
    echo "<br><div style='background-color: lightgreen;width:40%;margin-left:20%' class=div1><h2>Medical ID: ".$row["m_id"]."</h2><br><h3>Animal ID: ".$row["a_id"]."</h3><br><h3>Condition: " .$row["m_condition"]."</h3>";
    echo "<form action='medical.php' method='POST'><input type='hidden' name='id_data' value='".$row['m_id']."'><button name='update'>Update</button><button name='delete'>Delete</button></div><br><br>";
  
  }
} else {
  $error="No Data currently available!";
}
    ?>
     
    <span style='background-color: red;margin-left:20%'><?php echo $error ?></span> 


<br>
</body>
</head>
</html>