$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $("#location").keydown(function(event){
        if(event.keyCode == 13) {
            $("#submit").click();
        }
    })

    $("#precondition").keydown(function(event){
        if(event.keyCode == 13) {
            document.getElementById("precondition").value = document.getElementById("precondition").value + "\n*";
        }
    })
    $("#detail").keydown(function(event){
        if(event.keyCode == 13) {
            document.getElementById("detail").value = document.getElementById("detail").value + "\n*";
        }
    })
});