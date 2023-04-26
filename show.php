<!DOCTYPE html>
<html>
<head>
	<title>NPS SURVEY</title>
	<!-- Add Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css"/>
</head>

<body class="p-4">

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

// fetch data from the database
$sql = "SELECT * FROM form_data";
$result = $conn->query($sql);

// build the data array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();
?>

<!-- HTML table with DataTables -->
<table id="npstable" class="display " style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>EMPCODE</th>
            <th>NPS NEED</th>
			<th>NPS ID</th>
			<th>DATE</th>
			
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["eccode"]; ?></td>
            <td><?php echo $row["q1"]; ?></td>
			<td><?php echo $row["npsid"]; ?></td>
			<td><?php echo $row["Time"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- JavaScript for DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script>
   
$(document).ready(function() {
  $('#npstable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});
</script>
</body>
</html>
