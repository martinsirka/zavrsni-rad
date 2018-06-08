
function myFunction() {
    var hideComm = document.querySelector(".comment");
    if (hideComm.style.display === "none") {
        hideComm.style.display = "block";
        document.querySelector(".hide-comm-btn").innerHTML="Hide comments";
        
    } else {
        hideComm.style.display = "none";
        document.querySelector(".hide-comm-btn").innerHTML="Show comments";
    }
}



function warrning() {
    var conf = confirm('Do you really want to delete this post?');
}



