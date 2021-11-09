let submit = document.getElementById('submit');
submit.onclick = function () {
    if(document.getElementById("image").files.length === 0 && document.getElementById("text").value === ''){
        alert("nothing to post");
        return false;
    }
};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(".likeIt").on( "click", function(event){
    let postId = $(event.target).attr('data-post-like');
    $.ajax({
        url:'likes',
        data:{'post_id':postId},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert($(event.target).attr('data-post-like'));
});

$(".ind-comment-like").on( "click", function(event){
    let commentId = $(event.target).attr('data-ind-comment-like');
    $.ajax({
        url:'likes',
        data:{'comment_id':commentId, 'type':'like'},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert($(event.target).attr('data-ind-comment-like'));
});

$(".d-comment-like").on( "click", function(event){
    let commentId = $(event.target).attr('data-d-comment-like');
    $.ajax({
        url:'likes',
        data:{'comment_id':commentId, 'type':'like'},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert($(event.target).attr('data-d-comment-like'));
});

$(".ind-comment-dislike").on( "click", function(event){
    let commentId = $(event.target).attr('data-ind-comment-dislike');
    $.ajax({
        url:'likes',
        data:{'comment_id':commentId, 'type':'dislike'},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert($(event.target).attr('data-ind-comment-dislike'));
});

$(".d-comment-dislike").on( "click", function(event){
    let commentId = $(event.target).attr('data-d-comment-dislike');
    $.ajax({
        url:'likes',
        data:{'comment_id':commentId, 'type':'dislike'},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert($(event.target).attr('data-d-comment-dislike'));
});

let commentsShowBtn = document.getElementsByClassName('show-comments');
let commentsHide = document.getElementsByClassName('hide-comments');
let comments = document.getElementsByClassName('comments-place');

let indCommentReply = document.getElementsByClassName('ind-comment-reply');
let independentCommentWriteForm = document.getElementsByClassName('to-independent-comment-write-form');

let dCommentReply = document.getElementsByClassName('d-comment-reply');
let dependentCommentWriteForm = document.getElementsByClassName('to-dependent-comment-write-form');

let hideIndCommentFormBtn = document.getElementsByClassName('hide-ind-comment-form');
let hideDCommentFormBtn = document.getElementsByClassName('hide-d-comment-form');

for (let i = 0; i < commentsShowBtn.length; i++) {
    commentsShowBtn[i].addEventListener('click', function () {
        comments[i].hidden = false;
        commentsHide[i].hidden = false;
        commentsShowBtn[i].hidden = true;
    });
}

for (let i = 0; i < commentsShowBtn.length; i++) {
    commentsHide[i].addEventListener('click', function () {
        comments[i].hidden = true;
        commentsHide[i].hidden = true;
        commentsShowBtn[i].hidden = false;
    });
}

for (let i = 0; i < indCommentReply.length; i++) {
    indCommentReply[i].addEventListener('click', function () {
        independentCommentWriteForm[i].hidden = false;
    });
}

for (let i = 0; i < dCommentReply.length; i++) {
    dCommentReply[i].addEventListener('click', function () {
        dependentCommentWriteForm[i].hidden = false;
    });
}

for (let i = 0; i < hideIndCommentFormBtn.length; i++){
    hideIndCommentFormBtn[i].addEventListener('click',function () {
    independentCommentWriteForm[i].hidden = true;
    })
}

for (let i = 0; i < hideDCommentFormBtn.length; i++){
    hideDCommentFormBtn[i].addEventListener('click',function () {
        dependentCommentWriteForm[i].hidden = true;
    })
}


