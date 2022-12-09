<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Weight Tracker </title>
</head>

<body>

    <?php

    // Server
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mysql";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute the query
    $sql = "SELECT date, weight, calories FROM weight_tracker";
    $result = $conn->query($sql);

    $data = "";

    // Fetch the result
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Append the data into array string like this:
            // Format: [date, weight, calories]
            // ['2018-01-01', 76.8, 1500], ['2018-01-02', 76.8, 2000], ...
            $data .= "['" . $row['date'] . "'," . $row['weight'] . "," . $row['calories'] . "],";
        }
    } else {
        echo "['9999-01-01', 0, 0]";
    }

    // Close connection
    $conn->close();
    ?>


    <div id="chart" style="width: 100%; height: 500px;"></div>

    <!-- Load the Google Chart Library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Display the Google Chart -->
    <script type="text/javascript">
        // Load basic library
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

        // Declare the draw function
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Weight', 'Calories'],
                <?php echo $data ?>
            ]);

            // Add additional options
            var options = {
                title: 'Weight vs Calories',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            // Create LineChart object
            var chart = new google.charts.Line(document.getElementById('chart'));

            // Start drawing
            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>

</body>

</html>