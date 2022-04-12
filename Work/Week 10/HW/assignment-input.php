<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AJAX &amp; PHP Exercise</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid black;
            padding: 0 1em 1em;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        h1 {
            max-width: 800px;
            margin: 0 auto;
            background: #46166b;
            color: #EEB211;
            padding: .25em;
            border: 2px solid black;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

    </style>
</head>

<body>
    <h1>AJAX &amp; PHP Exercise</h1>
    <div class="container">

        <p>Your task is to use AJAX to pull data from a PHP page and display it on this page. The page with the data you want is "assignment-data.php" and it contains an array with numerous fruits. You'll add HTML/JS to this page and PHP code to the other page to complete this assignment. </p>
        
        <h3>Fruit Autofiller</h3>
        <!-- Create an input with an id and name of fruitInput. Its type should be text -->
        <label for "fruitInput">Enter a Fruit</label>
        <input name="fruitInput" id="fruitInput">


        <!-- Create a div with an id of fruitOutput, and place a p tag inside of it with "Please enter a fruit." inside the p tag  -->
        <div id="fruitOutput">Please enter a fruit.</div>
        
        <script>
            
            // Fill the parenthesis for the getElementById function. It should match the id of your input
            document.getElementById('fruitInput').onkeyup = function() {

                // Create a variable called fruit and store the value of our input in it (this.value)
                let fruit = this.value;

                // Fill the parenthesis - Check to see if our fruit variabl is equal to empty strings
                if (empty(fruit)) {
                    
                    // Output "<p>Please enter a fruit.</p>" to the div tag with an id of fruitOutput
                    document.getElementById('fruitOutput').innerHTML = "<p>Please enter a fruit.</p>";

                    
                } else {
                    
                    // Create a variable called myRequest and store a new XMLHttpRequest in it
                    let myRequest = new XMLHttpRequest();

                    // Create a function for when the ready state changes for your myRequest
                    
                    // Inside of that function will be an if statement to check the readyState (4) and status (200) of our request
                    // You can refer to our request with "this" 
                    // Inside of the if statement, you'll output this.responseText to the div tag with an id of fruitOutput 
                    myRequest.onreadystatechange = function(){

                        if(this.status == 200 && this.readyState == 4){
                            document.getElementById('fruitOutput').innerHTML = "<p>"+this.responseText+"</p>";
                        }

                    }

                    myRequest.open("GET", "assignment-data.php?fruitInput="+fruit,true);

                    myRequest.send();
                    

                    // Use the .open() method on the myRequest variable. It should use three arguments
                    // "GET" should be the first argument
                    // assignment-data.php?fruitInput=" concatenated with the fruit variable should be the 2nd argument
                    // true should be the third argument
                    

                    // Use the .send() method on myRequest
                    
                }

            }

        </script>
    </div>


</body>

</html>
