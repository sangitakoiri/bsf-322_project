<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search and Filter Records by Unit</title>
    <style>
      body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .container {
        margin-top: 10px;
        padding-top: 0;
        width: 100%;
        max-width: 1800px;
      }

      .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
      }

      .card-header {
        background-color: #007bff;
        color: white;
        text-align: center;
        border-bottom: 2px solid #0056b3;
        border-radius: 10px 10px 0 0;
        padding: 15px;
      }

      .card-title {
        font-size: 1.5rem;
        font-weight: bold;
      }

      .form-group input,
      .form-group select {
        border-radius: 5px;
        border: 2px solid #ced4da;
        padding: 10px;
        border-color: #feb47b;
        width: 20%;
        box-sizing: border-box;
      }

      .form-group select {
        height: 40px;
        line-height: 1.5;
      }

      .btn-primary,
      .back-button {
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        text-decoration: none;
        text-align: center;
        transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: inline-block;
      }

      .back-button:hover,
      .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003d7a);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
      }

      .back-button:active,
      .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      }

      .card-body {
        padding: 20px;
      }

      .table-container {
        overflow: auto;
        max-height: 500px;
        margin-top: 20px;
      }

      .table {
        border-radius: 10px;
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #dee2e6;
      }

      .table thead th {
        background-color: #007bff;
        color: white;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 1;
        border: 1px solid #dee2e6;
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

      .table tbody td,
      .table thead th {
        text-align: center;
        padding: 8px;
        border: 1px solid #dee2e6;
      }

      .table tbody td {
        font-size: 0.9rem;
      }

      .table th {
        font-size: 1rem;
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

            form, .card-header, .form-controls, .btn-group, .back-button {
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
                        <form action="" method="post">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">

                                         <!-- Year Select Dropdown -->
                                         <select class="form-select" name="year-filter" id="year-filter" onchange="toggleFilters()">
                                         <!-- Default option -->
                                         <option value="">Year</option>
                                         </select>

                                        <select class="form-control" name="unit-filter">
                                            <option value="">Select All Unit</option>
                                            <option value="SHQ DBR">SHQ DBR</option>
                                            <option value="Water Wing">WATER WING</option>
                                            <option value="66 BN BSF">66 BN BSF</option>
                                            <option value="31 BN BSF">31 BN BSF</option>
                                            <option value="45 BN BSF">45 BN BSF</option>
                                            <option value="150 BN BSF">150 BN BSF</option>
                                        </select>
                                        <button type="submit" name="filter-btn" class="back-button">Search Data</button>
                                        <a href="landing.php" class="back-button">Return to List</a>
                                        <a href="index.php" class="back-button">Return to Home</a>
                                        <button type="reset" class="back-button" onclick="clearTable()">Clear</button>
                                        <button type="button" class="back-button" onclick="printTable()">Print</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-container">
                            <table id="records-table" class="table table-striped table-bordered">
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
// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'employee1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['filter-btn'])) {
    $unit_filter = mysqli_real_escape_string($conn, $_POST['unit-filter']);
    $yearFilter = mysqli_real_escape_string($conn, $_POST['year-filter']);  // New Year filter
    
    // Query for management table
    $query_management = "SELECT * FROM management WHERE 1=1";
    if (!empty($unit_filter)) {
        $query_management .= " AND unit = '$unit_filter'";
    }
    if (!empty($yearFilter)) {
        $query_management .= " AND YEAR(ame_date) = '$yearFilter'"; 
    }
    $query_management .= " ORDER BY ame_date ASC, category ASC";

    $query_run_management = $conn->query($query_management);
    
    // Query for emprecord table
    $query_emprecord = "SELECT * FROM emprecord WHERE 1=1";
    if (!empty($unit_filter)) {
        $query_emprecord .= " AND unit = '$unit_filter'";
    }
    if (!empty($yearFilter)) {
        $query_emprecord .= " AND YEAR(ame_date) = '$yearFilter'"; 
    }
    $query_emprecord .= " ORDER BY ame_date ASC, category ASC";

    $query_run_emprecord = $conn->query($query_emprecord);

    // Initialize an array to hold the combined results
    $combined_results = [];

    // Fetch results from the management table
    if ($query_run_management && $query_run_management->num_rows > 0) {
        while ($row = $query_run_management->fetch_assoc()) {
            $combined_results[] = $row;
        }
    }

    // Fetch results from the emprecord table
    if ($query_run_emprecord && $query_run_emprecord->num_rows > 0) {
        while ($row = $query_run_emprecord->fetch_assoc()) {
            $combined_results[] = $row;
        }
    }

    // Optionally sort the combined results by ame_date (ascending)
    usort($combined_results, function($a, $b) {
        return strtotime($a['ame_date']) - strtotime($b['ame_date']);
    });

    // Start counting for display purposes
    $count = 1;

    // Check if there are combined results to display
    if (count($combined_results) > 0) {
        foreach ($combined_results as $row) {
            // Format the date for display
            $ameDate = new DateTime($row['ame_date']);
            $displayAmeDate = $ameDate->format('d-m-Y');
            
            $lmcDate = new DateTime($row['lmc_date']);
            $displayLmcDate = $lmcDate->format('d-m-Y');

            $dueDate = new DateTime($row['due_date']);
            $displayDueDate = $dueDate->format('d-m-Y');

            $doj = new DateTime($row['doj']);
            $displayDoj = $doj->format('d-m-Y');

            $dob = new DateTime($row['dob']);
            $displayDob = $dob->format('d-m-Y');
            ?>
            <tr>
                <th scope="row"><?php echo $count++; ?></th>
                <td><?php echo htmlspecialchars($row['regt_no']); ?></td>
                <td><?php echo htmlspecialchars($row['rank']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo $displayDob; ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo $displayDoj; ?></td>
                <td><?php echo htmlspecialchars($row['service']); ?></td>
                <td><?php echo htmlspecialchars($row['unit']); ?></td>
                <td><?php echo htmlspecialchars($row['ame_details']); ?></td>
                <td><?php echo $displayAmeDate; ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['lmc']); ?></td>
                <td><?php echo $displayLmcDate; ?></td>
                <td><?php echo htmlspecialchars($row['duration']); ?></td>
                <td><?php echo $displayDueDate; ?></td>
                <td><?php echo htmlspecialchars($row['percentage_disability']); ?></td>
                <td><?php echo htmlspecialchars($row['category_after_lmc']); ?></td>
                <td><?php echo htmlspecialchars($row['diseases']); ?></td>
            </tr>
            <?php
        }
    } else {
        // If no results were found in both tables
        ?>
        <tr>
            <td colspan="17">No Record Found</td>
        </tr>
        <?php
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
