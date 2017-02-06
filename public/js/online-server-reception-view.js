var myScroll;
function loaded () {
    myScroll = new IScroll('#historycontent', {
        click: true,
        scrollbars: true,
        mouseWheel: true,
        interactiveScrollbars: true,
        shrinkScrollbars: 'scale',
        fadeScrollbars: true
    });
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);