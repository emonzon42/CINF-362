//challenge 1
document.getElementById("subch1").onclick = function() {
    let first = document.getElementById("1num").value;
    let second = document.getElementById("2num").value;
    let third = document.getElementById("3num").value;
    let total = +first + +second + +third;
    let avg = total/3;

    document.getElementById("ch1output").innerHTML = "Your numbers are " + first + ", " + second + ", and " + third 
    + ". The total is " + total + " and the average is " + avg + ".";
}


//challenge 2
document.getElementById("subch2").onclick = function() {
    let name = document.getElementById("ch2").value;
    
    document.getElementById("ch2output").innerHTML = "Your name is " + name + ". This name is "+ name.length + " letters long, ";
    if (name.length < 5) {
        document.getElementById("ch2output").innerHTML += "this is a short name!";
    } else if(name.length <= 8) {
        document.getElementById("ch2output").innerHTML += "your name is average.";
    } else{
        document.getElementById("ch2output").innerHTML += "you have a long name.";
    }

    
}

//challenge 3
var animals = ["lion","monkey","cow"];
animals.forEach(ani => {
    document.getElementById("ch3output").innerHTML += "<li>"+ani+"</li>";
});
document.getElementById("subch3").onclick = function() {
    let animal = document.getElementById("ch3").value;

    animals.push(animal);

    document.getElementById("ch3output").innerHTML ="";
    animals.forEach(ani => {
        document.getElementById("ch3output").innerHTML += "<li>"+ani+"</li>";
    });
}

//challenge 4
var myInfo = {
    favColor: "yellow",
    age: "22",

    favQuote: function(){
        alert('"You never really know the true value of a moment, until it becomes a memory."');
    }
}      

document.getElementById("subch4").onclick = function() {
    
    alert("My favorite color is "+ myInfo.favColor+" and in "+(100-myInfo.age)+" years I will be 100.");

    myInfo.favQuote();

}