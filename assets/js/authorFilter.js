window.onload = function(){
    var kats = document.getElementsByClassName("kat");

    for(var i = 0; i<kats.length; i++)
        kats[i].addEventListener("click", function(e){
            if(this.checked){
                this.parentElement.style.backgroundColor = "#4B6587";
                this.parentElement.style.color = "white";
            }else{
                this.parentElement.style.backgroundColor = "";
                this.parentElement.style.color = "#4B6587";
            }
        });
}

function authorFilter() {
    var input, filter, container, label, span, i, txtValue;
    input = document.getElementById("authorInput");
    filter = input.value.toUpperCase();
    container = document.getElementById("authorsContainer");
    label = container.getElementsByTagName("label");
    for (i = 0; i < label.length; i++) {
        span = label[i].getElementsByTagName("span")[0];
        txtValue = span.textContent || span.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            label[i].style.display = "";
        } else {
            label[i].style.display = "none";
        }
    }
}