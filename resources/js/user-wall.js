let submit = document.getElementById('submit');
submit.onclick = function () {
    if(document.getElementById("image").files.length === 0 && document.getElementById("text").value===''){
        alert("nothing to post");
        return false;
    }
};

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$( ".likeIt" ).on( "click", function(event){
    let postId = $(event.target).attr('data-post-like');
    $.ajax({
        url:'add-like',
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

