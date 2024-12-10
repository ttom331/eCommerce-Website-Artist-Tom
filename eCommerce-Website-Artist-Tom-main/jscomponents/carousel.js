//slideshow ------------------------------------------>

    var myIndex = 0;
    var myIndex2 = 0;
    var myIndex3 = 0;
    carousel();
    carousel2();
    carousel3();

    function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
    }

    function carousel2() {
    var i;
    var x = document.getElementsByClassName("mySlides1"); //retrives all the elements/image in the classname and stores them
    for (i = 0; i < x.length; i++) { //iterates thorugg each image and sets the display to none
        x[i].style.display = "none";  
    }
    myIndex2++; //this keeps track of the currently visisble image.
    if (myIndex2 > x.length) {myIndex2 = 1}    
    x[myIndex2-1].style.display = "block";  
    setTimeout(carousel2, 2000); // Change image every 2 seconds
    }

    function carousel3() {
        var i;
        var x = document.getElementsByClassName("mySlides2"); //retrives all the elements/image in the classname and stores them
        for (i = 0; i < x.length; i++) { //iterates thorugg each image and sets the display to none
            x[i].style.display = "none";  
        }
        myIndex3++; //this keeps track of the currently visisble image.
        if (myIndex3 > x.length) {myIndex3 = 1}    
        x[myIndex3-1].style.display = "block";  
        setTimeout(carousel3, 2000); // Change image every 2 seconds
    }
