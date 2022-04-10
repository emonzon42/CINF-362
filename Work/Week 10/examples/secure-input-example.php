<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Secure Input Example</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h1>Secure Input Example</h1>
        <p class="warning">WARNING: You won't be able to see my comments in the code below by viewing the page source. Please open the "examples" folder from this week's "CINF362-Week-10-Lecture-Notes.zip" folder to view the code in the examples provided. To have the page work on your local machine, you'd need to install a local web server with PHP on it. 000webhost has PHP already installed so just take all files found in that folder and place them on there as an alternative to doing that. After clicking submit, the page may refresh...that's okay. Just scroll down and you'll see the expected output.</p>

        <p>The code used below is an example for making your forms a little more secure. We will go over more thorough examples in the last week of class. However, the bits of code present in the form's action attribute and in the PHP help start the process for sanitizing/validating user input. </p>
        
        <!--
            The echo statement below causes the page to submit to itself securely
        -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="width">Width: </label>
            <input type="text" name="width" id="width">
            <label for="height">Height: </label>
            <input type="text" name="height" id="height">
            <label for="color">Color: </label>
            <input type="text" name="color" id="color">
            <button type="submit" name="submit">Submit</button>
        </form>

        <?php 
            // If the method used to send this information to the server was post, execute this code.
            // If you change the method to get, the if portion will never execute.
            // The $_SERVER[] super global array is just like $_POST[] or $_GET[] 
            // The main difference is that post and get only contain info about what was passed from the form submission.
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                echo "<p>The form was submitted!</p>";
                $width = $_POST['width'];
                $height = $_POST['height'];
                $color = $_POST['color'];
                echo "<p>Width provided is $width, height is $height, and color is $color.</p>";
            } else { // If nothing has been sent to the server, execute this code.
                echo "<p>You haven't submitted the form yet!</p>";
            }
            
            // This include points to the same table that was in the week 10 example
            echo "<p>This table was created from the same include used in the week 9 example.</p>";
            include "table.php";
        ?>
    </div>


</body>

</html>
