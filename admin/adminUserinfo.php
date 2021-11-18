<?php

  include('authentication.php');
  
  include('includes/header.php');
  include('includes/adminTopbar.php');
  include('includes/adminSidebar.php');
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
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Registered Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- User Modal -->
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="admincode.php" method="POST" enctype="multipart/form-data">
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
            <div class="form-group">
              <label for=""> UserName </label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
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
            <div class="form-group">
              <label for=""> Image </label>
              <input type="file" class="form-control" name="image" id="image" placeholder="Image" required/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="adduser" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
    </div>

    <!-- Delete User -->
    <div class="modal fade" id="DeleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="adminCode.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_user" class="delete_user_id">
              <p>
                Are you sure. you want to delete this data ?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="DeleteUserbtn" class="btn btn-danger">Yes, Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete User -->  
  
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
                <h3 class="card-title">Registered User</h3>
                <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Image</th>
                      <!-- <th>Password_hash</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query = "SELECT * FROM users";
                      $result = mysqli_query($conn, $query); 

                      if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                          ?>
                            <tr>
                              <td><?php  echo $row['sn']; ?></td>
                              <td><?php  echo $row['first_name']; ?></td>
                              <td><?php  echo $row['last_name']; ?></td>
                              <td><?php  echo $row['username']; ?></td>
                              <td><?php  echo $row['email']; ?></td>
                              <td>
                                <img src="<?php echo "uploads/images/".$row['image']; ?>" width="100px" alt="image">
                              </td>
                              <!-- <td><?php  echo $row['password_hash']; ?></td> -->
                              <td>
                                <a href="adminEditUser.php?sn=<?php echo $row['sn']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <button type="button" value="<?php echo $row['sn']; ?>" class="btn btn-danger btn-sm deleteuserbtn">Delete</button>
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

    $('.user_email').keyup(function (e) {
      var useremail = $('.user_email').val();

      $.ajax({
        type: "POST",
        url: "adminCode.php",
        data: {
          'check_Emailbtn':1,
          'email':useremail,
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

    $('.deleteuserbtn').click(function (e) {
      e.preventDefault();
      var user_id = $(this).val();
      $('.delete_user_id').val(user_id);
      $('#DeleteUserModal').modal('show');
    });

  });
</script>

<?php include('includes/footer.php'); ?>