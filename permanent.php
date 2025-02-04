<?php
// Start the session for status messages
session_start();

// Database configuration
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "employee1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $records as an empty array to avoid the "undefined variable" error
$records = [];

// Handle form submission for saving records
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected year from the form
    if (empty($_POST['year'])) {
        $_SESSION['file_status'] = 'Please select a year.';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    $selectedYear = $_POST['year'];

    if (isset($_POST['save_permanent'])) {
        // Query to fetch records for the selected year where LMC is 'No'
        $query = "SELECT * FROM management WHERE LMC = 'No' AND AME_Details = 'Done' AND YEAR(ame_date) = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $selectedYear);
        $stmt->execute();
        $result = $stmt->get_result();

        $insertCount = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Insert records into the 'emprecord' table
                $columns = array_keys($row);
                $placeholders = implode(", ", array_fill(0, count($columns), '?'));
                $insertQuery = "INSERT INTO emprecord (" . implode(", ", $columns) . ") VALUES ($placeholders)";
                $stmtInsert = $conn->prepare($insertQuery);

                $params = array_map(function ($value) { return (string) $value; }, array_values($row));
                $stmtInsert->bind_param(str_repeat('s', count($params)), ...$params);
                if ($stmtInsert->execute()) {
                    $insertCount++;
                    // Delete from 'management' table after insertion
                    // Use the correct column name here (e.g., 'employee_id' instead of 'id')
                    $deleteQuery = "DELETE FROM management WHERE regt_no = ?";
                    $stmtDelete = $conn->prepare($deleteQuery);
                    $stmtDelete->bind_param("i", $row['regt_no']);  
                    $stmtDelete->execute();
                }
            }
            $_SESSION['file_status'] = "$insertCount records saved permanently for the year $selectedYear.";
        } else {
            $_SESSION['file_status'] = "No records found for the year $selectedYear whose AME is Done with No LMC";
        }
    }

    // Handle filtering of records based on button clicks
    if (isset($_POST['stored_already'])) {
        // Query to fetch records from 'emprecord' table
        $query = "SELECT * FROM emprecord WHERE YEAR(ame_date) = ?";
    } elseif (isset($_POST['yet_to_be_stored'])) {
        // Query to fetch records from 'management' table
        $query = "SELECT * FROM management WHERE YEAR(ame_date) = ?";
    }

    if (isset($query)) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $selectedYear);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC); // Store result in $records
    }
}
if (isset($_POST['clear'])) {
        // Clear logic if needed
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to clear data
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Year Selection and Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
/* Global Styles */
* {
    margin: 0;
    padding: 15px;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7fa;
    display: flex;
    justify-content: flex-start; /* Align content to the top */
    align-items: flex-start;
    overflow: hidden;
}

/* Full-screen container */
.container {
    width: 100%;
    height: 100%;
    padding: 10px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    overflow-y: auto; /* Allow scrolling inside container */
}

/* Form Header */
.form-header {
    text-align: center;
    margin-bottom: 20px;
}

.form-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
}

/* Select and Buttons Container */
.form-group {
    display: flex;
    justify-content: flex-start; /* Align buttons and inputs horizontally */
    align-items: center;
    gap: 20px; /* Space between elements */
    margin-bottom: 20px;
    flex-wrap: wrap;
}

/* Select Dropdown */
select {
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 10px;
    border: 1px solid #ddd;
    background-color: #f5f7fa;
    color: #333;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Buttons Styling */
button {
    padding: 12px 25px;
    font-size: 16px;
    background: linear-gradient(90deg, #28a745, #218838);
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 150px;
    text-align: center;
}

button:hover {
    background: linear-gradient(90deg, #218838, #28a745);
    transform: translateY(-2px);
}

a.back-button {
    padding: 12px 25px;
    font-size: 16px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    min-width: 150px;
    text-align: center;
    transition: all 0.3s ease;
    margin-top: 10px;
}

a.back-button:hover {
    background: #0056b3;
}

/* Status Message */
.status-message {
    background: #4caf50;
    color: #fff;
    padding: 15px;
    border-radius: 10px;
    font-size: 16px;
    margin-top: 20px;
    text-align: center;
}

/* Table Container */
.table-container {
    max-height: 600px; /* Increased height for better scrolling */
    overflow-y: auto;  /* Enable vertical scrolling */
    position: relative;
}

/* Table Header Styling */
thead th {
    background-color: #3a3d55; /* Darker background */
    color: #fff;
    position:sticky;
    top: 0;
    z-index: 1;
    font-weight: 700;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    padding: 10px 25px;
    text-align: left;
   
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
    transform: scale(1.02);
    transition: all 0.3s ease-in-out;
}

/* Scrollbar Customization */
.table-container::-webkit-scrollbar {
    width: 8px;
}

.table-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

/* Loading Message */
.loading-message {
    display: none;
    text-align: center;
    font-size: 18px;
    color: #ff9800;
    margin-top: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-group {
        flex-direction: column;
        align-items: stretch;
    }

    select, button {
        width: 100%;
        margin-bottom: 10px;
    }

    .table-container {
        margin-top: 20px;
    }
}

/* Print styles */
@media print {
    body {
        background-color: white;
        margin: 0;
        overflow: visible;
    }

    form, .back-button {
        display: none;
    }

    table {
        width: 100%;
        border: 1px solid #000;
        border-collapse: collapse;
        margin: 0;
        page-break-inside: auto;
    }

    th, td {
        font-size: 10px;
        padding: 4px;
        border: 1px solid #000;
    }

    th {
        background-color: #000;
        color: #fff;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr {
        page-break-inside: auto;
    }

    @page {
        size: landscape;
        margin: 0.5in;
    }

    .print-header {
        position: running(header);
        width: 100%;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 10px;
    }
}


    </style>
</head>
<body>


<!-- This section is fine and should not need modification unless you want to further adjust table behavior -->
<div class="container">
       <h1 align="center">Manage Records</h1>
    <!-- Status message -->
    <?php if (isset($_SESSION['file_status'])): ?>
        <div class="status-message"><?php echo $_SESSION['file_status']; ?></div>
        <?php unset($_SESSION['file_status']); ?>
    <?php endif; ?>

    <!-- Form for selecting the year and actions -->
    <form method="POST" action="">
        <div class="form-group">
            <select name="year" id="year" required>
                <?php
                $current_year = date('Y');
                for ($year = 2020; $year <= $current_year; $year++) {
                    echo "<option value='$year' " . ($selected_year == $year ? "selected" : "") . ">$year</option>";
                }
                ?>
            </select>
            <button type="submit" name="save_permanent">Save Permanent</button>
            <button type="submit" name="stored_already">Stored Already</button>
            <button type="submit" name="yet_to_be_stored">Yet to be Stored</button>
            <button type="submit" name="clear">Clear</button>
            <button type="button" class="back-button" onclick="printTable()">Print</button>
            <a href="landing.php" class="back-button">Return to List</a>
            <a href="index.php" class="back-button">Return to Home</a>
            
        </div>
    </form>

    <div class="loading-message" id="loadingMessage">
        <p>Processing... Please wait.</p>
    </div>

    <!-- Displaying records in a table -->
    <div class="table-container">
        <?php if (count($records) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Regt No</th>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Age</th>
                        <th>Date of Joining</th>
                        <th>Service</th>
                        <th>Unit</th>
                        <th>AME Details</th>
                        <th>AME Date</th>
                        <th>Category</th>
                        <th>LMC</th>
                        <th>LMC Date</th>
                        <th>Duration</th>
                        <th>Due Date</th>
                        <th>Percentage Disability</th>
                        <th>Category After LMC</th>
                        <th>Diseases</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serialNo = 1;
                    foreach ($records as $row): ?>
                        <tr>
                            <td><?php echo $serialNo++; ?></td>
                            <?php foreach ($row as $cell): ?>
                                <td><?php echo htmlspecialchars($cell); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No records found for the selected year.</p>
        <?php endif; ?>
    </div>
</div>



<script>
    const form = document.querySelector('form');
    const loadingMessage = document.getElementById('loadingMessage');

    form.addEventListener('submit', function () {
        loadingMessage.style.display = 'block'; // Show loading message when form is submitted
    });
    function printTable() {
            window.print();
        }
</script>

</body>
</html>
