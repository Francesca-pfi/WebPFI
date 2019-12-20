$(document).ready(function(){
    //affiche trois commentaires par défaut
    var commentCount = 1;
    var content;

    for (var i = 0; i < 3; i++) {
        content = $('#comment' + commentCount)[0];
        if(typeof content !== "undefined")
        {
            content.style.display = "block";
        }       
        commentCount++;  
    }
    
    //et deux de plus quand on click sur le bouton
    $("#comments-load-btn").click(function(){
        for (i = 0; i < 2; i++) {
            content = $('#comment' + commentCount)[0];
            content.style.display = "block";
            commentCount++;  
        }                
    });

    //pour revenir en haut de la page
    $("#btnTop").click(function(){
        document.documentElement.scrollTop = 0;
    });    
});