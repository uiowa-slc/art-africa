// just messing around with stuff in here
 
function rems (n) {
  var htmlElement = document.getElementsByTagName('html')[0];
  return parseInt(getComputedStyle(htmlElement, null).getPropertyValue('font-size')) * n;
}
 
$(document).on('click', '#section_heading', function () {
  if (rems(1) === 14) {
    $('#section_nav').slideToggle(150, function () {
      // scroll?
    });
  }
});