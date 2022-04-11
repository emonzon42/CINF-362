<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP Exercise</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 1em;
            font-size: 1.25em;
        }
    </style>
</head>

<body>
    <h1>PHP Exercise Output Page</h1>
    <p>If you visit this page directly, you won't be able see a box displayed below (unless you're resubmitting previous form values). However, if you go to input.php, you can enter information to create a box on this page. A div with the provided width, height, and background color should be created below if the user has supplied valid inputs. Otherwise, an error message should appear telling them what they did incorrectly.</p>
    
    <p>Since I use the "GET" method, you can see the variables passed from the previous page in the URL for this page. If you edit those values in the URL and then hit enter, the new values should apply on the page.</p>
    <?php 
    // Add PHP code in here
        if (isset($_GET['submit'])) {
            if(empty($_GET['width']) || empty($_GET['height']) || empty($_GET['color']) || empty($_GET['border']) || empty($_GET['msg'])){
                echo "Please provide any missing values";
            } else{
                if(is_numeric($_GET['width']) && is_numeric($_GET['height'])){
                    $width = $_GET['width'];
                    $height = $_GET['height'];
                    $color = $_GET['color'];
                    $border = $_GET['border'];
                    $msg = $_GET['msg'];

                    echo "<div style='width: "."$width"."px; height: "."$height"."px; background: "."$color; border: "."$border;'>
                    <p>"."$msg"."</p>
                    </div>";
                } else{
                    echo "Please submit numerical values for the width/height.";
                }
            }
        }
    ?>

</body>

</html>
