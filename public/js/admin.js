
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
    $("#createEvent.content").hide();
}
function onClickEvent(){
    $("#events.content").show();
    $("#users.content").hide();
    $("#createEvent.content").hide();
}
function onClickCreateEvent() {
    $("#createEvent.content").show();
    $("#events.content").hide();
    $("#users.content").hide();

}
// Get the element with id="defaultOpen" and click on it

$(document).ready(function(e){
        $("#events.content").hide();
        $("#createEvent.content").hide();
});