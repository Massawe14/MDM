<?php

  include('authentication.php');
  include('config/dbconn.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <?php 
              include('message.php');
            ?>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                  $query = "SELECT id FROM device ORDER BY id";
                  $result = mysqli_query($conn, $query);

                  $row = mysqli_num_rows($result);
                  echo '<h3>'.$row.'</h3>';
                ?>
                <p>Total  Enrolled Devices</p>
              </div>
              <div class="icon">
                <i class="las la-mobile"></i>
              </div>
              <a href="device.php" class="small-box-footer">More info <i class="las la-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Message Notification</p>
              </div>
              <div class="icon">
                <i class="las la-sms"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="las la-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php 
                  $query = "SELECT id FROM user ORDER BY id";
                  $result = mysqli_query($conn, $query);

                  $row = mysqli_num_rows($result);
                  echo '<h3>'.$row.'</h3>';
                ?>
                <p>Users</p>
              </div>
              <div class="icon">
                <i class="las la-users"></i>
              </div>
              <a href="registered.php" class="small-box-footer">More info <i class="las la-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Logs</p>
              </div>
              <div class="icon">
                <i class="las la-file-alt"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="las la-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- Map content -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-0 text-dark">Devices Location</h2>
        </div>
      </div>
      <div id="map"></div>
      <script>
        function initMap(){
          var options = {
            zoom:8,
            center:{
              lat:-6.212470, 
              lng:35.810307
            }
          }

          var map = new google.maps.Map(document.getElementById('map'), options);
        }
      </script>
      <script async defer 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLra3FKhGBOPGhB1BcgTKlQV35j9Z1szk&callback=initMap">
      </script>
    </div>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>