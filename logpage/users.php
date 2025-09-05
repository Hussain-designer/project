<?php
 include 'inc/header.php';
?>
    <!-- Sidebar (Desktop) -->
    <nav id="sidebar" class="sidebar p-3 d-none d-lg-block">
        <h4 class="text-white">Dashboard</h4>
        <hr class="bg-secondary">
        <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="users.php"><i class="bi bi-people"></i> Users Management</a></li>
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
                    <h5 class="mb-0">Add User</h5> 
                </div>
                <div class="card-body p-3">
                    <form id="addUserForm">
                        <div class="row g-3">
                            <!-- Username -->
                            <div class="col-lg-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <!-- Position -->
                            <div class="col-lg-3">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" required>
                            </div>
                            <!-- Email -->
                            <div class="col-lg-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <!-- Password -->
                            <div class="col-lg-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-person-plus-fill me-2"></i> Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="content p-4">
            <div class="card shadow-lg rounded-3 p-4">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Users Table</h5>
                </div>
                <div class="card-body p-3">
                    <table id="usersTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    <div id="alertBox" class="alert d-none" role="alert"></div>
  </div>


  <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editUserForm">
        <div class="modal-header bg-secondary text-white">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editUserId">
          
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="editUsername" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" class="form-control" name="position" id="editPosition" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
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
        let table = $('#usersTable').DataTable({
            ajax: {
                url: "code/fetch_users.php",
                dataSrc: ""
            },
            columns: [
                { data: "username" },
                { data: "position" },
                { data: "email" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm editBtn" data-id="${row.id}">Edit</button>
                            <button class="btn btn-danger btn-sm deleteUserBtn" data-id="${row.id}">Delete</button>
                        `;
                    }
                }
            ]
        });

        // Add User
        $("#addUserForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "code/add_user.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response === "success") {
                        alert("User added successfully!");
                        $("#addUserForm")[0].reset();
                        table.ajax.reload(null, false); // refresh DataTable without page reload
                    } else {
                        alert("Failed to add user: " + response);
                    }
                }
            });
        });

        // Delete User
        $(document).on("click", ".deleteUserBtn", function () {
            let id = $(this).data("id");
            if (confirm("Are you sure you want to delete this user?")) {
                $.post("code/delete_user.php", { id: id }, function (response) {
                    if (response === "success") {
                        alert("User deleted successfully!");
                        table.ajax.reload(null, false);
                    } else {
                        alert("Failed to delete user.");
                    }
                });
            }
        });

        // Open Edit Modal
        $(document).on("click", ".editBtn", function () {
            let id = $(this).data("id");
            $.ajax({
                url: "code/get_user.php",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function (user) {
                    $("#editUserId").val(user.id);
                    $("#editUsername").val(user.username);
                    $("#editPosition").val(user.position);
                    $("#editEmail").val(user.email);
                    $("#editUserModal").modal("show");
                }
            });
        });

        // Save Updated User
        $("#editUserForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "code/update_user.php",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response === "success") {
                        $("#editUserModal").modal("hide");
                        table.ajax.reload(null, false);
                    } else {
                        alert("Failed to update user: " + response);
                    }
                }
            });
        });
    });
</script>
</body>
</html>
