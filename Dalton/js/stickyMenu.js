// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var navbar = document.getElementsByTagName("nav")[0];

// Get the offset position of the navbar

var sticky = navbar.offsetTop;
console.log( "sticky: " + sticky );

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  console.log( "window: " + window.pageYOffset );
  console.log( "navbar: " + sticky );
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky");
    document.getElementsByTagName("article")[0].style.position="static";
  }
  else {
    navbar.classList.remove("sticky");
  }
}
//
// // Active Nave - UnderLine
// var items = document.getElementsByClassName('item');
// var activeClassName = 'underLine';
//
// var unselectItems = function() {
//   for (var i = 0; i < items.length; i++) {
//     items[i].classList.remove(activeClassName);
//   }
// }
//
// var selectItem = function(item) {
//   unselectItems();
//   item.classList.add(activeClassName);
// }
//
// var onItemClick = function(event) {
//   selectItem(event.target);
// }
//
// console.log(items);
// for (var i = 0; i < items.length; i++) {
//   items[i].addEventListener('onclick', onItemClick());
// }
