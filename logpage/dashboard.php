<?php
 include 'inc/header.php';
?>
    <!-- Sidebar (Desktop) -->
    <nav id="sidebar" class="sidebar p-3 d-none d-lg-block">
        <h4 class="text-white">Dashboard</h4>
        <hr class="bg-secondary">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="users.php"><i class="bi bi-people"></i> Users Management</a></li>
            <li class="nav-item"><a class="nav-link" href="patient.php"><i class="bi bi-bar-chart"></i> Patient Management</a></li>
            <li class="nav-item"><a class="nav-link" href="activities.php"><i class="bi bi-gear"></i> Activities</a></li>
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
            <div class="ms-auto">
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
        <h2>Welcome Sir</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4 border-start border-primary border-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Patients</h5>
                    <h2 id="totalPatients">200</h2>
                    <p class="text-muted">All registered patients</p>
                </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mb-4 border-start border-success border-4">
                <div class="card-body">
                    <h5 class="card-title text-success">Today's Admissions</h5>
                    <h2 id="todayAdmissions">86</h2>
                    <p class="text-muted">New patients today</p>
                </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mb-4 border-start border-warning border-4">
                <div class="card-body">
                    <h5 class="card-title text-warning">Active Staff</h5>
                    <h2 id="activeStaff">30</h2>
                    <p class="text-muted">Currently logged in</p>
                </div>
                </div>
            </div>
        </div>


        <div class="card shadow-lg rounded-3 mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Activities</h5>
                <a href="activities.php" class="btn btn-light btn-sm">See More</a>
            </div>
            <div class="card-body p-3">
                <ul id="recentActivities" class="list-group list-group-flush">
                </ul>
            </div>
        </div>


        <div class="card shadow-lg rounded-3 mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Patients</h5>
                <a href="patients.php" class="btn btn-light btn-sm">See More</a>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-striped table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Card No.</th>
                                <th>Patient Name</th>
                                <th>Ward</th>
                                <th>Date Admitted</th>
                            </tr>
                        </thead>
                        <tbody id="recentPatients">
                            <!-- Recent patients will load here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.3.3/js/dataTables.bootstrap5.js"></script>

  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });

   $.ajax({
        url: "code/fetch_recent_activities.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            if (data.error) {
                $("#recentActivities").html("<li class='list-group-item text-danger'>" + data.error + "</li>");
                return;
            }

            let list = "";
            if (data.length > 0) {
                data.forEach(function(act) {
                    list += `<li class="list-group-item">
                                <strong>${act.username}</strong> - ${act.activity}
                                <span class="text-muted float-end">${act.activity_time}</span>
                            </li>`;
                });
            } else {
                list = `<li class="list-group-item text-center">No recent activities</li>`;
            }
            $("#recentActivities").html(list);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            console.log(xhr.responseText);
            $("#recentActivities").html("<li class='list-group-item text-danger'>Failed to load activities</li>");
        }
    });



    $.ajax({
        url: "code/fetch_recent_patients.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            if (data.error) {
                $("#recentPatients").html(
                    `<tr><td colspan="4" class="text-danger text-center">${data.error}</td></tr>`
                );
                return;
            }

            let rows = "";
            if (data.length > 0) {
                data.forEach(function(p) {
                    rows += `<tr>
                                <td>${p.card_no}</td>
                                <td>${p.patient_name}</td>
                                <td>${p.ward}</td>
                                <td>${p.date_admitted}</td>
                            </tr>`;
                });
            } else {
                rows = `<tr><td colspan="4" class="text-center">No recent patients</td></tr>`;
            }
            $("#recentPatients").html(rows);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            console.log(xhr.responseText);
            $("#recentPatients").html(
                `<tr><td colspan="4" class="text-danger text-center">Failed to load patients</td></tr>`
            );
        }
    });




  </script>
</body>
</html>
