$(document).ready(function(){
    var commentCount = 1;
    var content;

    for (var i = 0; i < 3; i++) {
        content = $('#comment' + commentCount)[0];
        content.style.display = "block";
        commentCount++;  
    }
    
    $("#comments-load-btn").click(function(){
        for (i = 0; i < 2; i++) {
            content = $('#comment' + commentCount)[0];
            content.style.display = "block";
            commentCount++;  
        }                
    });
});