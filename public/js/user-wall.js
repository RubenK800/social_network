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
    url: 'add-like',
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
/******/ })()
;