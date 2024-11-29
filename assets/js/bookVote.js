let stars;

window.onload = function(){
    var slider = document.getElementsByClassName('star-vote')[0];
   for (let j = 0; j < 5; j++) {
        var subElem = document.createElement("button");
        subElem.className = "starBtns";
        subElem.id = "star-"+j;
        subElem.setAttribute("starIndex", j);
        subElem.innerHTML = "<i class='my-star-yellow bi bi-star'></i>";
        subElem.addEventListener("mouseenter", starHover);
        subElem.addEventListener("mouseleave", starHoverEnd);
        subElem.addEventListener("click", starVote);
        slider.appendChild(subElem);
    }

    stars = document.getElementsByClassName('starBtns');
}

function starHover(e){

    var star = e.currentTarget;
    var starId = star.getAttribute("starIndex");
   
    for (let i = 0; i < stars.length; i++) {
        const element = stars[i];
        if(i<=starId){
            element.getElementsByTagName("i")[0].classList.remove("bi-star");
            element.getElementsByTagName("i")[0].classList.add("bi-star-fill");
        }
        else{
            element.getElementsByTagName("i")[0].classList.add("bi-star");
            element.getElementsByTagName("i")[0].classList.remove("bi-star-fill");
        }
    }
    //console.log("Hover: "+star);
}

function starHoverEnd(e){

    var star = e.currentTarget;

    for (let i = 0; i < stars.length; i++) {
        const element = stars[i];
        var activeVote = document.getElementsByName('ratingValue')[0].value;
        if(activeVote=="") activeVote = -1;
       if(i > activeVote){
        element.getElementsByTagName("i")[0].classList.add("bi-star");
        element.getElementsByTagName("i")[0].classList.remove("bi-star-fill");
       }else{
        element.getElementsByTagName("i")[0].classList.remove("bi-star");
            element.getElementsByTagName("i")[0].classList.add("bi-star-fill");
       }
    }
}

function starVote(e){
    e.preventDefault();
    var star = e.currentTarget;
    var starId = star.getAttribute("starIndex");
    //console.log("Click: "+starId);
    document.getElementsByName('ratingValue')[0].value = (starId+1);
}
