<?php
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_no = trim($_POST['card_no']);
    $patient_name = trim($_POST['patient_name']);
    $address = trim($_POST['address']);
    $age = intval($_POST['age']);
    $sex = $_POST['sex'];
    $ward = trim($_POST['ward']);
    $bill = floatval($_POST['bill']);
    $date_admitted = $_POST['date_admitted'];
    $treatment = trim($_POST['treatment']);

    $check = $conn->prepare("SELECT * FROM patients WHERE card_no = ?");
    $check->bind_param("s", $card_no);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                document.body.innerHTML = '<p style=\"color:red; font-size:18px; text-align:center;\">Card number already exists! Redirecting...</p>';
                setTimeout(function(){ window.location.href='index.html'; }, 2000);
              </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO patients (card_no, patient_name, address, age, sex, ward, bill, date_admitted, treatment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissdss", $card_no, $patient_name, $address, $age, $sex, $ward, $bill, $date_admitted, $treatment);

        if ($stmt->execute()) {
            echo "<script>
                    document.body.innerHTML = '<p style=\"color:green; font-size:18px; text-align:center;\">Patient added successfully! Redirecting...</p>';
                    setTimeout(function(){ window.location.href='patients_list.php'; }, 2000);
                  </script>";
        } else {
            echo "<script>
                    document.body.innerHTML = '<p style=\"color:red; font-size:18px; text-align:center;\">Error saving record! Redirecting...</p>';
                    setTimeout(function(){ window.location.href='index.html'; }, 2000);
                  </script>";
        }
    }
}
?>
