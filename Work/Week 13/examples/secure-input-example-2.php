<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Security Example</title>
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
            width: 700px;
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
        $fName = $lName = $age = $species = $email = "";
        
        // This function takes in data and returns it after cleaning it up
        function validate($data) {
            $data = trim($data); // Remove newlines and white spaces from beginning and end of lines
            $data = stripslashes($data); // Remove backslashes
            $data = htmlspecialchars($data); // Remove special characters such as '>' and '<'
            return $data;
        }
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            switch($_POST['submit']) {
                    
                case 'create': 
                    $sql = "CREATE TABLE IF NOT EXISTS customers (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
                    firstname VARCHAR(30) NOT NULL, 
                    lastname VARCHAR(30) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    age INT(3) NOT NULL,
                    species VARCHAR(15) NOT NULL);";
                    $message = "Table created successfully.";
                    break;
                    
                case 'populate':                    
                    $sql = "INSERT INTO customers (firstname, lastname, email, age, species) 
                    VALUES ('Chris', 'Velez', 'cvelez@albany.edu', 28, 'human'), 
                    ('Chester', 'Cheetah', 'ccheetah@albany.edu', 32, 'cat'),
                    ('Scooby', 'Doo', 'sdoo@albany.edu', 7, 'dog'),
                    ('Smaug', '', 'smaug@albany.edu', 300, 'dragon'),
                    ('Big', 'Bird', 'bbird@albany.edu', 20, 'bird'),
                    ('Pink', 'Panther', 'ppanther@albany.edu', 17, 'cat');";
                    $message = "Table populated successfully.";
                    break;
                    
                case 'view': 
                    $sql = "SELECT * FROM customers;";
                    $view = true;
                    break;
                    
                // We drop the table ONLY if it exists
                case 'drop':
                    $sql = "DROP TABLE IF EXISTS customers";
                    $message = "Table dropped succesfully.";
                    break;
                
                case 'insert':
                    $fName = validate($_POST['fNameInsert']);
                    $lName = validate($_POST['lNameInsert']);
                    $email = validate($_POST['emailInsert']);
                    $age = validate($_POST['ageInsert']);
                    $species = validate($_POST['speciesInsert']);
                    // Entering data directly into the query is bad practice
                    // Instead, we use the "?" wild card to represent that some value will take its place
                    $sql = "INSERT INTO customers (firstname, lastname, email, age, species) VALUES (?, ?, ?, ?, ?)";
                    $message = "Case inserted sucessfully.";
                    break;
                                
                default: 
                    break;
            }
            
            include 'pwd.php'; 

            $conn = new mysqli($servername, $username, $password, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                if($_POST['submit'] == "populate") {
                    $result = $conn->multi_query($sql);
                    if (!$result) {
                        $message =  "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else if ($_POST['submit'] == "insert") {
                    /* If we are performing an insert statement, we create a prepared statement. 
                    In the bind_param function, the first part (sssis) refers to the datatypes for the variables 
                    we are binding to our SQL statement. This allows us to prevent users from entering unexpected data types
                    of into our databases. s means string and i means integer.
                    If you recall from earlier, we used question marks in our SQL statement. Those question marks are replaced
                    by the variables in the bind_param line */
                    $statement = $conn->prepare($sql);
                    $statement->bind_param("sssis", $fName, $lName, $email, $age, $species);
                    if(!$statement->execute()) {
                        echo "Execute failed: (". $statement->errno . ") ". $statement->error;
                    }
                } else {
                    $result = $conn->query($sql);
                    if (!$result) {
                        $message =  "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                
                $conn->close();
            } 
        }
        ?>
        <div class="container">
            <main>
                <!-- The echo statement below causes the page to submit to itself securely -->
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <p>Use the buttons below to Create or Delete our Customers Table:</p>
                    <button type="submit" name="submit" value="create">Create Table</button>
                    <button type="submit" name="submit" value="populate">Populate Table</button>
                    <button type="submit" name="submit" value="view">View Table</button>
                    <button type="submit" name="submit" value="drop">Drop Table</button>

                    <hr>

                    <p>Use the inputs/button below to Insert new Customers into our Customers Table:</p>
                    <label for="fNameInsert">First Name:</label>
                    <input type="text" name="fNameInsert">

                    <label for="lNameInsert">Last Name:</label>
                    <input type="text" name="lNameInsert">

                    <label for="emailInsert">Email:</label>
                    <input type="text" name="emailInsert">

                    <label for="ageInsert">Age:</label>
                    <input type="text" name="ageInsert">

                    <label for="speciesInsert">Species:</label>
                    <input type="text" name="speciesInsert">
                    <button type="submit" name="submit" value="insert">Insert New Customer</button>

                    <p>
                        <?php echo "$message"; ?>
                    </p>
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
