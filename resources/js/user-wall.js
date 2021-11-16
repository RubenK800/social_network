$('#submit-post').on('click', function () {
    //https://stackoverflow.com/a/14772836
    if($("#image")[0].files.length === 0 && $("#text")[0].value === ''){
        alert("nothing to post");
        return false;
    }
});

$('.submit-comment').on('click', function () {
    let type = $(this).attr('data-comment-value');
    //$('.' + type).attr("hidden", false);
    //alert($(".comment_image."+type)[0].files);
    //https://stackoverflow.com/questions/1041344/how-can-i-select-an-element-with-multiple-classes-in-jquery
    if($(".comment_image."+type)[0].files.length === 0 && $(".comment-text."+type)[0].value === ''){
        alert("nothing to add");
        return false;
    }
});

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

$(".comment-like-dislike").on( "click", function(event){
    let targetDataValue = $(event.target).attr('data-comment-like-dislike');
    if (targetDataValue.includes('ind-c')){
        getCommentIdFromData(targetDataValue,'ind-c');
    } else if (targetDataValue.includes('d-c')){
        getCommentIdFromData(targetDataValue,'d-c');
    }
});

$('.comment-edit').on('click', function () {
    let targetDataValue = $(event.target).attr('data-edit');
    if (targetDataValue.includes('ind-edit')) {
        showOrHideElement('show','data-edit',this);
    } else if (targetDataValue.includes('d-edit')) {
        showOrHideElement('show','data-edit',this);
    }
});

$('.post-edit').on('click',function () {
    //let targetDataValue = $(event.target).attr('data-edit');
    showOrHideElement('show','data-edit',this);
})

$('.post-edit-form-hide').on('click',function () {
    showOrHideElement('hide','data-post-edit-form-hide',this);
})

//https://stackoverflow.com/a/33575340
$('.show-comments').on("click", function(){
    showOrHideElement('show','data-show-c', this);
    $(this).attr("hidden", true);
});

$('.hide-comments').on('click', function(){
    showOrHideElement('hide','data-hide-c',this);
    $('.show-comments').attr('hidden', false);
    $(this).attr('hidden', true);
});

$('.comment-function-show').on('click', function () {
    showOrHideElement('show','data-comment-function-show',this);
});

$('.comment-function-hide').on('click', function () {
    showOrHideElement('hide','data-comment-function-hide', this);
});

function showOrHideElement(actionName,attribute, element){
    if (actionName === 'show') {
        let type = $(element).attr(attribute);
        $('.' + type).attr("hidden", false);
    } else if (actionName === 'hide'){
        let type = $(element).attr(attribute);
        $('.'+type).attr("hidden", true);
    }
}

function getCommentIdFromData(targetDataValue, commentType){
    let commentId = null;
    let type = null;
    if (targetDataValue.includes('dislike')){
        type = 'dislike';
        commentId =  targetDataValue.replace(commentType+'-dislike','');
        alert(type);
    } else if (targetDataValue.includes('like')){
        type = 'like';
        commentId =  targetDataValue.replace(commentType+'-like','');
        alert(type);
    }
    $.ajax({
        url:'likes',
        data:{'comment_id':commentId, 'type':type},
        type:'post',
        success:  function (response) {
            console.log(response);
        },
        error: function(x,xs,xt){
            console.log(x);
        }
    });
    alert(commentId);
}
