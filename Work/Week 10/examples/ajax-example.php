<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AJAX &amp; PHP Examples</title>
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
    <h1>AJAX &amp; PHP Example</h1>
    <div class="container">
        
        <p>AJAX can be used to pull information from another file without reloading the page. Each example below uses AJAX to retrieve data from an external file. There are different methods for doing it, but ultimately, the goal is to make sure the request is ready, and then do things with the data after it is returned.</p>
        
        <h3>Example 1 (onload)</h3>
        <p>The button below retrieves content from example-data-1.txt and outputs it to our page in the p tag with an id of ex1output. The content is only retrieved when the request has fully loaded. Right-click the page and view the source to see how it works. </p>
        
        <!-- Our button and output area -->
        <!-- We use type="button" to prevent our button from submitting -->
        <button id="ex1" type="button">Retrieve Data</button>
        <p id="ex1output"></p>
        
        <script>
            
        // EXAMPLE 1  
        document.getElementById("ex1").onclick = function() {
            
            // Create a new XMLHttpRequest
            var request = new XMLHttpRequest();
            
            // When our request loads, trigger this function
            request.onload = function() {
                
                // Take the response text from our request we get and output it to our HTML
                document.getElementById("ex1output").innerHTML = this.responseText;
                
            }
            
            // This opens the request for data.txt using the GET method in an asynchronous manner (true)
            request.open("GET", "example-data-1.txt", true);
            
            // This sends the request to the server
            request.send();
            
        }
        
        </script>
        
        <hr>
        
        <h3>Example 2 (onreadystatechange)</h3>
        <p>The button below retrieves content from example-data-2.txt and outputs it to our page in the p tag with an id of ex2output. We use "onreadystatechange" which checks the various ready states of our request. The numbers range from 0 to 4. It also uses the status property to make sure the requested file is "OK" and available to send. Right-click the page and view the source to see how it works. </p>
        
        <!-- Our button and output area -->
        <!-- We use type="button" to prevent our button from submitting -->
        <button id="ex2" type="button">Retrieve Data</button>
        <p id="ex2output"></p>
        
        <script>
            
        // EXAMPLE 2  
        document.getElementById("ex2").onclick = function() {
            
            // Create a new XMLHttpRequest
            var request = new XMLHttpRequest();
            
            // Set an onreadystatechange function for the request
            request.onreadystatechange = function() {
                
                // Check if the status is 200 (OK)
                // Check if the readyState is 4 (request is finished and response is ready)
                if(this.status == 200 && this.readyState == 4) {
                    
                    // Take the response text we get and output it to our HTML
                    document.getElementById("ex2output").innerHTML = this.responseText;
                }
                
            }
            
            // This opens the request. 
            request.open("GET", "example-data-2.txt", true);
            
            // This sends the request to the server
            request.send();
            
        }
        
        </script>
        
        <hr>
        
        <h3>Example 3 (AJAX and PHP)</h3>
        <p>In this example, we use AJAX to send data from our form to a PHP page. Instead of going to that other page and generating output, we'll work with the data with that external php file, and return it to this page for displaying. The main difference will be in our .open function. Instead of a .txt file, we'll point to a php file with a value.</p>
        
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
            <select id="friends" name="friends">
                <option value="">Select a Person:</option>
                <option value="0">Yinnelle</option>
                <option value="1">Bruno</option>
                <option value="2">Tony</option>
                <option value="3">Josh</option>
            </select>
        </form>
        <p id="ex3output"></p>
        <script>
            
            // Create a function that's triggered when our option tag changes
            document.getElementById("friends").onchange = function() {
                
                // Get the value of the currently selected option tag
                var currentFriend = this.value;
                
                // If it's empty, tell the user
                if(currentFriend == "") {
                    document.getElementById("ex3output").innerHTML = "Please select a friend from the list.";
                } else {
                    // If it's not empty, make a new HTTP request
                    var request = new XMLHttpRequest();
                    
                    // Create a function that will check our ready state when it changes
                    request.onreadystatechange = function() {
                        
                        // If the readyState and status are good, grab the response text
                        if(this.readyState == 4 && this.status == 200) {
                            document.getElementById("ex3output").innerHTML = this.responseText;
                        }
                    }
                    
                    // Send our request to a PHP page using data as the name and currentFriend as the value
                    request.open("GET", "example-data-3.php?data=" + currentFriend, true);
                    request.send();
                }
            }
            
        </script>
    </div>
    
    
</body>

</html>
