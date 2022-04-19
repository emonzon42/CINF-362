<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Database Challenge 2</title>
    <style>
        form {
            width: 500px;
            margin: 0 auto;
            border: 2px solid black;
            padding: 5px;
        }

        label,
        input {
            display: block;
            margin-top: 5px;
        }

        table,
        th,
        td {
            width: 500px;
            margin: 20px auto;
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body>

    <?php    
    // Our message is empty initially and our view is false so users can't see the table
    // $view becomes true only if the submit button with a value of "view" is clicked
    $message = "";
    $view = false;
    
    if(isset($_POST['submit'])) { // Has our form been submitted?
            
        include 'pwd.php';
            
        // Create new connection through mysqli using the four pieces of credentials
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection and quit if it doesn't work
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
            
        // Use switch to see which button was submitted (same as if/else if/else)
        switch($_POST['submit']) {
            // Used for creating our table
            case 'create': 
                $sql = "CREATE TABLE people (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
                firstname VARCHAR(30) NOT NULL, 
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL);";
                $message = "Table created successfully";
                break;

            // ADD CODE FOR YOUR INSERT STATEMENT HERE
            

            // Used for dropping our table
            case 'delete':
                $sql = "DROP TABLE people";
                $message = "Table dropped succesfully";
                break;

            // Used for viewing our table after some inserts have been done
            case 'view': 
                $sql = "SELECT * FROM people";
                $message = "<br>Your results:";
                $view = true;
                break;

            // Defaults to nothing if we don't get an appropriate value
            default: 
                break;
        }
            
        // Set our query results on the database to a variable
        $result = $conn->query($sql);

        // If the create table query we ran on the database is bad, let the user know.
        if (!$result) {
            $message =  "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection - ALWAYS DO THIS
        $conn->close();
    }
?>


    <form name="myForm" action="" method="post">
        <p>Use the buttons below to Create or Delete our people Table:</p>
        <button type="submit" name="submit" value="create">Create Table</button>
        <button type="submit" name="submit" value="delete">Delete Table</button>

        <!-- ADD YOUR INPUTS, LABELS, AND NEW BUTTON TO THIS FORM -->
        

        <button type="submit" name="submit" value="view">View People Table</button>
        <p>
            <?php echo "$message"; ?>
        </p>
    </form>


    <?php 
        if($view) {
            echo "<table>";
            echo "<tr><th>IDs</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["email"] . "</td></tr>";
            }
            echo "</table>";  
        }
        ?>
</body>

</html>
