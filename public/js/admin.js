function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

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
// openPage('users', this, '#17202A')
$(document).ready(function(e){
    document.getElementById("defaultOpen").click();    
    openPage('users', $("#defaultOpen"), '#17202A')
    deleteUser();
});