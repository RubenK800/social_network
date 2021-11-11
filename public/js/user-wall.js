/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/user-wall.js ***!
  \***********************************/
var submitPost = document.getElementById('submit-post');
submitPost.addEventListener('click', function () {
  if (document.getElementById("image").files.length === 0 && document.getElementById("text").value === '') {
    alert("nothing to post");
    return false;
  }
});
var submitComment = document.getElementsByClassName('submit-comment');

var _loop = function _loop(i) {
  submitComment[i].onclick = function () {
    if (document.getElementsByClassName("comment_image")[i].files.length === 0 && document.getElementsByClassName("comment-text")[i].value === '') {
      alert("nothing to add");
      return false;
    }
  };
};

for (var i = 0; i < submitComment.length; i++) {
  _loop(i);
}

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(".likeIt").on("click", function (event) {
  var postId = $(event.target).attr('data-post-like');
  $.ajax({
    url: 'likes',
    data: {
      'post_id': postId
    },
    type: 'post',
    success: function success(response) {
      console.log(response);
    },
    error: function error(x, xs, xt) {
      console.log(x);
    }
  });
  alert($(event.target).attr('data-post-like'));
});
$(".ind-comment-like").on("click", function (event) {
  var commentId = $(event.target).attr('data-ind-comment-like');
  $.ajax({
    url: 'likes',
    data: {
      'comment_id': commentId,
      'type': 'like'
    },
    type: 'post',
    success: function success(response) {
      console.log(response);
    },
    error: function error(x, xs, xt) {
      console.log(x);
    }
  });
  alert($(event.target).attr('data-ind-comment-like'));
});
$(".d-comment-like").on("click", function (event) {
  var commentId = $(event.target).attr('data-d-comment-like');
  $.ajax({
    url: 'likes',
    data: {
      'comment_id': commentId,
      'type': 'like'
    },
    type: 'post',
    success: function success(response) {
      console.log(response);
    },
    error: function error(x, xs, xt) {
      console.log(x);
    }
  });
  alert($(event.target).attr('data-d-comment-like'));
});
$(".ind-comment-dislike").on("click", function (event) {
  var commentId = $(event.target).attr('data-ind-comment-dislike');
  $.ajax({
    url: 'likes',
    data: {
      'comment_id': commentId,
      'type': 'dislike'
    },
    type: 'post',
    success: function success(response) {
      console.log(response);
    },
    error: function error(x, xs, xt) {
      console.log(x);
    }
  });
  alert($(event.target).attr('data-ind-comment-dislike'));
});
$(".d-comment-dislike").on("click", function (event) {
  var commentId = $(event.target).attr('data-d-comment-dislike');
  $.ajax({
    url: 'likes',
    data: {
      'comment_id': commentId,
      'type': 'dislike'
    },
    type: 'post',
    success: function success(response) {
      console.log(response);
    },
    error: function error(x, xs, xt) {
      console.log(x);
    }
  });
  alert($(event.target).attr('data-d-comment-dislike'));
});
var commentsShowBtn = document.getElementsByClassName('show-comments');
var commentsHide = document.getElementsByClassName('hide-comments');
var comments = document.getElementsByClassName('comments-place');
var indCommentReply = document.getElementsByClassName('ind-comment-reply');
var independentCommentWriteForm = document.getElementsByClassName('to-independent-comment-write-form');
var dCommentReply = document.getElementsByClassName('d-comment-reply');
var dependentCommentWriteForm = document.getElementsByClassName('to-dependent-comment-write-form');
var hideIndCommentFormBtn = document.getElementsByClassName('hide-ind-comment-form');
var hideDCommentFormBtn = document.getElementsByClassName('hide-d-comment-form');
var hideIndCommentEditFormBtn = document.getElementsByClassName('hide-ind-comment-edit-form');
var hideDCommentEditFormBtn = document.getElementsByClassName('hide-d-comment-edit-form');
var indCommentEditBtnHide = document.getElementsByClassName('ind-comment-edit');
var indCommentEditForm = document.getElementsByClassName('independent-comment-edit-form');

var _loop2 = function _loop2(_i) {
  indCommentEditBtnHide[_i].addEventListener('click', function () {
    alert(_i);
    indCommentEditForm[_i].hidden = false;
  });
};

for (var _i = 0; _i < indCommentEditBtnHide.length; _i++) {
  _loop2(_i);
}

var dCommentEditBtnHide = document.getElementsByClassName('d-comment-edit');
var dCommentEditForm = document.getElementsByClassName('dependent-comment-edit-form');

var _loop3 = function _loop3(_i2) {
  dCommentEditBtnHide[_i2].addEventListener('click', function () {
    alert(_i2);
    dCommentEditForm[_i2].hidden = false;
  });
};

for (var _i2 = 0; _i2 < dCommentEditBtnHide.length; _i2++) {
  _loop3(_i2);
} // $(".d-comment-edit").on( "click", function(event){
//     // $(".dependent-comment-edit-form").show();
//
// });


var _loop4 = function _loop4(_i3) {
  commentsShowBtn[_i3].addEventListener('click', function () {
    comments[_i3].hidden = false;
    commentsHide[_i3].hidden = false;
    commentsShowBtn[_i3].hidden = true;
  });
};

for (var _i3 = 0; _i3 < commentsShowBtn.length; _i3++) {
  _loop4(_i3);
}

var _loop5 = function _loop5(_i4) {
  commentsHide[_i4].addEventListener('click', function () {
    comments[_i4].hidden = true;
    commentsHide[_i4].hidden = true;
    commentsShowBtn[_i4].hidden = false;
  });
};

for (var _i4 = 0; _i4 < commentsShowBtn.length; _i4++) {
  _loop5(_i4);
}

var _loop6 = function _loop6(_i5) {
  indCommentReply[_i5].addEventListener('click', function () {
    independentCommentWriteForm[_i5].hidden = false;
  });
};

for (var _i5 = 0; _i5 < indCommentReply.length; _i5++) {
  _loop6(_i5);
}

var _loop7 = function _loop7(_i6) {
  dCommentReply[_i6].addEventListener('click', function () {
    alert(_i6);
    dependentCommentWriteForm[_i6].hidden = false;
  });
};

for (var _i6 = 0; _i6 < dCommentReply.length; _i6++) {
  _loop7(_i6);
}

var _loop8 = function _loop8(_i7) {
  hideIndCommentFormBtn[_i7].addEventListener('click', function () {
    independentCommentWriteForm[_i7].hidden = true;
  });
};

for (var _i7 = 0; _i7 < hideIndCommentFormBtn.length; _i7++) {
  _loop8(_i7);
}

var _loop9 = function _loop9(_i8) {
  hideDCommentFormBtn[_i8].addEventListener('click', function () {
    dependentCommentWriteForm[_i8].hidden = true;
  });
};

for (var _i8 = 0; _i8 < hideDCommentFormBtn.length; _i8++) {
  _loop9(_i8);
}

var _loop10 = function _loop10(_i9) {
  hideIndCommentEditFormBtn[_i9].addEventListener('click', function () {
    indCommentEditForm[_i9].hidden = true;
  });
};

for (var _i9 = 0; _i9 < hideIndCommentEditFormBtn.length; _i9++) {
  _loop10(_i9);
}

var _loop11 = function _loop11(_i10) {
  hideDCommentEditFormBtn[_i10].addEventListener('click', function () {
    dCommentEditForm[_i10].hidden = true;
  });
};

for (var _i10 = 0; _i10 < hideDCommentEditFormBtn.length; _i10++) {
  _loop11(_i10);
}
/******/ })()
;