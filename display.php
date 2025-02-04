<?php
include("connection.php");

// Initialize variables
$show_records = false; // Flag to control the display of records
$employee_count = 0; // To store the employee count
$records = []; // Initialize the records array
$selected_year = ""; // Variable to store selected year

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['clear'])) {
        // Clear logic if needed
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to clear data
        exit();
    } elseif (isset($_POST['display'])) {
        // Get the selected year from the form
        $selected_year = $_POST['year'];

        // Prepare SQL query to fetch records where ame_details is NULL, empty or 'NOT DONE' for the selected year
        $sql = "
            (SELECT * FROM management 
            WHERE YEAR(ame_date) = ? 
            AND (ame_details = 'NOT DONE' OR ame_details IS NULL OR ame_details = '') 
            ORDER BY category ASC)
            UNION
            (SELECT * FROM emprecord 
            WHERE YEAR(ame_date) = ? 
            AND (ame_details = 'NOT DONE' OR ame_details IS NULL OR ame_details = '') 
            ORDER BY category ASC)
        ";
        
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $selected_year, $selected_year); // Bind the selected year for both queries
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
        $employee_count = count($records); // Count of employees whose AME details are not done for the selected year
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Management Form</title>
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


/* Styling for the label and dropdown */
label[for="year"] {
    font-size: 16px; /* Set font size for the label */
    font-weight: bold; /* Make the label text bold */
    color: #333; /* Set the text color */
    margin-right: 10px; /* Add some space between the label and dropdown */
    display: inline-block; /* Ensure the label and dropdown are on the same line */
}

select#year {
    padding: 8px; /* Add padding inside the dropdown */
    font-size: 14px; /* Set font size for the dropdown */
    border: 1px solid #ccc; /* Set border color */
    border-radius: 4px; /* Round the corners */
    background-color: #fff; /* Set background color */
    color: #333; /* Set text color */
    cursor: pointer; /* Change cursor to pointer when hovering over the dropdown */
    width: 150px; /* Set the width of the dropdown */
    transition: border-color 0.3s ease; /* Smooth transition for border color */
}

select#year:hover {
    border-color: #007bff; /* Change border color on hover */
}

select#year:focus {
    outline: none; /* Remove the outline when the dropdown is focused */
    border-color: #0056b3; /* Change border color on focus */
}

    </style>
</head>
<body>
    <form method="POST" action="">
        <!-- Dropdown to select year -->
        <label for="year">Select Year:</label>
        <select name="year" id="year" required>
            <?php
            // Dynamically populate year options from 2020 to current year
            $current_year = date('Y');
            for ($year = 2020; $year <= $current_year; $year++) {
                echo "<option value='$year' " . ($selected_year == $year ? "selected" : "") . ">$year</option>";
            }
            ?>
        </select>
        <input type="submit" name="display" value="Display">
        <input type="submit" name="clear" value="Clear">
        <a href="landing.php" class="back-button">Return to List</a>
        <a href="index.php" class="back-button">Return to Home</a>
        <button type="button" class="back-button" onclick="printTable()">Print</button>
    </form>

    <?php if ($show_records): ?>
        <h2>Records of Employees Whose AME is Due for the Year <?php echo $selected_year; ?></h2>
        <?php if (empty($records)): ?>
            <p>No records found for the selected year.</p>
        <?php else: ?>
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
                <?php foreach ($records as $index => $record): ?>
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
                        <td><?php echo $index + 1; // Serial number starts from 1 ?></td>
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
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    <?php endif; ?>

    <script type="text/javascript">
        // Function to show the pop-up with employee count
        function showEmployeeCount() {
            var employeeCount = <?php echo json_encode($employee_count); ?>;
            if (employeeCount > 0) {
                alert('No of employees whose AME is Due for the Year <?php echo $selected_year; ?>: ' + employeeCount);
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











