<?php

// Server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// List the table column
$columns = array(
    0 => 'date',
    1 => 'weight',
    2 => 'calories'
);

// Get the total data
$queryCount = $conn->query("SELECT count(*) as numrows FROM weight_tracker");
$dataCount = $queryCount->fetch_array();
$totalData = $dataCount['numrows'];
$totalFiltered = $totalData;

$limit = $_POST['length'];   // Set the data limit
$start = $_POST['start'];    // Set the data start in paging
$order = $columns[$_POST['order']['0']['column']];  // Set the ORDER BY column
$dir = $_POST['order']['0']['dir']; // Set the direction of ORDER BY --> ASC or DESC

// If the search input is empty
if(empty($_POST['search']['value']))
{
    $result = $conn->query("SELECT date, weight, calories
                            FROM weight_tracker
                            ORDER BY $order $dir
                            LIMIT $limit
                            OFFSET $start");
}
else
{
    $search = $_POST['search']['value'];
    $result = $conn->query("SELECT date, weight, calories
                            FROM weight_tracker
                            WHERE date like '%$search%'
                            OR weight like '%$search%'
                            OR calories like '%$search%'
                            ORDER BY $order $dir
                            LIMIT $limit
                            OFFSET $start");
    
    // Get the total rows
    $queryCount = $conn->query("SELECT count(*) AS numrows
                                FROM weight_tracker
                                WHERE date like '%$search%'
                                OR weight like '%$search%'
                                OR calories like '%$search%'
                                ORDER BY $order $dir
                                LIMIT $limit
                                OFFSET $start");
    $dataCount = $queryCount->fetch_array();
    $totalFiltered = $dataCount['numrows'];
}

// Put the data result into array
$data = array();
if(!empty($result))
{
    while ($row = $result->fetch_assoc()) {
        $nestedData['date'] = $row['date'];
        $nestedData['weight'] = $row['weight'];
        $nestedData['calories'] = $row['calories'];

        // Append the nested data into data
        $data[] = $nestedData;
    }
}

// Prepare json_data
$json_data = array(
    "draw"            => intval($_POST['draw']),  
    "recordsTotal"    => intval($totalData),  
    "recordsFiltered" => intval($totalFiltered), 
    "data"            => $data  
);

// Return the result
echo json_encode($json_data);

?>