/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/user-wall.js ***!
  \***********************************/
$('#submit-post').on('click', function () {
  //https://stackoverflow.com/a/14772836
  if ($("#image")[0].files.length === 0 && $("#text")[0].value === '') {
    alert("nothing to post");
    return false;
  }
});
$('.submit-comment').on('click', function () {
  if ($(".comment_image")[0].files.length === 0 && $(".comment-text")[0].value === '') {
    alert("nothing to add");
    return false;
  }
});
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
$('.ind-comment-edit').on('click', function () {
  showElement('data-ind-edit', this);
});
$('.d-comment-edit').on('click', function () {
  showElement('data-d-edit', this);
}); //https://stackoverflow.com/a/33575340

$('.show-comments').on("click", function () {
  showElement('data-show-c', this);
  $(this).attr("hidden", true);
});
$('.hide-comments').on('click', function () {
  hideElement('data-hide-c', this);
  $('.show-comments').attr('hidden', false);
  $(this).attr('hidden', true);
});
$('.ind-comment-reply').on('click', function () {
  showElement('data-ind-reply', this);
});
$('.d-comment-reply').on('click', function () {
  showElement('data-d-reply', this);
});
$('.hide-ind-comment-form').on('click', function () {
  hideElement('data-ind-changed-mind', this);
});
$('.hide-d-comment-form').on('click', function () {
  hideElement('data-d-changed-mind', this);
});
$('.hide-ind-comment-edit-form').on('click', function () {
  hideElement('data-ind-edit-changed-mind', this);
});
$('.hide-d-comment-edit-form').on('click', function () {
  hideElement('data-d-edit-changed-mind', this);
});

function showElement(attribute, element) {
  var type = $(element).attr(attribute);
  $('.' + type).attr("hidden", false);
}

function hideElement(attribute, element) {
  var type = $(element).attr(attribute);
  $('.' + type).attr("hidden", true);
}
/******/ })()
;