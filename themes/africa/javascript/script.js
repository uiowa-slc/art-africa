// just messing around with stuff in here
 
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}
 
$(document).on('click', '[data-mtoggle]', function () {
  var $el = $(this);
  var selector = $el.attr('data-mtoggle');
  var $toggleEls = $(selector);
  $toggleEls.toggleClass('mtoggle');
});

var resized = false;
$(window).on('resize', function () {
  resized = true;
});

$(document).ready(function () {
  $('#main_content').css('min-height', window.outerHeight.toString() + 'px');
});

$(window).on('resize', function () {
  $('#main_content').css('min-height', window.outerHeight.toString() + 'px');
});

// setInterval(function () {
//   if (resized) {
//     if (window.outerWidth <= 768) {
//       console.log('move #nav2 inside of #nav1');
//     } else {
//       console.log('move #nav2 to #middle');
//     }
//     resized = false;
//   }
//   // think of a way to make the transition less janky, possibly with css+media queries?
//   // #nav1 #nav2, #middle #nav2
//   // or possible have .nav2 and render it twice...
// }, 500);
