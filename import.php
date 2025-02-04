<?php
require 'vendor/autoload.php'; // Ensure Composer's autoload file is included

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

// Start session to store status and last upload time
session_start();

// Database configuration
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "employee1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$records = [];
$fileStatus = '';
$columns = [];
$insertedCount = 0;
$existingCount = 0;
$filterValue = '';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']['name'])) {
    // Check if the file has already been processed
    if (isset($_SESSION['file_processed']) && $_SESSION['file_processed']) {
        $fileStatus = 'File has already been processed.';
        $_SESSION['file_status'] = $fileStatus;
        // No redirect needed, just display the result
    }

    $file = $_FILES['file'];
    $fileStatus = '';

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $fileStatus = 'Upload error: ' . $file['error'];
    } elseif ($file['size'] > 10485760) { // 10MB limit
        $fileStatus = 'File size exceeds limit';
    } elseif (!in_array($file['type'], ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.spreadsheetml.template'])) {
        $fileStatus = 'Invalid file type';
    } else {
        // Process the file
        try {
            $spreadsheet = IOFactory::load($file['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            if (empty($data)) {
                throw new Exception("No data found in the file.");
            }

            $columns = array_map('trim', array_shift($data)); // Trim column names

            // Check if 'regt_no' is a column
            if (!in_array('regt_no', $columns)) {
                throw new Exception("Column 'regt_no' not found in the file.");
            }

            // Prepare SQL with ON DUPLICATE KEY UPDATE
            $sql = "INSERT INTO management (" . implode(", ", array_map(fn($col) => "`$col`", $columns)) . ") 
                    VALUES (" . implode(", ", array_fill(0, count($columns), '?')) . ") 
                    ON DUPLICATE KEY UPDATE " . implode(", ", array_map(fn($col) => "`$col` = VALUES(`$col`)", $columns));

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }

            // Fetch existing regt_no values from the database to check duplicates
            $existingRegtNos = [];
            $regtNoQuery = "SELECT regt_no FROM management";
            $regtNoResult = $conn->query($regtNoQuery);
            if ($regtNoResult) {
                while ($row = $regtNoResult->fetch_assoc()) {
                    $existingRegtNos[] = $row['regt_no'];
                }
            }

            foreach ($data as $rowIndex => $row) {
                // Ensure each row has the correct number of columns
                if (count($row) !== count($columns)) {
                    throw new Exception("Row $rowIndex has an incorrect number of columns.");
                }

                // Get regt_no value from the row
                $regtNo = $row[array_search('regt_no', $columns)];

                // Check if regt_no already exists in the database
                if (in_array($regtNo, $existingRegtNos)) {
                    $existingCount++; // Increment count for existing records
                    continue; // Skip this record
                }

                // Bind the row values to the prepared statement and execute the insert
                $stmt->bind_param(str_repeat('s', count($columns)), ...$row);
                $stmt->execute();

                $insertedCount++; // Increment count for inserted records
            }

            // Set file status message
            $fileStatus = 'File processed successfully. ' . $insertedCount . ' records inserted. ' . $existingCount . ' records already exist.';

            $_SESSION['last_upload_time'] = time(); // Store upload time in session
            $_SESSION['file_processed'] = true; // Mark the file as processed
        } catch (Exception $e) {
            $fileStatus = 'Failed - ' . $e->getMessage();
        }
    }
    $_SESSION['file_status'] = $fileStatus;
}

// Handle clear status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_status'])) {
    unset($_SESSION['file_status']);
}

if (isset($_POST['display'])) {
    // Check if a year filter is set
    $yearFilter = isset($_POST['year-filter']) ? $_POST['year-filter'] : '';
    $records = [];
    $message = '';

    // If a year filter is provided, perform a query to check both tables for records for that year
    if ($yearFilter) {
        // Prepare queries to check records for the given year
        $query_management = "SELECT * FROM management WHERE YEAR(ame_date) = ? ORDER BY `ame_date` ASC, `category` ASC";
        $query_emprecord = "SELECT * FROM emprecord WHERE YEAR(ame_date) = ? ORDER BY `ame_date` ASC, `category` ASC";

        // Prepare and execute both queries
        $stmt_management = $conn->prepare($query_management);
        $stmt_management->bind_param("i", $yearFilter); // 'i' for an integer parameter (yearFilter)
        $stmt_management->execute();
        $result_management = $stmt_management->get_result();

        $stmt_emprecord = $conn->prepare($query_emprecord);
        $stmt_emprecord->bind_param("i", $yearFilter); // 'i' for an integer parameter (yearFilter)
        $stmt_emprecord->execute();
        $result_emprecord = $stmt_emprecord->get_result();

        // Check if no records are returned from both tables
        if ($result_management->num_rows == 0 && $result_emprecord->num_rows == 0) {
            // No records found in both tables for the selected year
            $message = "No records found for the year " . $yearFilter . ".";
        } else {
            // Merge the results if any records exist
            $records = array_merge($result_management->fetch_all(MYSQLI_ASSOC), $result_emprecord->fetch_all(MYSQLI_ASSOC));

            // Format dates for each record
            foreach ($records as &$record) {
                if (!empty($record['ame_date'])) {
                    $record['ame_date'] = (new DateTime($record['ame_date']))->format('d/m/Y');
                }
                if (!empty($record['lmc_date'])) {
                    $record['lmc_date'] = (new DateTime($record['lmc_date']))->format('d/m/Y');
                }
                if (!empty($record['due_date'])) {
                    $record['due_date'] = (new DateTime($record['due_date']))->format('d/m/Y');
                }
                if (!empty($record['doj'])) {
                    $record['doj'] = (new DateTime($record['doj']))->format('d/m/Y');
                }
                if (!empty($record['dob'])) {
                    $record['dob'] = (new DateTime($record['dob']))->format('d/m/Y');
                }
            }
        }

        // Close the statements
        $stmt_management->close();
        $stmt_emprecord->close();
    } else {
        // If no year filter is applied, fetch all records from both tables
        $query = "(
                    SELECT * FROM management ORDER BY `ame_date` ASC, `category` ASC
                  )
                  UNION ALL
                  (
                    SELECT * FROM emprecord ORDER BY `ame_date` ASC, `category` ASC
                  )
                  ORDER BY ame_date ASC"; // Apply sorting after UNION ALL

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Format dates for each record
        foreach ($records as &$record) {
            if (!empty($record['ame_date'])) {
                $record['ame_date'] = (new DateTime($record['ame_date']))->format('d/m/Y');
            }
            if (!empty($record['lmc_date'])) {
                $record['lmc_date'] = (new DateTime($record['lmc_date']))->format('d/m/Y');
            }
            if (!empty($record['due_date'])) {
                $record['due_date'] = (new DateTime($record['due_date']))->format('d/m/Y');
            }
            if (!empty($record['doj'])) {
                $record['doj'] = (new DateTime($record['doj']))->format('d/m/Y');
            }
            if (!empty($record['dob'])) {
                $record['dob'] = (new DateTime($record['dob']))->format('d/m/Y');
            }
        }

        $stmt->close();
    }
}





// Start handling the download request
if (isset($_GET['download_sample'])) {
    try {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Define the header row
        $headers = [
            'regt_no', 'rank', 'name', 'dob', 'age', 
            'doj', 'service', 'unit', 'ame_details', 
            'ame_date', 'category', 'lmc', 'lmc_date', 'duration', 
            'due_date', 'percentage_disability', 'category_after_lmc', 'diseases'
        ];

        // Set date format for specific columns (e.g., DOB, DOJ, AME Date, LMC Date, Due Date)
        $dateColumns = ['D', 'G', 'J', 'M', 'O']; // Columns D, G, J, M, O for DOB, DOJ, AME Date, LMC Date, Due Date
        foreach ($dateColumns as $column) {
            $sheet->getStyle("$column")->getNumberFormat()->setFormatCode('DD/MM/YYYY');
        }

        // Write headers to the first row
        $sheet->fromArray($headers, NULL, 'A1');

        // Set the header row to bold
        foreach (range('A', 'R') as $column) {
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
        }

        // Save the file to a variable
        $filePath = 'sample.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Set headers for file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="sample.xlsx"');
        header('Cache-Control: max-age=0');

        // Read and output the file content
        readfile($filePath);

        // Remove the file after download if necessary
        unlink($filePath);

        exit; // Stop further execution after download
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}

?>
<?php if (!empty($message)): ?>
    <div class="alert alert-warning"><?php echo $message; ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel Files</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100vw;
            background: #f4f4f9;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="file"] {
            padding: 10px;
            border: 2px solid #007bff;
            border-radius: 5px;
            background-color: #f9f9f9;
            flex: 1;
        }

        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .status-message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
        }

        .status-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .back-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-left: 10px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .table-wrapper {
            overflow-x: auto;
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
        }

        td {
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Print styles */
        @media print {
            body {
                background-color: white;
                margin: 0;
                overflow: visible;
            }

            .container {
                height: auto;
                width: 100%;
                padding: 0;
            }

            /* Hide elements that are not needed for print */
            form, .status-message, .back-button, h1 {
                display: none;
            }

            .table-wrapper {
                width: 100%;
                overflow: visible;
            }

            table {
                border: 1px solid #000;
                width: 100%;
                page-break-inside: auto;
            }

            thead th {
                background-color: #000;
                color: #fff;
                position: static;
            }

            tbody tr {
                page-break-inside: auto;
            }

            td, th {
                font-size: 12px; /* Adjust font size for printing if needed */
                padding: 6px; /* Adjust padding for printing if needed */
            }

            @page {
                size: landscape; /* Print in landscape mode */
                margin: 0.5in; /* Adjust margins for better fit */
            }
        }


        /* Style for the Year dropdown */
.form-select {
    width: 150px; /* Set width */
    padding: 10px 15px; /* Add padding inside the dropdown */
    border: 2px solid #007bff; /* Border with primary color */
    border-radius: 5px; /* Rounded corners */
    background-color: #f9f9f9; /* Light background */
    font-size: 16px; /* Text size */
    color: #333; /* Text color */
    font-family: 'Arial', sans-serif; /* Font family */
    cursor: pointer; /* Pointer cursor */
    transition: all 0.3s ease; /* Smooth transition for interactions */
}

/* Hover effect for the dropdown */
.form-select:hover {
    border-color: #0056b3; /* Darker border color on hover */
    background-color: #f1f1f1; /* Slightly darker background on hover */
}

/* Focus effect for the dropdown (when clicked) */
.form-select:focus {
    border-color: #28a745; /* Green border when focused */
    outline: none; /* Remove default outline */
    background-color: #fff; /* White background when focused */
}

/* Style the default option */
.form-select option {
    font-size: 16px; /* Ensure the text is properly sized */
    color: #333; /* Text color */
}

/* Disable the dropdown */
.form-select:disabled {
    background-color: #e9ecef; /* Disabled background color */
    color: #6c757d; /* Disabled text color */
    cursor: not-allowed; /* Cursor indicating no interaction */
}

/* Responsive design for smaller screens */
@media screen and (max-width: 768px) {
    .form-select {
        width: 100%; /* Full width on smaller screens */
        font-size: 14px; /* Adjust font size */
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Excel Files</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" value="Upload">
            <a href="landing.php" class="back-button">Return to List</a>
            <a href="index.php" class="back-button">Return to Home</a>
            <a href="?download_sample=true" class="back-button">Download Sample</a>

        </form>
        <form action="" method="post">
            <!-- Year Select Dropdown -->
                                <select class="form-select" name="year-filter" id="year-filter" onchange="toggleFilters()">
                                <!-- Default option -->
                                <option value="">Year</option>
                                </select>

            <input type="submit" name="display" value="Display Records">
            
            <input type="submit" name="clear_status" value="Clear Status">
            <button type="button" class="back-button" onclick="printTable()">Print</button>
        </form>

        <?php if (isset($_SESSION['file_status'])): ?>
            <div class="status-message <?= strpos($_SESSION['file_status'], 'Failed') === false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($_SESSION['file_status']) ?>
            </div>
            <?php unset($_SESSION['file_status']); ?>
        <?php endif; ?>


        <div class="table-wrapper">
            <?php if (!empty($records)): ?>
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
                        $serialNo = 1; // Initialize serial number
                        foreach ($records as $row): ?>
                            <tr>
                                <td><?php echo $serialNo++; ?></td> <!-- Display Serial No -->
                                <?php foreach ($row as $cell): ?>
                                    <td><?php echo htmlspecialchars($cell); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($records)): ?>
                            <tr>
                                <td colspan="18">No records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function printTable() {
            window.print();
        }

        // Function to generate years from 2023 to the current year and next year
function populateYearDropdown() {
    const yearSelect = document.getElementById("year-filter");
    const currentYear = new Date().getFullYear(); // Get the current year
    const startYear = 2023;

    // Loop through the years from 2023 to the next year
    for (let year = startYear; year <= currentYear + 1; year++) {
        const option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option); // Add the year option to the dropdown
    }
}

// Call the function when the page loads
document.addEventListener("DOMContentLoaded", function () {
    populateYearDropdown();
});

    </script>
</body>
</html>







