<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Theme Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="http://localhost:8080/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- Bootstrap theme -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- datatable -->
    <link href="http://localhost:8080/plugins/DataTables/datatables.min.css" rel="stylesheet" type="text/css"> 

</head>
<body>
    <div class="container-fluid theme-showcase" role="main">
        <table class="table table-striped" id="table_sls_order">
            <thead>
                <th>No. PO Cust</th>
                <th>No. SO</th>
                <th>Tgl. Order</th>
                <th>Tgl. Dibutuhkan</th>
                <th>Customer</th>
                <th>Ket</th> 
                <th>Stat</th> 
                <th>Produk</th> 
                <th>Qty</th> 
                <th>Satuan</th> 
                <th>Harga Satuan</th> 
                <th>Ket. Detail</th> 
                <th>Aksi</th>
            </thead>
            <tbody>
            </tbody>
        </table>    
    </div> <!-- /container -->

    <script src="http://localhost:8080/js/jquery-3.3.1.min.js"></script>
    <script src="http://localhost:8080/js/bootstrap.min.js"></script>    
    <script src="http://localhost:8080/plugins/DataTables/datatables.min.js"></script>
    <script src="http://localhost:8080/js/sls_order.js"></script>    
</body>
</html>