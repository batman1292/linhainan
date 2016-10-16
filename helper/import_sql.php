<html>
    <head>
        <style>
  
        </style>
        <script>

        </script>
    </head>
    <body>


<?php
if (isset($_FILES['sqlfile'])) {
    if (move_uploaded_file($_FILES["sqlfile"]["tmp_name"], "importSQL/" . $_FILES["sqlfile"]["name"])) {
        // Name of the file
        $filename = "importSQL/" . $_FILES['sqlfile']["name"];
// MySQL host
        $mysql_host = 'localhost';
// MySQL username
        $mysql_username = 'root';
// MySQL password
        $mysql_password = '';
// Database name
        $mysql_database = 'linhainan';
        set_time_limit(0);
// Connect to MySQL server
        mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());

        $sql = "DROP DATABASE $mysql_database";
        mysql_query($sql);
        $sql = "CREATE DATABASE $mysql_database";
        mysql_query($sql);

// Select database
        mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());
// Temporary variable, used to store current query
        $templine = '';
// Read in entire file
        $lines = file($filename);
// Loop through each line
        foreach ($lines as $line) {
// Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

// Add this line to the current segment
            $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
        }
        echo "Tables imported successfully"; 
//        lpana
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}
?>

            </body>
</html>
