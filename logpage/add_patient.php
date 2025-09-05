<?php
 include 'inc/header.php';
?>
    <!-- Sidebar (Desktop) -->
    <nav id="sidebar" class="sidebar p-3 d-none d-lg-block">
        <h4 class="text-white">Dashboard</h4>
        <hr class="bg-secondary">
        <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-house"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people"></i> Users</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-bar-chart"></i> Analytics</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear"></i> Settings</a></li>
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
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-house"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-people"></i> Users</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-bar-chart"></i> Analytics</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#"><i class="bi bi-gear"></i> Settings</a></li>
          </ul>
        </div>
      </div>

      <!-- Main Content -->
    <div class="content p-4">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Add New Patient</h5>
            </div>
            <div class="card-body p-3">
                <form action="save_patient.php" method="POST">
                    <div class="row g-3">

                        <!-- Card No -->
                        <div class="col-lg-6">
                            <label class="form-label">Card No.</label>
                            <input type="text" class="form-control" placeholder="Enter card number" name="card_no" required>
                        </div>

                        <!-- Patient Name -->
                        <div class="col-lg-6">
                            <label class="form-label">Patient Name</label>
                            <input type="text" class="form-control" placeholder="Enter patient's full name" name="patient_name" required>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="2" placeholder="Enter address" name="address" required></textarea>
                        </div>

                        <!-- Age -->
                        <div class="col-lg-6">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" placeholder="Enter age" name="age" required>
                        </div>

                        <!-- Sex -->
                        <div class="col-lg-6">
                            <label class="form-label">Sex</label>
                            <select class="form-select" name="sex" required>
                                <option selected disabled>Choose...</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <!-- Ward -->
                        <div class="col-lg-6">
                            <label class="form-label">Ward</label>
                            <input type="text" class="form-control" placeholder="Enter ward" name="ward" required>
                        </div>

                        <!-- Bill -->
                        <div class="col-lg-6">
                            <label class="form-label">Bill (₦)</label>
                            <input type="number" class="form-control" placeholder="Enter bill amount" name="bill" required>
                        </div>

                        <!-- Date Admitted -->
                        <div class="col-lg-6">
                            <label class="form-label">Date Admitted</label>
                            <input type="date" class="form-control" name="date_admitted" required>
                        </div>

                        <!-- Treatment -->
                        <div class="col-12">
                            <label class="form-label">Treatment</label>
                            <textarea class="form-control" rows="3" placeholder="Enter treatment details" name="treatment" required></textarea>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-person-plus-fill me-2"></i> Add Patient
                        </button>
                    </div>
                </form>
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
  </script>
</body>
</html>
