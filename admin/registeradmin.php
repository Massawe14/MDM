<?php

  include('authentication.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('config/dbconn.php');
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
              <li class="breadcrumb-item active">Registered Admins</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- User Modal -->
    <div class="modal fade" id="AddAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="code.php" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""> Last Name </label>
                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""> UserName </label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
                </div>
              </div>
              <div class="col-md-6">
                <label>Select Role</label>
                <?php 
                  $query = "SELECT * FROM `groups`";
                  $result = mysqli_query($conn, $query);

                  if (mysqli_num_rows($result) > 0) {
                    ?>
                      <select name="role_as" class="form-control">
                        <?php foreach ($result as $row) { ?>
                          <option value="<?= $row['group_name']; ?>"><?= $row['group_name']; ?></option>
                        <?php } ?>
                      </select>
                    <?php
                  }  
                ?>
              </div>
            </div>
            <div class="form-group">
              <label for=""> Email </label>
              <span class="email_error text-danger ml-2"></span>
              <input type="email" class="form-control email_id" name="email" id="email" placeholder="Email"required/>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""> Password </label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for=""> Confirm Password </label>
                  <input type="password" class="form-control" name="confirmpassword" id="password" placeholder="Confirm Password" required />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addAdmin" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
    </div>

    <!-- Delete Admin -->
    <div class="modal fade" id="DeleteAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="code.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_admin" class="delete_admin_id">
              <p>
                Are you sure. you want to delete this data ?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="DeleteAdminbtn" class="btn btn-danger">Yes, Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Admin -->  
  
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php  
              if (isset($_SESSION['status'])) {
                echo "<h4>".$_SESSION['status']."</h4>";
                unset($_SESSION['status']);
              }
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registered Admin</h3>
                <a href="#" data-toggle="modal" data-target="#AddAdminModal" class="btn btn-primary btn-sm float-right">Add Admin</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th>
                      <!-- <th>Password</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query = "SELECT * FROM admin";
                      $result = mysqli_query($conn, $query); 

                      if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                          ?>
                            <tr>
                              <td><?php  echo $row['id']; ?></td>
                              <td><?php  echo $row['fname']; ?></td>
                              <td><?php  echo $row['lname']; ?></td>
                              <td><?php  echo $row['username']; ?></td>
                              <td><?php  echo $row['email']; ?></td>
                              <td><?php echo $row['role_as']; ?></td>
                              <!-- <td><?php  echo $row['password']; ?></td> -->
                              <td>
                                <a href="editAdmin.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteadminbtn">Delete</button>
                              </td>
                            </tr>
                          <?php
                        }
                      }
                      else{
                        ?>
                          <tr>
                            <td>No Record Found</td>
                          </tr>
                        <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include('includes/script.php'); ?>

<script>
  $(document).ready(function() {

    $('.admin_email').keyup(function (e) {
      var adminemail = $('.admin_email').val();

      $.ajax({
        type: "POST",
        url: "code.php",
        data: {
          'check_Emailbtn':1,
          'email':adminemail,
        },
        success: function (response) {
          $('.email_error').text(response);
        }
      });

    });

  });
</script>

<script>
  $(document).ready(function () {

    $('.deleteadminbtn').click(function (e) {
      e.preventDefault();
      var admin_id = $(this).val();
      // console.log(id);
      $('.delete_admin_id').val(admin_id);
      $('#DeleteAdminModal').modal('show');
    });

  });
</script>

<?php include('includes/footer.php'); ?>