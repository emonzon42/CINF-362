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

        input,
        label,
        button {
            display: block;
        }

        input {
            margin-bottom: 1em;
        }
    </style>
</head>

<body>
    <h1>PHP Exercise Input Page</h1>
    <p>Create a form that takes in three inputs. The three inputs are width, height, and color. After the user clicks submit, the information should be sent to the output.php page. On that page, you should have PHP code to check if the inputs were valid. Specifically, you should make sure that the inputs aren't empty and that the height/width inputs are non-zero numbers. Refer to the class examples on input validation and input/output for help with this assignment.</p>

    <p>Feel free to try 300, 300, aquamarine for your inputs. You can include 2px solid black, and whatever message you'd like for the extra credit portion. </p>

    <!-- Add HTML for your form here. Your form should have an action and methods attributes on it. Also, you should have a label for every input, and a button with a type of submit. Each input and the button should use a name attribute. This name attribute value will be passed to the output.php page for you to use. You must also use the id attribute to pair with the label for validation purposes. -->
    <FORM action=“output.php" method=“get”>
        <label for="width">width:</label><br> <!-- The labels "for" attribute value must match an id value -->
        <input name="width" type="number"><br> <!-- type can be changed to many other things -->
        
        <label for="height">height:</label><br>
        <input name="height" type="number"> <br><!-- type can be changed to many other things -->
        
        <label for="color">color:</label> <br>
        <input name="color" type="number"><br> <!-- type can be changed to many other things -->
        
        <label for="border">border:</label> <br>
        <input name="border" type="text"><br> <!-- type can be changed to many other things -->
        
        <label for="msg">message:</label> <br>
        <textarea name="msg" type="text"><br> <!-- type can be changed to many other things -->
        
        <button name="submit" type="submit">Submit Me!</button><br>
        
    </FORM>

</body>

</html>