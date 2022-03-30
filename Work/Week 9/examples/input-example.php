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
        
        <h1>PHP Input Examples</h1>
        <p class="warning">WARNING: You won't be able to see my comments in the code below by viewing the page source. Please open the "examples" folder from this week's "CINF362-Week-9-Lecture-Notes.zip" folder to view the code in the examples provided. To have the page work on your local machine, you'd need to install a local web server with PHP on it. 000webhost has PHP already installed so just take all files found in that folder and place them on there as an alternative to doing that. After clicking submit, the page may refresh...that's okay. Just scroll down and you'll see the expected output.</p>
        
        <h2>Working with Forms</h2>
        <p>PHP is awesome for working with forms. The examples below contain various forms that can work with input data. Some data will be used to create dynamic content on this page while some data will be passed to other pages. In order for the buttons to link to our pages correctly, the type attribute must be set to submit. You can use a button or an input tag with a type of submit to send data. The important thing is that you use either get or post on all pages using the data.</p>
        <hr>
        
        <h3>Using Form Data in the Same Page</h3>
        <p>This form will take in your name and then echo it directly below the form in a paragraph tag. For this, you would leave the action attribute empty. You could also omit the action attribute entirely. This uses post as the method.</p>
        <form name="form" action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <button type="submit" name="submit">Submit Name</button>
        </form>
        <?php
            /* I use isset() to check for a value being submitted. Specifically, it looks
            to check if the submit value in the $_POST[] array has been set. When 
            the user clicks submit, all parts of the form with a name attribute get added to
            our $_POST array and are 'set.' We can then reference them by their attribute value. */
        
            if(isset($_POST['submit'])){ // Use isset to check our submit button
                $name = $_POST['name']; // Get our input value by the name attribute
                echo "<p>The name you entered is $name</p>";
            }
        ?>
        <hr>
        
        <h3>Using Form Data in a Different Page</h3>
        <p>This form will take in your name and ask you a question. It will then pass that data to a new page using a get request. I've set my action attribute to "output-example.php" which is a page that will use our code.</p>
        <form name="form2" action="output-example.php" method="get">
            <label for="name">Name:</label>
            <input type="text" name="name">
            <br>
            <p>Do you like mustard? Choose wisely...</p>
            
            <label for="mustard">Yes</label>
            <input id="mustard" type="radio" name="likesMustard" value="Yes">
            
            <label for="noMustard">No</label>
            <input id="noMustard" type="radio" name="likesMustard" value = "No">
            
            <input type="submit" name="submitInfo" value="Submit Info">
        </form>
        <hr>
        
        <h3>Validating Form Input</h3>
        <p>This form will take in two pieces of information, our favorite food and favorite number. After the user clicks submit, the form will check to see if values were submitted. If values are present, it will check to make sure they are the right type (string or number). If they are, you will see correct output. If they aren't correct or empty, error messages will appear. Please note that if you enter 0, it will be considered "empty" by the empty() method. That's not a bug but rather a known feature in PHP. There are other ways to check but empty will suit us for now.</p>
        
        <form name="form3" method="get">
            <label for="food">Favorite Food:</label>
            <input type="text" name="food"><br>
            
            <label for="number">Favorite Number:</label>
            <input type="text" name="number"><br>
            <button type="submit" name="submitFavs">Submit Favorites</button>
        </form>
        
        <?php
        /* First, we check to see if our submit button has been "set." If it has, then we can check
        our variables. If they are empty, we alert the user. If they aren't empty, we then check
        to see if the favorite number provided is actually a number. If it isn't we alert the user. 
        If all inputs are correct, then we output results. */
        
        if(isset($_GET['submitFavs'])) {
            // Are they empty?
            if(empty($_GET['food']) || empty ($_GET['number'])) { 
                echo "<p class='red'>Please submit your favorite food and number.</p>";
            } else {
                // Is the number provided actually a number?
                if(is_numeric($_GET['number'])) { 
                    $favNum = $_GET['number'];
                    $favFood = $_GET['food'];
                    echo "<p>Your favorite number is $favNum and you like $favFood.</p>";
                } else {
                    echo "<p class='red'>Please submit a valid number.</p>";
                }
            }
        }
        
        ?>
    </div>

</body>

</html>
