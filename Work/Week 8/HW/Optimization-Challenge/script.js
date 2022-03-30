// MINIFY ALL THE JS IN THIS FILE

// If the user clicks decline, hide the modal, and store expired cookies (deletes cookie)
document.getElementById("decline").onclick = function() {
    document.querySelector(".cookieModal").classList.add("hide");
    storeCookies("acceptedCookies", "", "yes");
    storeCookies("numVisits", "", "yes");
}

// If the user clicks accept, hide the modal, and store a cookie for their preferences and log their first officially tracked visit
document.getElementById("accept").onclick = function() {
    document.querySelector(".cookieModal").classList.add("hide");
    storeCookies("acceptedCookies", true, "no");
    visitsOutput();
}

// We assume that cookies are accepted be default
var acceptedCookies = false;

function checkVisits() {
    
    // Create a variable called numVisits and assign it a value of 0 since we assume visits are 0
    var numVisits = 0;

    // Get all our cookies and store them in a variable called "allCookies"
    var allCookies = document.cookie;

    // Split allCookies by semicolons and store it in an array called "SplitCookies"
    // This is because cookies are stored as a string separated by semicolons
    var splitCookies = allCookies.split(";");

    // Loop through each invidual cookie (splitCookies.length)
    for (var c = 0; c < splitCookies.length; c++) {

        // Create a new variable called cleanCookie and store splitCookies[c].trim(); to it
        var cleanCookie = splitCookies[c].trim();

        // Check to see if the user has accepted cookies already
        if (cleanCookie.indexOf("acceptedCookies") == 0) {
            acceptedCookies = true;
        }
        
        // Check to see if the cookie we are looking for exists (cleanCookie.indexOf())
        if (cleanCookie.indexOf("numVisits") == 0) {

            // If the cookie exists, split it by an equal sign
            var currentCookieSplit = cleanCookie.split("=");

            // Assign the second item in the currentCookieSplit array to the numVisits variable
            // The first item represents our cookie name while the second item represents its value
            numVisits = currentCookieSplit[1];
            
            numVisits++;    
        }
    }
    
    return numVisits;
}

// This function will generate output for the number of visits
function visitsOutput() {

    // Create a visits variable to store our number of visits (if any)
    var visits = checkVisits();

    // If visits is zero, we tell the user
    if (visits == 0) {
        
        // Store the numVisits cookie using 1 as the value if cookies have been accepted
        if(acceptedCookies == true) {
            storeCookies("numVisits", 1, "no");
        }

    } else {

        // Generate output to tell the user what visit # it is for them (use output.innerHTML)
        document.getElementById("person").innerHTML = "Friend";

        // Store the numVisits cookie using visits as the value
        storeCookies("numVisits", visits, "no");
    }

}

// Call our visitsOutput() function to get cookies stored
visitsOutput();

// Use this function to create cookies (takes in name, value, and whether it should expire)
// document.cookie should use string concatenation with name and value 
function storeCookies(name, value, expired) {
    
    var d = new Date();
    var expires = "";
    
    // Date and expiration created. 
    // If isn't an expired cookie, we set expiration for a month away.
    // If it is expired, we set the expiration in the past (deletes cookie)
    if(expired == "no") { 
        d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
        expires = "expires=" + d.toUTCString();  
    } else {
        expires = "expires=Thu, 01 Jan 1970 00:00:00 UTC"
    }
    
    // Cookie is created with parameters provided above
    document.cookie = name + "=" + value + "; " + expires + "; path=/";
}

document.getElementById("submitInfo").onclick = function() {
    var fName = document.getElementById("fName").value;
    var email = document.getElementById("email").value;
    
    if(fName == "" || email == "") {
        alert("Please fill out both fields before submitting.");
    } else {
        alert("Thank you " + fName + "! You have been subscribed to our newsletter.");
    }
    
}
