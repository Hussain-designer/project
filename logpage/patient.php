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
        <li class="nav-item"><a class="nav-link active" href="patient.php"><i class="bi bi-bar-chart"></i> Patient Management</a></li>
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
        <div class="card shadow-lg rounded-3 p-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Patient Table</h5>
                <a href="add_patient.php" class="btn btn-success btn-sm">
                    <i class="bi bi-person-plus-fill me-1"></i> Add Patient
                </a>
            </div>
            <div class="card-body p-3">
                <table id="patientsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Card No.</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Ward</th>
                            <th>Bill (₦)</th>
                            <th>Date Admitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Card No.</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Ward</th>
                        <th>Bill (₦)</th>
                        <th>Date Admitted</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                </table>
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
        // Initialize DataTable with AJAX
        let table = $('#patientsTable').DataTable({
            ajax: {
                url: "code/fetch_patients.php",
                dataSrc: "" // because PHP returns a plain JSON array
            },
            columns: [
                { data: "card_no" },
                { data: "patient_name" },
                { data: "age" },
                { data: "sex" },
                { data: "ward" },
                { 
                    data: "bill",
                    render: function (data) {
                        return "₦" + data;
                    }
                },
                { data: "date_admitted" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="${row.id}">Delete</button>
                        `;
                    }
                }
            ]
        });

        // Delete patient
        $(document).on("click", ".deleteBtn", function () {
            let id = $(this).data("id");
            if (confirm("Are you sure you want to delete this patient?")) {
                $.post("code/delete_patient.php", { id: id }, function (response) {
                    if (response === "success") {
                        alert("Patient deleted successfully!");
                        table.ajax.reload(null, false); // 🔥 refresh without resetting page
                    } else {
                        alert("Failed to delete patient.");
                    }
                });
            }
        });

        // View patient
        $(document).on("click", ".viewBtn", function () {
            let id = $(this).data("id");
            alert("Here you can load patient details in a modal. (ID: " + id + ")");
        });
    });
</script>

</body>
</html>
