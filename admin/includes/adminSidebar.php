<?php 
  require_once('socket/socket_client.php');
?>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin.php" class="brand-link">
      <img src="assets/dist/img/necta.png" alt="Necta Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MDM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="admin.php" class="nav-link active">
              <i class="nav-icon las la-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon las la-users"></i>
              <p>
                User Management
                <i class="right las la-caret-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adminadduser.php" class="nav-link">
                  <i class="las la-plus nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminUserinfo.php" class="nav-link">
                  <i class="las la-info-circle nav-icon"></i>
                  <p>User Info</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon las la-desktop"></i>
              <p>
                Device Management
                <i class="right las la-caret-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adminAddDevice.php" class="nav-link">
                  <i class="las la-plus nav-icon"></i>
                  <p>Add Device</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminDeviceInfo.php" class="nav-link">
                  <i class="las la-info-circle nav-icon"></i>
                  <p>Device Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminDeviceInfo.php" class="nav-link">
                  <i class="las la-map-marker-alt nav-icon"></i>
                  <p>Device Location</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon las la-clock"></i>
              <p>
                Session Management
                <i class="right las la-caret-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adminAddSession.php" class="nav-link">
                  <i class="las la-plus nav-icon"></i>
                  <p>Add Main Session</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminAddUserSession.php" class="nav-link">
                  <i class="las la-plus-square nav-icon"></i>
                  <p>Add User Session</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminMainSessionInfo.php" class="nav-link">
                  <i class="las la-info nav-icon"></i>
                  <p>Main Session Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adminUserSessionInfo.php" class="nav-link">
                  <i class="las la-info-circle nav-icon"></i>
                  <p>Users Session Info</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon las la-terminal"></i>
              <p>
                Commands
                <i class="las la-caret-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adminChangePassword.php" class="nav-link">
                  <i class="las la-key nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <!-- <a href="#" class="nav-link">
                  <i class="las la-undo-alt nav-icon"></i>
                  <p>Restart</p>
                </a> -->
                <button onclick="Restart();" type="button" class="nav-link btn warning">
                  <i class="las la-undo-alt nav-icon"></i> Restart
                </button>
              </li>
              <li class="nav-item">
                <!-- <a href="#" class="nav-link">
                  <i class="las la-power-off nav-icon"></i>
                  <p>Shutdown</p>
                </a> -->
                <button onclick="TurnOff();" type="button" class="nav-link btn danger">
                  <i class="las la-power-off nav-icon"></i> Shutdown
                </button>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon las la-folder-open"></i>
              <p>
                Logs
                <i class="las la-caret-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adminSessionLogs.php" class="nav-link">
                  <i class="las la-file-alt nav-icon"></i>
                  <p>Session Logs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">PROCESSING</li>
          <li class="nav-item">
            <a href="https://mdm-service.imperialinnovations.co.tz/processing/" class="nav-link">
              <i class="nav-icon las la-images"></i>
              <p>
                Image Processing
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    function Restart() {
      var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-all", message: {command: "RESTART"}}});
      window.dispatchEvent(event);
    }
  </script>

  <script>
    function TurnOff() {
      var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-all", message: {command: "TURN_OFF"}}});
      window.dispatchEvent(event);
    }
  </script>