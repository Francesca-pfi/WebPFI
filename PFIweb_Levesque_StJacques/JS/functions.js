function like(id, type) {
    let urlL;
    if (type == "comment") {
        urlL = 'DOMAINLOGIC/likeComment.dom.php';
    }
    else if (type=="album") {
        urlL = 'DOMAINLOGIC/likeAlbum.dom.php';
    }
    else if (type == "image") {
        urlL = 'DOMAINLOGIC/likeImage.dom.php';
    }
    $.ajax({
        cache: false,
        type: 'POST',
        url: urlL,
        data: 'id='+id,
        success: function(resp) 
        {
            if (resp){
                $('#btnLike'+type+id).toggleClass("d-none");
                $('#btnUnlike'+type+id).toggleClass("d-none");
                let nbLikes = Number($("#nbLikes"+type+id).text());
                $("#nbLikes"+type+id).text(nbLikes + 1);
            }
            else {
                alert("Could not unlike " + type);
            }
        }
    });
}
function unlike(id, type) {
    let urlL;
    if (type == "comment") {
        urlL = 'DOMAINLOGIC/unlikeComment.dom.php';
    }
    else if (type=="album") {
        urlL = 'DOMAINLOGIC/unlikeAlbum.dom.php';
    }
    else if (type == "image") {
        urlL = 'DOMAINLOGIC/unlikeImage.dom.php';
    }
    $.ajax({
        cache: false,
        type: 'POST',
        url: urlL,
        data: 'id='+id,
        success: function(resp) 
        {
            if (resp){
                $('#btnLike'+type+id).toggleClass("d-none");
                $('#btnUnlike'+type+id).toggleClass("d-none");
                let nbLikes = Number($("#nbLikes"+type+id).text());
                $("#nbLikes"+type+id).text(nbLikes - 1);
            }
            else {
                alert("Could not unlike " + type);
            }
        }
    });
}
function showEdit(commentID) {
    $('#editBox'+commentID).toggleClass("d-none");
}
function edit(commentID) {
    let content = $('#editBox'+commentID+" textarea").text();
    $.ajax({
        cache: false,
        type: 'POST',
        url: 'DOMAINLOGIC/editComment.dom.php',
        data: {'commentID=': commentID+', content='+content},
        success: function(resp) 
        {
            if (resp){
                $('#editBox'+commentID).toggleClass("d-none");
                $('#comment'+commentID+" .card-text").text(content);
            }
            else {
                alert("Could not edit comment");
            }
        }
    });
}
