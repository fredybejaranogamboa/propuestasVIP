$(function () { 
	// Dock initialize
	$('#dock').Fisheye(
		{
			maxWidth: 20,
			items: 'a',
			itemsText: 'span',
			container: '.dock-container',
			itemWidth: 30,
			proximity: 50,
			alignment : 'left',
			valign: 'bottom',
			halign : 'center'
		}
	);
});