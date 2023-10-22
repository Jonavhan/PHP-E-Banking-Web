<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];

$targetDirectory = "C:/xampp/htdocs/InternetBanking-PHP/admin/uploads/";

//register new account
if (isset($_POST['create_staff_account'])) {
    // Register Client
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_number = $_POST['client_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = sha1(md5($_POST['password']));
    $address  = $_POST['address'];

    $profile_pic  = $_FILES["profile_pic"]["name"];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "dist/img/" . $_FILES["profile_pic"]["name"]);

    // Insert Captured information into the database table
    $query = "INSERT INTO ib_clients (name, national_id, client_number, phone, email, password, address, profile_pic) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    // Bind parameters
    $rc = $stmt->bind_param('ssssssss', $name, $national_id, $client_number, $phone, $email, $password, $address, $profile_pic);
    $stmt->execute();

    // Declare a variable which will be passed to the alert function
    if ($stmt) {
        $success = "Client Account Created";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

if (isset($_POST['import_data'])) {
    // Handle file upload and database update here
    $importFile = $_FILES['import_file']['tmp_name'];

    // Database connection
    $hostname = "localhost"; // Change to your DB host if different
    $username = "root"; // Change to your DB username if different
    $password = ""; // Change to your DB password if different
    $dbname = "internetbanking"; // Change to your DB name if different

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        require 'vendor/autoload.php'; // Include the Composer autoloader
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($importFile);
        $worksheet = $spreadsheet->getActiveSheet();
    
        // Assuming the first row in Excel contains column names, adjust the starting row accordingly
        $startingRow = 2;
    
        for ($row = $startingRow; $row <= $worksheet->getHighestRow(); $row++) {
            $name = $worksheet->getCell('A' . $row)->getValue();
            $national_id = $worksheet->getCell('B' . $row)->getValue();
            $phone = $worksheet->getCell('C' . $row)->getValue();
            $address = $worksheet->getCell('D' . $row)->getValue();
            $email = $worksheet->getCell('E' . $row)->getValue();
            $password = sha1(md5($worksheet->getCell('F' . $row)->getValue()));
            $client_number = $worksheet->getCell('G' . $row)->getValue(); // Assuming client_number is in column G
        
            $query = "INSERT INTO ib_clients (name, national_id, phone, address, email, password, client_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssss', $name, $national_id, $phone, $address, $email, $password, $client_number);
            $stmt->execute();
        }
    
        $success = "Data Imported Successfully";
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        $err = "Error reading the Excel file: " . $e->getMessage();
    } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        $err = "Error loading the Excel file: " . $e->getMessage();
    } finally {
        $conn->close();
    }
}

?>


<!DOCTYPE html>
<html><!-- Log on to codeastro.com for more projects! -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("dist/_partials/nav.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("dist/_partials/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2"><!-- Log on to codeastro.com for more projects! -->
                        <div class="col-sm-6">
                            <h1>Create Client Account</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="pages_add_client.php">iBanking Clients</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-purple">
                                <div class="card-header">
                                    <h3 class="card-title">Fill All Fields</h3>
                                </div>
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputEmail1">Client Name</label>
                                                <input type="text" name="name" required class="form-control" id="exampleInputEmail1">
                                            </div>
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputPassword1">Client Number</label>
                                                <?php
                                                //PHP function to generate random passenger number
                                                $length = 4;
                                                $_Number =  substr(str_shuffle('0123456789'), 1, $length);
                                                ?>
                                                <input type="text" readonly name="client_number" value="iBank-CLIENT-<?php echo $_Number; ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputEmail1">Contact</label>
                                                <input type="text" name="phone" required class="form-control" id="exampleInputEmail1">
                                            </div>
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputPassword1">National ID No.</label>
                                                <input type="text" name="national_id" required class="form-control" id="exampleInputEmail1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" name="email" required class="form-control" id="exampleInputEmail1">
                                            </div>
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password" required class="form-control" id="exampleInputEmail1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col-md-6 form-group">
                                                <label for="exampleInputEmail1">Address</label>
                                                <input type="text" name="address" required class="form-control" id="exampleInputEmail1">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="exampleInputFile">Client Profile Picture</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="profile_pic" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="">Upload</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" name="create_staff_account" class="btn btn-success">Add Client</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div><!-- /.container-fluid -->
            </section>
            <!-- Second content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-purple">
                                <div class="card-header">
                                    <h3 class="card-title">Import Excel</h3>
                                </div>
                                <!-- form start -->
                                <form method="post" enctype="multipart/form-data" role="form">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Import Data from Excel</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="import_file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose Excel file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" name="import_data" class="btn btn-primary">Import Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <?php include("dist/_partials/footer.php"); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>