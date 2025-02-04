<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Annual Medical Examination Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
         html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Remove scrollbars from the body */
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            box-sizing: border-box;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1520px; /* Adjust the maximum width as needed */
            height: 100%;
            max-height: 100vh; /* Ensure card does not exceed viewport height */
            display: flex;
            flex-direction: column;
        }

        .card-body {
            padding: 20px;
            flex: 1; /* Allow card-body to take up remaining space */
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-bottom: 2px solid #0056b3;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            width: 100%; /* Ensure header fits full width */
        }

        .table-container {
            overflow-y: auto; /* Enable vertical scrolling */
            overflow-x: auto; /* Enable horizontal scrolling */
            max-height: calc(100vh - 200px); /* Adjust based on card-header and padding */
            max-width: 1400px;  /* Ensure table-container takes full width */
        }

        .table {
            border-radius: 10px;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #dee2e6;
            table-layout: auto; /* Adjust table layout based on content */
        }

        .table thead th {
            background-color: #007bff;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody td, .table thead th {
            text-align: center;
            padding: 8px;
            border: 1px solid #dee2e6;
        }

        .back-button, .clear-button {
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
            width: 180px;
            height: 40px;
            margin-left: 10px; /* Space between buttons */
        }

        .btn-group {
            display: flex;
            justify-content: flex-end; /* Align buttons to the right */
        }

        .form-controls {
            display: flex;
            align-items: center;
        }

        .form-controls .form-select,
        .form-controls .form-control {
            margin-right: 10px; /* Space between form controls */
        }

        /* Print styles */
        @media print {
            body {
                background-color: white;
                margin: 0;
                overflow: visible;
            }

            .container, .card {
                width: 100%;
                height: auto;
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
            }

            .card-header, .form-controls, .btn-group {
                display: none; /* Hide header, form controls, and buttons */
            }

            .table-container {
                overflow: visible; /* Ensure table is visible */
                page-break-inside: auto;
            }

            .table {
                border: 1px solid #000;
                width: 100%;
                page-break-inside: auto;
            }

            .table thead th {
                background-color: #000;
                color: #fff;
                position: static; /* Ensure table header is visible */
            }

            .table tbody tr {
                page-break-inside: auto;
            }

            .table tbody td, .table thead th {
                font-size: 10px; /* Adjust font size for printing */
                padding: 4px; /* Adjust padding for printing */
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
                z-index: 1000; /* Ensure it stays on top */
            }
        }

        /* Print Header Styling */
        @page {
            size: landscape;
            margin: 0.5in;
        }

        @page :left {
            @top-left {
                content: "Annual Medical Examination";
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }
        }

        @page :right {
            @top-right {
                content: "Annual Medical Examination";
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }
        }

        @page :first {
            @top-center {
                content: "Annual Medical Examination";
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Annual Medical Examination</h4>
                    </div>
                    <div class="card-body">
                        <form id="search-form" action="" method="post">
                            <div class="form-controls mb-4">

                                <!-- Year Select Dropdown -->
                                <select class="form-select" name="year-filter" id="year-filter" onchange="toggleFilters()">
                                <!-- Default option -->
                                <option value="">Year</option>
                                </select>

                                <!-- AME Status Select -->
                                <select class="form-select" name="ame-filter" id="ame-filter">
                                <option value="">Select AME Status</option>
                                <option value="done">Done</option>
                                <option value="not done">Not Done</option>
                                </select>

                                <!-- LMC Status Select -->
                                <select class="form-select" name="lmc-filter" id="lmc-filter">
                                <option value="">Select LMC Status</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                                </select>
                                <!-- Buttons -->
                                <div class="btn-group ms-auto">
                                    <button type="submit" name="filter-btn" class="back-button">Search Data</button>
                                    <a href="landing.php" class="back-button">Return to List</a>
                                    <a href="index.php" class="back-button">Return to Home</a>
                                    <button type="reset" class="back-button" onclick="clearTable()">Clear</button>
                                    <button type="button" class="back-button" onclick="printTable()">Print</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-container">
                            <table class="table table-striped table-bordered" id="records-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Regt_No</th>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">DOJ</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">AME Details</th>
                                        <th scope="col">Date of AME</th>
                                        <th scope="col">Details for Category</th>
                                        <th scope="col">LMC</th>
                                        <th scope="col">Date of LMC</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Percentage of Disability</th>
                                        <th scope="col">Details for Category</th>
                                        <th scope="col">Diseases/Diagnosis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
include("connection.php");

if (isset($_POST['filter-btn'])) {
    $ameFilter = mysqli_real_escape_string($conn, $_POST['ame-filter']);
    $lmcFilter = mysqli_real_escape_string($conn, $_POST['lmc-filter']);
    $yearFilter = mysqli_real_escape_string($conn, $_POST['year-filter']);  // Capture year filter

    // Initialize query variable for 'management' table
    $query_management = "SELECT * FROM management WHERE 1";

    // Apply filters for AME and LMC to 'management' table
    if ($ameFilter === 'done' && $lmcFilter === 'yes') {
        $query_management .= " AND ame_details = 'done' AND lmc = 'yes'";
    } elseif ($ameFilter === 'not done' && $lmcFilter === 'yes') {
        $query_management .= " AND ame_details = 'not done' AND lmc = 'yes'";
    } elseif ($ameFilter === 'done' && $lmcFilter === 'no') {
        $query_management .= " AND ame_details = 'done' AND lmc = 'no'";
    } elseif ($ameFilter === 'not done' && $lmcFilter === 'no') {
        $query_management .= " AND ame_details = 'not done' AND lmc = 'no'";
    }

    // Add year filter if selected
    if ($yearFilter) {
        $query_management .= " AND YEAR(ame_date) = '$yearFilter'";
    }

    // Default sort order
    $query_management .= " ORDER BY ame_date ASC, category ASC";

    // Run query for 'management' table
    $query_run_management = $conn->query($query_management);

    // Initialize query variable for 'emprecord' table
    $query_emprecord = "SELECT * FROM emprecord WHERE 1";

    // Apply filters for AME and LMC to 'emprecord' table
    if ($ameFilter === 'done' && $lmcFilter === 'yes') {
        $query_emprecord .= " AND ame_details = 'done' AND lmc = 'yes'";
    } elseif ($ameFilter === 'not done' && $lmcFilter === 'yes') {
        $query_emprecord .= " AND ame_details = 'not done' AND lmc = 'yes'";
    } elseif ($ameFilter === 'done' && $lmcFilter === 'no') {
        $query_emprecord .= " AND ame_details = 'done' AND lmc = 'no'";
    } elseif ($ameFilter === 'not done' && $lmcFilter === 'no') {
        $query_emprecord .= " AND ame_details = 'not done' AND lmc = 'no'";
    }

    // Apply year filter to the emprecord table
    if ($yearFilter) {
        $query_emprecord .= " AND YEAR(ame_date) = '$yearFilter'";
    }

    // Run query for 'emprecord' table
    $query_run_emprecord = $conn->query($query_emprecord);

    // Flag to check if records are found
    $recordsFound = false;
    $count = 1;
    
    // Display data from 'management' table if available
    if ($query_run_management && $query_run_management->num_rows > 0) {
        while ($row = $query_run_management->fetch_assoc()) {
            $formatted_dob = date('d-m-Y', strtotime($row['dob']));
            $formatted_doj = date('d-m-Y', strtotime($row['doj']));
            $formatted_ame_date = date('d-m-Y', strtotime($row['ame_date']));
            $formatted_lmc_date = date('d-m-Y', strtotime($row['lmc_date']));
            $formatted_due_date = date('d-m-Y', strtotime($row['due_date']));

            echo "<tr>
                <td>{$count}</td>
                <td>{$row['regt_no']}</td>
                <td>{$row['rank']}</td>
                <td>{$row['name']}</td>
                <td>{$formatted_dob}</td>
                <td>{$row['age']}</td>
                <td>{$formatted_doj}</td>
                <td>{$row['service']}</td>
                <td>{$row['unit']}</td>
                <td>{$row['ame_details']}</td>
                <td>{$formatted_ame_date}</td>
                <td>{$row['category']}</td>
                <td>{$row['lmc']}</td>
                <td>{$formatted_lmc_date}</td>
                <td>{$row['duration']}</td>
                <td>{$formatted_due_date}</td>
                <td>{$row['percentage_disability']}</td>
                <td>{$row['category_after_lmc']}</td>
                <td>{$row['diseases']}</td>
            </tr>";
            $count++;
        }
        $recordsFound = true;
    }

    // Display data from 'emprecord' table if available
    if ($query_run_emprecord && $query_run_emprecord->num_rows > 0) {
        while ($row = $query_run_emprecord->fetch_assoc()) {
            $formatted_dob = date('d-m-Y', strtotime($row['dob']));
            $formatted_doj = date('d-m-Y', strtotime($row['doj']));
            $formatted_ame_date = date('d-m-Y', strtotime($row['ame_date']));
            $formatted_lmc_date = date('d-m-Y', strtotime($row['lmc_date']));
            $formatted_due_date = date('d-m-Y', strtotime($row['due_date']));

            echo "<tr>
                <td>{$count}</td>
                <td>{$row['regt_no']}</td>
                <td>{$row['rank']}</td>
                <td>{$row['name']}</td>
                <td>{$formatted_dob}</td>
                <td>{$row['age']}</td>
                <td>{$formatted_doj}</td>
                <td>{$row['service']}</td>
                <td>{$row['unit']}</td>
                <td>{$row['ame_details']}</td>
                <td>{$formatted_ame_date}</td>
                <td>{$row['category']}</td>
                <td>{$row['lmc']}</td>
                <td>{$formatted_lmc_date}</td>
                <td>{$row['duration']}</td>
                <td>{$formatted_due_date}</td>
                <td>{$row['percentage_disability']}</td>
                <td>{$row['category_after_lmc']}</td>
                <td>{$row['diseases']}</td>
            </tr>";
            $count++;
        }
        $recordsFound = true;
    }

    // If no records found in either table, display a message
    if (!$recordsFound) {
        echo "<tr><td colspan='18'>No records found.</td></tr>";
    }
}
?>



                                    
                                       
                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function clearTable() {
            // Clear table rows except the header
            const tableBody = document.querySelector('#records-table tbody');
            while (tableBody.rows.length > 0) {
                tableBody.deleteRow(0);
            }
        }

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









