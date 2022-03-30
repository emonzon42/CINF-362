<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP Example Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h1>PHP Output Example</h1>
        <p class="warning">WARNING: You won't be able to see my comments in the code below by viewing the page source. Please open the "examples" folder from this week's "CINF362-Week-9-Lecture-Notes.zip" folder to view the code in the examples provided. To have the page work on your local machine, you'd need to install a local web server with PHP on it. 000webhost has PHP already installed so just take all files found in that folder and place them on there as an alternative to doing that.</p>
        
        <h2>Creating Output from Another Page's Input</h2>
        <p>This page takes info from the input-example.php page. Specifically, it gets the info from the form with the action attribute set to "output-example.php". </p>
        
        <?php
        /* We get our values from the $_GET array and then use them. 
        Always check to see if the variable representing the button 
        is set first. If it isn't set, we know the user didn't click 
        submit and is trying to access our page through other means (directly). 
        
        To check if the button is set, we use the "isset" function. To generate
        output, we put HTML tags inside of the quotation marks in our echo statement. 
        This allows us to output HTML and text dynamically. 
        */
        
        if(isset($_GET['submitInfo'])) {
            $name = $_GET['name'];
            $likesMustard = $_GET['likesMustard'];

            echo "<h2>The name you entered is $name</h2>";

            if($likesMustard == "Yes") {
                echo "<p>EW! I can't believe you like mustard. Points off for you!</p>";
            } else if ($likesMustard == "No") {
                echo "<p>Whew! I thought you might have liked mustard. Your points are safe for now.</p>";
            } else {
                echo "<p>Uh oh, something wonky is happening. The answer should be yes or no.</p>";
            }
        } else {
            echo "<p>It appears as though you came to this page directly.</p>";
        }
        
    ?>
    </div>

</body>

</html>
