<?php
// Database connection settings
$host = 'localhost:3306';  // Database host
$username = 'root';   // Database username
$password = '';       // Database password
$database = 'hospital_management';  // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get role from the form
    $role = $_POST['role'];

    // Gather all form data
    $patient_name = $_POST['patient_name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $admission_datetime = $_POST['admission_datetime'] ?? null;
    $department = $_POST['department'] ?? null;
    $ward_room = $_POST['ward_room'] ?? null;
    $bed_number = $_POST['bed_number'] ?? null;
    $reason_for_admission = $_POST['reason_for_admission'] ?? null;

    $doctor_assigned = $_POST['doctor_assigned'] ?? null;
    $treatment_plan = $_POST['treatment_plan'] ?? null;
    $medications = $_POST['medications'] ?? null;
    $nursing_instructions = $_POST['nursing_instructions'] ?? null;

    $estimated_cost = $_POST['estimated_cost'] ?? null;
    $insurance_details = $_POST['insurance_details'] ?? null;
    $advance_payment = $_POST['advance_payment'] ?? null;
    $charges = $_POST['charges'] ?? null;

    $discharge_datetime = !empty($_POST['discharge_datetime']) ? $_POST['discharge_datetime'] : null;
    $final_diagnosis = $_POST['final_diagnosis'] ?? null;
    $treatment_summary = $_POST['treatment_summary'] ?? null;
    $discharge_instructions = $_POST['discharge_instructions'] ?? null;

    // Insert Patient Details into the 'ippatients' table
    $patient_query = "INSERT INTO ippatients (patient_name, age, contact, address)
                      VALUES ('$patient_name', '$age', '$contact', '$address')";

    if ($conn->query($patient_query) === TRUE) {
        // Get the last inserted patient_id
        $last_patient_id = $conn->insert_id;

        // Insert Admission Information (if role is Receptionist or Nurse)
        if ($role == 'receptionist' || $role == 'nurse') {
            $admission_query = "INSERT INTO admissions (patient_id, admission_datetime, department, ward_room, bed_number, reason_for_admission)
                                VALUES ('$last_patient_id', '$admission_datetime', '$department', '$ward_room', '$bed_number', '$reason_for_admission')";
            $conn->query($admission_query);
        }

        // Insert Treatment Details (if role is Nurse or Doctor)
        if ($role == 'nurse' || $role == 'doctor') {
            $treatment_query = "INSERT INTO treatments (patient_id, doctor_assigned, treatment_plan, medications, nursing_instructions)
                                VALUES ('$last_patient_id', '$doctor_assigned', '$treatment_plan', '$medications', '$nursing_instructions')";
            $conn->query($treatment_query);
        }

        // Insert Billing Information (if role is Billing)
        if ($role == 'billing') {
            $billing_query = "INSERT INTO billing (patient_id, estimated_cost, insurance_details, advance_payment, charges)
                              VALUES ('$last_patient_id', '$estimated_cost', '$insurance_details', '$advance_payment', '$charges')";
            $conn->query($billing_query);
        }

        // Insert Discharge Summary (if role is Doctor)
        if ($role == 'doctor') {
            if ($discharge_datetime !== null) {
                $discharge_query = "INSERT INTO discharges (patient_id, discharge_datetime, final_diagnosis, treatment_summary, discharge_instructions)
                                    VALUES ('$last_patient_id', '$discharge_datetime', '$final_diagnosis', '$treatment_summary', '$discharge_instructions')";
            } else {
                $discharge_query = "INSERT INTO discharges (patient_id, final_diagnosis, treatment_summary, discharge_instructions)
                                    VALUES ('$last_patient_id', '$final_diagnosis', '$treatment_summary', '$discharge_instructions')";
            }
            $conn->query($discharge_query);
        }

        // Success message
        echo "<p style='color: green;'>Patient details submitted successfully!</p>";
    } else {
        echo "Error: " . $patient_query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
