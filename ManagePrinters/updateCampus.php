<?php
@include '../ConnectDB.php';

if (isset($_POST['campus'])) {
    $selectedCampus = $_POST['campus'];

    $query = "SELECT * FROM printer_list WHERE printer_campusloc = '$selectedCampus'";
    $result = $conn->query($query);

    if ($result) {
        // Process the query result
        $options = '';
        while ($row = $result->fetch_assoc()) {
            // Access the data from the row
            $columnValue = $row['printer_buildingloc'];
            // Generate the HTML code for each building option
            $options .= '<option class="embed" value="' . $columnValue . '">' . $columnValue . '</option>';
        }
        echo $options;
    } else {
        // Handle the case when the query fails
        echo "Error executing the query: " . $conn->error;
    }
}
?>