
function openPage(pageName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    

}

function onClickUser(){
    $("#events.content").hide();
    $("#users.content").show();
}
function onClickEvent(){
    $("#events.content").show();
    $("#users.content").hide();
}

function deleteUser() {
        var x;
        var r = confirm("Confirm delete this user?");
        if (r == true) {
            return event.preventDefault(); document.getElementById('delete-{{$user->id}}').submit();
        }
        else { 
            return; 
        }
        document.getElementById("deleteButton").innerHTML = x;
}
// Get the element with id="defaultOpen" and click on it

$(document).ready(function(e){
    $("#events.content").hide();
    // document.getElementById("defaultOpen").click();    
    // openPage($("#defaultOpen"));
    // $("#users.content").hide();
});