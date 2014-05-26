$(document).ready(function() {
	
	// nav toggle
	// http://stackoverflow.com/a/12950620/567193
	var url = window.location;
	$('ul.nav a').filter(function() {
		return this.href == url;
	}).parent().addClass('active');
	
	// beautiful selects
	$('.selectpicker').selectpicker();
});