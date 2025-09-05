<?php
 include 'inc/header.php';
?>
    <!-- Sidebar (Desktop) -->
    <nav id="sidebar" class="sidebar p-3 d-none d-lg-block">
        <h4 class="text-white">Dashboard</h4>
        <hr class="bg-secondary">
        <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="users.php"><i class="bi bi-people"></i> Users Management</a></li>
        <li class="nav-item"><a class="nav-link" href="patient.php"><i class="bi bi-bar-chart"></i> Patient Management</a></li>
        <li class="nav-item"><a class="nav-link active" href="activities.php"><i class="bi bi-gear"></i> Activities</a></li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div class="flex-grow-1">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <!-- Mobile Sidebar Button -->
            <button class="btn btn-outline-secondary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
            ☰
            </button>
            <a class="navbar-brand ms-3" href="dashboard.php">Clinic System</a>
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
        </nav>

      <!-- Mobile Sidebar (Offcanvas) -->
      <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasSidebar">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title">Dashboard</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="users.php"><i class="bi bi-people"></i> Users Management</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="patient.php"><i class="bi bi-bar-chart"></i> Patient Management</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="activities.php"><i class="bi bi-gear"></i> Activities</a></li>
          </ul>
        </div>
      </div>

      <!-- Main Content -->
    <div class="content p-4">
        <div class="card-body p-3">
            <div class="content p-4">
                <div class="card shadow-lg rounded-3 p-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">User Activities</h5>
                    </div>
                    <div class="card-body p-3">
                        <table id="activitiesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Activity</th>
                                    <th>Date/Time</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Username</th>
                                    <th>Activity</th>
                                    <th>Date/Time</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
  </div>

  

  <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            $('#activitiesTable').DataTable({
                ajax: {
                    url: "code/fetch_activities.php",
                    dataSrc: ""
                },
                columns: [
                    { data: "username" },
                    { data: "activity" },
                    { data: "activity_time" }
                ],
                order: [[2, "desc"]] // Sort by date/time (latest first)
            });
        });
    </script>


</body>
</html>
