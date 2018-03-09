<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản lí điểm danh - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   <link href="../application/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="../application/assets/css/style.css" rel="stylesheet" type="text/css" />
   <link href="../application/assets/css/sidebar.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../application/assets/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../application/assets/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view($header); ?>
    <!-- Navbar -->
    <div class="wrapper">
            <!-- Sidebar -->
            <?php $this->load->view($sidebar); ?>
            <!-- Sidebar -->
            <!-- Page Content -->
            <div id="content">

            
            </div>
            <!-- Page Content -->
    </div>
</body>
        <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
</html>