<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Database Example</title>
    <meta name="description" content="Just a page for practicing SQL.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .instructions, .container {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
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
        form {
            max-width: 500px;
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
    $message = "";
    $view = false;
    
    function validate($data) {
        $data = trim($data); // Remove newlines and white spaces from beginning and end of lines
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Remove special characters such as '>' and '<'
        return $data;
    }
    
    // Has our form been submitted?
    if(isset($_POST['submit'])) {
        // Include relevant password information. We don't want it hard-coded directly in this page. 
        include 'pwd.php'; 

        // Create new connection through mysqli using the four pieces of credentials
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection and quit if it doesn't work
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        // echo "Connected successfully<br>"; This is to test your SQL connection
        
        // Check the value of our button with switch statement. Based on what was clicked, we will create a different SQL statement. If select is clicked, we set view to true so the user can view our table.
        switch($_POST['submit']) {  
            case 'view':
                    $sql = "SELECT * FROM users";
                    $message = "<br>Your results:";
                    $view = true;
                break;
                
            // For creating tables
            case 'create':
                    $sql = "CREATE TABLE users (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
                    firstname VARCHAR(30) NOT NULL, 
                    lastname VARCHAR(30) NOT NULL,
                    email VARCHAR(50) NOT NULL);";
                    $message = "Table created successfully";
                break;
             
            // For deleting tables
            case 'delete':
                    $sql = "DROP TABLE users";
                    $message = "Table dropped successfully.";
                break;
                
            // For inserting new records
            // You can insert more than one row at once
            // Each set of values in parenthesis should be separated by a comma
            case 'insert':                    
                    $sql = "INSERT INTO users (firstname, lastname, email) VALUES ('Chris', 'Velez', 'cvelez@albany.edu'), ('Tony', 'Stark', 'tstark@mail.com'), ('Steve', 'Rogers', 'srogers@mail.com')";
                    $message = "User added successfully.";
                break;
                
            // For inserting new records...uncomment the lines below up until break to have this work on your page.
            /*case 'update':
                    $pIDUpdate = validate($_POST['pIDUpdate']);
                    $fnameUpdate = validate($_POST['fnameUpdate']);
                    $lnameUpdate = validate($_POST['lnameUpdate']);
                    $emailUpdate = validate($_POST['emailUpdate']);
                    $sql = "UPDATE users SET firstname = '$fnameUpdate', lastname = '$lnameUpdate', email = '$emailUpdate' WHERE id = '$pIDUpdate'";
                    $message = "User updated successfully.";
                break;
            */
                
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
    <div class="instructions">
        <h1>Example Database Page</h1>
        <p>The form below will allow you to create a table, insert multiple new rows, update the table's existing data, view the table, and delete the table. If you try to perform actions on the table when it doesn't exist, it will produce an error. Also, if you try to create a table when it already exists, a different error is output. All errors/output messages will be displayed on the right side  of the screen.</p>
    </div>
    <div class="container">
        <main>
            <form name="form" method="post" action="">
                <p>Use the button below to create a new users table.</p>
                <button type="submit" name="submit" value="create">Create Users Table</button>
                <hr>

                <p>Click the button below to add 3 users to your table. The users will be automatically generated rather than provided through user input. You'll need to create functionality for inserting them into the database for your assignment this week.</p>
                <button type="submit" name="submit" value="insert">Insert New Users</button>

                <hr>
                <p>Use the fields below to update any users in your table. Please note that this won't work in the class example version because I've commented out the Update code.</p>
                <label for="pID">ID #:</label>
                <input type="text" name="pIDUpdate">

                <label for="fname">First Name:</label>
                <input type="text" name="fnameUpdate">

                <label for="lname">Last Name:</label>
                <input type="text" name="lnameUpdate">

                <label for="email">Email:</label>
                <input type="text" name="emailUpdate">
                <button type="submit" name="submit" value="update">Update User</button>

                <hr>
                <p>Use the button below to view your table.</p>
                <button type="submit" name="submit" value="view">View Users Table</button>

                <hr>

                <p>Use the button below to delete your table entirely.</p>
                <button type="submit" name="submit" value="delete">Delete Users Table</button>
                
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
