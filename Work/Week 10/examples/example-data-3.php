<?php

    // Check to make sure the method used to request this page was GET
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        
        // Converts our value to a number (should be 1-3)
        $data = intval($_GET["data"]);

        // Prefilled array with information about some friends.
        // Please note that this information could be stored in any format
        $friends = ["Yinnelle:She loves to watch videos.", "Bruno:We don't talk about Bruno.", "Tony:He loves to play video games.", "Josh:He loves to cook."];

        // We split the currently grabbed friend $friends[$data] by a colon using the explode method
        $retrievedFriendInfo = explode(":", $friends[$data]);

        // Echo our data using our newly created split array (first value is name, second value is their hobby)
        echo "You picked " . $retrievedFriendInfo[0] . ". " . $retrievedFriendInfo[1];
        
    }
    

?>
