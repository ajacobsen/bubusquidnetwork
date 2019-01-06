function enableOnClick() {
	var items = $("#show-selector-items").children();
	for (var i = items.length - 1; i >= 0; i--) {
		if (items[i].getElementsByTagName("a")[0].href == document.baseURI) {
			items[i].className = "list-inline-item rounded-circle bg-dark selected-show";
		}
	}
}
window.onload=enableOnClick;
