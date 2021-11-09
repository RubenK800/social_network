/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/user-wall.js ***!
  \***********************************/
var submit = document.getElementById('submit');

submit.onclick = function () {
  if (document.getElementById("image").files.length === 0 && document.getElementById("text").value === '') {
    alert("nothing to post");
    return false;
  }
};

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

var _loop = function _loop(i) {
  commentsShowBtn[i].addEventListener('click', function () {
    comments[i].hidden = false;
    commentsHide[i].hidden = false;
    commentsShowBtn[i].hidden = true;
  });
};

for (var i = 0; i < commentsShowBtn.length; i++) {
  _loop(i);
}

var _loop2 = function _loop2(_i) {
  commentsHide[_i].addEventListener('click', function () {
    comments[_i].hidden = true;
    commentsHide[_i].hidden = true;
    commentsShowBtn[_i].hidden = false;
  });
};

for (var _i = 0; _i < commentsShowBtn.length; _i++) {
  _loop2(_i);
}

var _loop3 = function _loop3(_i2) {
  indCommentReply[_i2].addEventListener('click', function () {
    independentCommentWriteForm[_i2].hidden = false;
  });
};

for (var _i2 = 0; _i2 < indCommentReply.length; _i2++) {
  _loop3(_i2);
}

var _loop4 = function _loop4(_i3) {
  dCommentReply[_i3].addEventListener('click', function () {
    dependentCommentWriteForm[_i3].hidden = false;
  });
};

for (var _i3 = 0; _i3 < dCommentReply.length; _i3++) {
  _loop4(_i3);
}

var _loop5 = function _loop5(_i4) {
  hideIndCommentFormBtn[_i4].addEventListener('click', function () {
    independentCommentWriteForm[_i4].hidden = true;
  });
};

for (var _i4 = 0; _i4 < hideIndCommentFormBtn.length; _i4++) {
  _loop5(_i4);
}

var _loop6 = function _loop6(_i5) {
  hideDCommentFormBtn[_i5].addEventListener('click', function () {
    dependentCommentWriteForm[_i5].hidden = true;
  });
};

for (var _i5 = 0; _i5 < hideDCommentFormBtn.length; _i5++) {
  _loop6(_i5);
}
/******/ })()
;