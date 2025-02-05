<?php
include("connection.php");

// Initialize variables
$show_records = false; // Flag to control the display of records
$employee_count = 0; // To store the employee count
$records = []; // Initialize the records array

// Function to backup records before clearing AME details
function backupRecords($conn) {
    $sql = "INSERT INTO emp_record (employee_id, ame_date, ame_status, lmc, regt_no, rank, name, dob, doj, service, unit, ame_details, category, lmc_date, duration, due_date, percentage_disability, category_after_lmc, diseases)
            SELECT employee_id, ame_date, ame_status, lmc, regt_no, rank, name, dob, doj, service, unit, ame_details, category, lmc_date, duration, due_date, percentage_disability, category_after_lmc, diseases
            FROM management WHERE lmc = 'no'";

    if ($conn->query($sql) === TRUE) {
        echo "Records backed up successfully to emp_record table.<br>";
    } else {
        echo "Error backing up records: " . $conn->error . "<br>";
    }
}

// Function to update management table by clearing AME details
function updateManagementTable($conn) {
    $sql = "UPDATE management SET ame_details = 'not done' WHERE lmc = 'No'";

    if ($conn->query($sql) === TRUE) {
        echo "Management table updated successfully.<br>";
    } else {
        echo "Error updating management table: " . $conn->error . "<br>";
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        // Clear logic if needed
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to clear data
        exit();
    } elseif (isset($_POST['display'])) {
        // Calculate the date for January 1st of this year
        $current_year = date('Y');
        $date_jan_first = $current_year . '-01-21';

        // Prepare SQL query to fetch records where ame_date is before January 1st of this year and not a default date
        $sql = "SELECT * FROM management WHERE ame_date < ? AND ame_date <> '0000-00-00' ORDER BY ame_date ASC, category ASC";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("s", $date_jan_first);
        $stmt->execute();
        $result = $stmt->get_result();

        // Store results in an array
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        $stmt->close();
        $conn->close();

        // Set flag to show records
        $show_records = true;
        $employee_count = count($records); // Count of employees with ame_date before January 1st of this year
    }
}

// If today is January 1st, backup and update automatically
if (date('m-d') == '01-21') {
    echo "It is January 1st. Running backup and update...<br>";  // Debugging line to ensure it's running
    backupRecords($conn);
    updateManagementTable($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Auto Update</title>
    <style>
        /* Basic reset for margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        h2 {
            color: #444;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #eaeaea;
        }

        .no-records {
            text-align: center;
            color: #666;
            padding: 20px;
        }

        /* Advanced Styling for Back Button */
        .back-button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #fff;
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .back-button:hover {
            background: linear-gradient(45deg, #0056b3, #003d7a);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .back-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

       /* Print styles */
@media print {
    body {
        background-color: white;
        margin: 0;
        overflow: visible;
    }

    form, .back-button {
        display: none; /* Hide form controls and buttons */
    }

    table {
        width: 100%; /* Ensure the table covers the full width */
        border: 1px solid #000;
        border-collapse: collapse;
        margin: 0;
        page-break-inside: auto;
    }

    th, td {
        font-size: 10px; /* Adjust font size for printing */
        padding: 4px; /* Adjust padding for printing */
        border: 1px solid #000; /* Ensure borders are visible */
    }

    th {
        background-color: #000; /* Ensure header background is visible */
        color: #fff; /* Ensure text color is readable */
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row color */
    }

    tbody tr {
        page-break-inside: auto; /* Avoid breaking rows inside pages */
    }

    @page {
        size: landscape; /* Print in landscape mode */
        margin: 0.5in; /* Adjust margins for better fit */
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
    <form method="POST" action="">
        <input type="submit" name="display" value="Display">
        <input type="submit" name="clear" value="Clear">
        <a href="landing.php" class="back-button">Return to List</a>
        <a href="index.php" class="back-button">Return to Home</a>
        <button type="button" class="back-button" onclick="printTable()">Print</button>
    </form>

    <?php if ($show_records): ?>
    <h2>Records of Employees with AME Date Before January 1st of This Year</h2>
    <table border="0">
        <thead>
           <tr>
                <th>Serial No</th>
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
            <?php if (empty($records)) { ?>
                <tr>
                    <td colspan="18" class="no-records">No records found</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($records as $index => $record) { ?>
                    <?php
                    // Format the dates for each record
                    $ameDate = new DateTime($record['ame_date']);
                    $displayAmeDate = $ameDate->format('d-m-Y');
                    
                    $lmcDate = new DateTime($record['lmc_date']);
                    $displayLmcDate = $lmcDate->format('d-m-Y');

                    $dueDate = new DateTime($record['due_date']);
                    $displayDueDate = $dueDate->format('d-m-Y');

                    $doj = new DateTime($record['doj']);
                    $displayDoj = $doj->format('d-m-Y');

                    $dob = new DateTime($record['dob']);
                    $displayDob = $dob->format('d-m-Y');
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($record['regt_no']); ?></td>
                        <td><?php echo htmlspecialchars($record['rank']); ?></td>
                        <td><?php echo htmlspecialchars($record['name']); ?></td>
                        <td><?php echo $displayDob; ?></td>
                        <td><?php echo htmlspecialchars($record['age']); ?></td>
                        <td><?php echo $displayDoj; ?></td>
                        <td><?php echo htmlspecialchars($record['service']); ?></td>
                        <td><?php echo htmlspecialchars($record['unit']); ?></td>
                        <td><?php echo htmlspecialchars($record['ame_details']); ?></td>
                        <td><?php echo $displayAmeDate; ?></td>
                        <td><?php echo htmlspecialchars($record['category']); ?></td>
                        <td><?php echo htmlspecialchars($record['lmc']); ?></td>
                        <td><?php echo $displayLmcDate; ?></td>
                        <td><?php echo htmlspecialchars($record['duration']); ?></td>
                        <td><?php echo $displayDueDate; ?></td>
                        <td><?php echo htmlspecialchars($record['percentage_disability']); ?></td>
                        <td><?php echo htmlspecialchars($record['category_after_lmc']); ?></td>
                        <td><?php echo htmlspecialchars($record['diseases']); ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <?php endif; ?>
    <script type="text/javascript">
        // Function to show the pop-up with employee count
        function showEmployeeCount() {
            var employeeCount = <?php echo json_encode($employee_count); ?>;
            if (employeeCount > 0) {
                alert('Count of employees with AME date before January 1st of this year: ' + employeeCount);
            }
        }

        // Call function when the page loads
        window.onload = function() {
            showEmployeeCount();
        };
        function printTable() {
            window.print();
        }
    </script>
</body>
</html>
