// Select active page
$('.navbar li a[href="' + this.location.pathname + '"]').closest('li').addClass('active');

// Funtion for copying text to clipboard
// Based on https://codepen.io/shaikmaqsood/pen/XmydxJ/

$('a[data-trigger="copy"]').on('click', function(e) {
    var text = $(this).text();

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();

    console.log("Copied " + text + " to clipboard");
});
