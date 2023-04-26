<!DOCTYPE html>
<html>
<head>
	<title>NPS SURVEY</title>
	<!-- Add Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
	
</head>
	<style>
	.form-group.required :after {
      content:"*";
      color:red;
       }
   </style>

<body>
	<h1 class="text-center p-4">SURVEY NPS !</h1>
<?php
// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the form data
    $name = $_POST["name"];
    $eccode = $_POST["eccode"];
    $q1 = $_POST["q1"];
	$npsid = $_POST["npsid"];

    // create table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS form_data (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        eccode VARCHAR(30) NOT NULL,
        q1 VARCHAR(3) NOT NULL,
		npsid VARCHAR(30) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        // insert data into the database
        $sql = "INSERT INTO form_data (name, eccode, q1,npsid) VALUES ('$name', '$eccode', '$q1','$npsid')";

        if ($conn->query($sql) === TRUE) {
            // display success message and redirect to homepage
            echo "<script>alert('Data submitted successfully.');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

$conn->close();
?>
<!-- HTML form with Bootstrap styling -->
  <div class="container mt-5 p-4 px-2 border rounded border-primary col-6 section-1-container section-container card-view">
 <div class="container">
  <div class="row">
<form method="POST" class="row g-3">
    <div class="form-group required">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required="required">
    </div>
    <div class="form-group required">
        <label for="eccode">Employee Code:</label>
        <input type="text" class="form-control" id="eccode" name="eccode" required="required">
    </div>
    <div class="form-group">
        <label for="q1">PRAN (Permanent Retirement Account No - For existing user?</label><br>
        <div class="form-check form-check-inline mt-1">
            <input class="form-check-input" type="radio" name="q1" id="yes" value="YES">
            <label class="form-check-label" for="yes">YES</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="q1" id="no" value="NO">
            <label class="form-check-label" for="no">NO</label>
        </div>
    </div>
	<div  id="q1_answer_div" class="form-group" style="display: none" >
        <label for="npsdetail">NPS ID:</label>
        <input type="text" class="form-control" id="npsid" name="npsid">
    </div>
	
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
</form>
	  
	</div>
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script>
	$('input[name="q1"]').change(function(){
    if($(this).val() == 'YES') {
        $('#q1_answer_div').show();
    } else if ($(this).val() == 'NO') {
        $('#q1_answer_div').hide();
    }
});
</script>
	
</body>
</html>