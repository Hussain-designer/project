$(document).ready(function () {
    // Load patients data
    function loadPatients() {
        $.ajax({
            url: "code/fetch_patients.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let rows = "";
                data.forEach(function (patient) {
                    rows += `
                        <tr>
                            <td>${patient.card_no}</td>
                            <td>${patient.patient_name}</td>
                            <td>${patient.age}</td>
                            <td>${patient.sex}</td>
                            <td>${patient.ward}</td>
                            <td>₦${patient.bill}</td>
                            <td>${patient.date_admitted}</td>
                            <td>
                                <button class="btn btn-info btn-sm viewBtn" data-id="${patient.id}">View</button>
                                <button class="btn btn-danger btn-sm deleteBtn" data-id="${patient.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $("#patientsTable tbody").html(rows);
            }
        });
    }

    loadPatients();

    // Delete patient
    $(document).on("click", ".deleteBtn", function () {
        let id = $(this).data("id");
        if (confirm("Are you sure you want to delete this patient?")) {
            $.post("delete_patient.php", { id: id }, function (response) {
                if (response === "success") {
                    alert("Patient deleted successfully!");
                    loadPatients();
                } else {
                    alert("Failed to delete patient.");
                }
            });
        }
    });

   
    $(document).on("click", ".viewBtn", function () {
        let id = $(this).data("id");
        alert("Here you can load patient details in a modal. (ID: " + id + ")");
    });
});
