function enableOnClick() {
	var items = $("#show-selector-items").children();
	for (var i = items.length - 1; i >= 0; i--) {
		if (items[i].getElementsByTagName("a")[0].href == document.baseURI) {
			items[i].className = "list-inline-item rounded-circle bg-dark selected-show";
		}
	}
}
window.onload=enableOnClick;

fontsize = function () {
    var fontSize = $("#showlist-item").width() * 0.10; // 10% of container width
    $("#showlist-item a").css('font-size', fontSize);
};
$(window).resize(fontsize);
$(document).ready(fontsize);