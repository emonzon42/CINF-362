<?php

// Your array of yummy fruits
$fruitsArray = array("Acerola", "Apple", "Apricot", "Avocado", "Banana", "Blackberries", "Bluerberries", "Cantaloupe", "Carambola", "Cherimoya", "Cherries", "Clementine", "Crannberries", "Dates", "Durian", "Elderberries", "Feijoa", "Figs", "Gooseberries", "Grapefruit", "Grapes", "Honeydew Melon", "Jujube Fruit", "Kiwi", "Kumquat", "Lemon", "Lime", "Mandarin", "Mango", "Nectarine", "Olive", "Orange", "Papaya", "Peaches", "Pear", "Pineapple", "Plantain", "Plum", "Pomegranate", "Quince", "Raspberries", "Strawberries", "Tamarind", "Tangerine", "Watermelon");

// Create a variable called returnedFruit and assign an empty string to it
$returnedFruit = "";
// Check if our server used GET for the request method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    // Create a variable called submittedFruit and set it to our fruitInput data from $_GET
    $submittedFruit = $_GET['fruitInput'];

        
    // Add text to the parenthesis for the foreach loop using the fruitsArray as the first part and $fruit as the 2nd part ($fruitsArray as $fruit)
    foreach ($fruitsArray as $fruit) {

        // Use the stripos function to see if our fruit is found in the array
        // The first arguement should be our current fruit ($fruit)
        // The second argument should be our submitted fruit ($submittedFruit)
        // The result of the stripos function must be equal to 0 (=== 0)

        
        if (stripos($fruit,$submittedFruit) === 0) {

            // Set returnedFruit equal to itself plus $fruit
            // Make sure to surround the fruit variable in li tags
            // You can add something to itself using ".=" when you assign it
            $returnedFruit .= "<li>" .$fruit . "</li>";


        } 
        
    }
    
}

// Check if our returnedFruit variable is not equal to an empty string
if ($returnedFruit != "") {
    
    // Echo the returnedFruit variable
    echo $returnedFruit;
    
} else {
    
    // Echo "<p>No fruit found.</p>"
    echo "<p>No fruit found.</p>";
    
}


?>
