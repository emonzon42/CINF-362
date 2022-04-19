<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Practice</title>
    <meta name="description" content="Just a page for practicing SQL.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        form {
            width: 500px;
            margin: 0 auto;
            border: 2px solid black;
            padding: 5px;
        }

        label,
        input,
        span,
        button {
            display: block;
            margin-top: 5px;
        }

        span {
            color: red;
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

        .container {
            display: flex;
        }

        main {
            width: 60%;
        }

        aside {
            width: 40%;
        }

    </style>
</head>

<body>

    <?php    
    // Our message is empty initially and our view is false so users can't see the table
    $message = "";
    $view = false;
    // Make our input and error output variables empty strings initially
    $fName = $lName = $age = $species = $email = "";
    $pIDErr = $fnameErr = $lnameErr = $ageErr = $speciesErr = $emailErr = "";
    $pIDErr2 = $fnameErr2 = $lnameErr2 = $ageErr2 = $speciesErr2 = $emailErr2 = "";
    
    function validate($data) {
        $data = trim($data); // Remove newlines and white spaces from beginning and end of lines
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Remove special characters such as '>' and '<'
        return $data;
    }
    
    // Has our form been submitted?
    if(isset($_POST['submit'])) {
        
        // Include relevant password information
        include 'pwd.php'; 

        // Create new connection through mysqli
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection and quit if it doesn't work
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        // echo "Connected successfully<br>"; This is to test your SQL connection

        // General checker to see if table exists (value of 1 means it does exist)
        $tableChecker = $conn->query("SHOW TABLES LIKE 'residents'")->num_rows;
        
        // Boolean value to determine if a query should be run
        $runQuery = true;
        
        // Check the value of our button with switch statement. Based on what was clicked, we will create a different SQL statement
        switch($_POST['submit']) {  
            // For viewing tables
            case 'view':
                if($tableChecker == 1) {
                    $sql = "SELECT * FROM residents";
                    $message = "<br>Your results:";
                    $view = true;
                } else {
                    $runQuery = false;
                    $message = "Table does not exist.";
                }
            break;
                
            // For creating tables
            case 'create':
                if($tableChecker == 1) {
                    $runQuery = false;
                    $message = "Table already exists.";
                } else {
                    // Save our query as a string, the below says to create a table named clients if it doesn't already exist. It will create a column called id and use it as the primary key. It also creates 3 other columns called firstname, lastname, and email which have various character limitations and aren't allowed to be null.
                    $sql = "CREATE TABLE residents (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
                    firstname VARCHAR(30) NOT NULL, 
                    lastname VARCHAR(30) NOT NULL,
                    email VARCHAR(50) NOT NULL);";
                    $message = "Table created successfully";
                }
                break;
             
            // For deleting tables
            case 'delete':
                if($tableChecker == 1) {
                    $sql = "DROP TABLE residents";
                    $message = "Table dropped successfully.";
                } else {
                    $runQuery = false;
                    $message = "Table does not exist.";
                }
                break;
                
            // For inserting new records
            case 'insert':
                if(empty($_POST['fnameInsert'])) {
                    $fnameErr = "Please provide a first name.";
                } else {
                    $fnameInsert = validate($_POST['fnameInsert']);
                }

                if(empty($_POST['lnameInsert'])) {
                    $lnameErr = "Please provide a last name.";
                } else {
                    $lnameInsert = validate($_POST['lnameInsert']);
                }

                if(empty($_POST['emailInsert'])) {
                    $emailErr = "Please provide an email.";
                } else {
                    $emailInsert = validate($_POST['emailInsert']);
                }
                
                if($fnameInsert && $lnameInsert && $emailInsert && $tableChecker == 1) {
                    $sql = "INSERT INTO residents (firstname, lastname, email) VALUES ('$fnameInsert', '$lnameInsert', '$emailInsert')";
                    $message = "Customer added successfully.";
                } else {
                    $runQuery = false;
                    $message = "Please fill out all of the insert fields.";
                }
                break;
                
            // For updating old records
            case 'update':
                if(empty($_POST['pIDUpdate'])) {
                    $pIDErr = "Please provide a valid ID.";
                } else {
                    $pIDUpdate = validate($_POST['pIDUpdate']);
                }
                
                if(empty($_POST['fnameUpdate'])) {
                    $fnameErr2 = "Please provide a first name.";
                } else {
                    $fnameUpdate = validate($_POST['fnameUpdate']);
                }

                if(empty($_POST['lnameUpdate'])) {
                    $lnameErr2 = "Please provide a last name.";
                } else {
                    $lnameUpdate = validate($_POST['lnameUpdate']);
                }

                if(empty($_POST['emailUpdate'])) {
                    $emailErr2 = "Please provide an email.";
                } else {
                    $emailUpdate = validate($_POST['emailUpdate']);
                }
                
                if($pIDUpdate && $fnameUpdate && $lnameUpdate && $emailUpdate && $tableChecker == 1) {
                    $sql = "UPDATE residents SET firstname = '$fnameUpdate', lastname = '$lnameUpdate', email = '$emailUpdate' WHERE id = '$pIDUpdate'";
                    $message = "Customer updated successfully.";
                } else {
                    $runQuery = false;
                    $message = "Table does not exist";
                }
                break;
                
            default:
                break;
        }
        
            if($runQuery) {
                // Set our query results on the database to a variable
                $result = $conn->query($sql);
                
                // If the create table query we ran on the database is bad, let the user know.
                if (!$result) {
                    $message =  "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
        
        // Close connection - ALWAYS DO THIS
        $conn->close();
    }
    ?>
    <div class="container">
        <main>
            <form name="form" method="post" action="">
                <p>Use the button below to create a new residents table.</p>
                <button type="submit" name="submit" value="create">Create residents Table</button>
                <hr>

                <p>Use the fields below to add new residents to your table.</p>
                <label for="fname">First Name:</label>
                <input type="text" name="fnameInsert">
                <span class="error"><?php echo "$fnameErr"; ?></span>

                <label for="lname">Last Name:</label>
                <input type="text" name="lnameInsert">
                <span class="error"><?php echo "$lnameErr"; ?></span>

                <label for="email">Email:</label>
                <input type="text" name="emailInsert">
                <span class="error"><?php echo "$emailErr"; ?></span>
                <button type="submit" name="submit" value="insert">Insert New Customer</button>

                <hr>
                <p>Use the fields below to update any residents in your table.</p>
                <label for="pID">ID #:</label>
                <input type="text" name="pIDUpdate">
                <span class="error"><?php echo "$pIDErr"; ?></span>

                <label for="fname">First Name:</label>
                <input type="text" name="fnameUpdate">
                <span class="error"><?php echo "$fnameErr2"; ?></span>

                <label for="lname">Last Name:</label>
                <input type="text" name="lnameUpdate">
                <span class="error"><?php echo "$lnameErr2"; ?></span>

                <label for="email">Email:</label>
                <input type="text" name="emailUpdate">
                <span class="error"><?php echo "$emailErr2"; ?></span>
                <button type="submit" name="submit" value="update">Update Customer</button>

                <hr>
                <p>Use the button below to view your table.</p>
                <button type="submit" name="submit" value="view">View residents Table</button>

                <hr>

                <p>Use the button below to delete your table entirely.</p>
                <button type="submit" name="submit" value="delete">Delete residents Table</button>
            </form>
        </main>
        <aside>
            <span><?php echo "$message"; ?></span>
            <?php
                // If view is true, we know the user is selecting stuff from our table
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
        </aside>
    </div>
</body>

</html>
