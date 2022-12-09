<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight Tracker</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h1>Weight Tracker</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <!-- Proper table with header and body for DataTable -->
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Weight</th>
                                <th>Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- This section will be replaced with DataTable -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            
            // Initiate DataTable
            $('.table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "data.php",
                    "dataType": "json",
                    "type": "POST"
                },
                "columns":[
                    {"data": "date"},
                    {"data": "weight"},
                    {"data": "calories"}
                ]
            });

        });
    </script>
</body>

</html>