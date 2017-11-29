var countOfNewWindows = 0;

/**
 *  Creating New window
 * @param text
 */
function CreateNewWindow(text) {
    var newWindow = document.createElement('div');
    newWindow.id = 'modal-' + (countOfNewWindows + 1);
    newWindow.className = 'modal';

    var positionY = countOfNewWindows * 50;
    var positionX = countOfNewWindows * 50;

    newWindow.style.top = positionY + "px";
    newWindow.style.left = positionX + "px";

    document.body.appendChild(newWindow);
    countOfNewWindows ++;

    CreateNewWindowHeader(newWindow.id);
    CreateNewWindowCloseTab(newWindow.id);
    CreateNewWindowParagraph(newWindow.id);
    CreateNewWindowKeyText(newWindow.id, text);

    var newElement = document.body.querySelector('#' + newWindow.id);
    var newElementHeader = document.body.querySelector('#' + newWindow.id).firstChild;

    //drag n drop
    newElementHeader.onmousedown = function(e) {

        var coords = getCoords(newElement);
        var shiftX = e.pageX - coords.left;
        var shiftY = e.pageY - coords.top;

        newElement.style.position = 'absolute';
        document.body.appendChild(newElement);
        moveAt(e);

        newElement.style.zIndex = 1000; // над другими элементами

        function moveAt(e) {
            newElement.style.left = e.pageX - shiftX + 'px';
            newElement.style.top = e.pageY - shiftY + 'px';
        }

        document.onmousemove = function(e) {
            moveAt(e);
        };

        newElement.onmouseup = function() {
            document.onmousemove = null;
            newElement.onmouseup = null;
        };
    };

    newElement.ondragstart = function() {
        return false;
    };

    function getCoords(elem) {
        var box = elem.getBoundingClientRect();
        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset
        };
    }
}

/**
 * Creating New window header
 * @param windowId
 */
function CreateNewWindowHeader(windowId) {
    var newWindowHeader = document.createElement('h2');
    newWindowHeader.textContent = 'Attention';
    document.body.querySelector('#' + windowId).appendChild(newWindowHeader);
}

/**
 * Creating New window close tab
 * @param windowId
 */
function CreateNewWindowCloseTab(windowId) {
    var parentElement = document.body.querySelector('#' + windowId);
    var newWindowCloseTab = document.createElement('a');
    newWindowCloseTab.className = 'close';
    newWindowCloseTab.onclick = function () {document.body.removeChild(parentElement);};
    parentElement.appendChild(newWindowCloseTab);
}

/**
 * Creating New window paragraph
 * @param windowId
 */
function CreateNewWindowParagraph(windowId) {
    var NewWindowParagraph = document.createElement('p');
    NewWindowParagraph.textContent = 'You have pressed:';
    document.body.querySelector('#' + windowId).appendChild(NewWindowParagraph);
}

/**
 * Creating New window paragraph text
 * @param windowId
 * @param text
 */
function CreateNewWindowKeyText(windowId , text) {
    var NewWindowText = document.createElement('b');
    NewWindowText.textContent = " '" + text + "'";
    document.body.querySelector('#' + windowId).lastChild.appendChild(NewWindowText);
}

/**
 * trace the keyboard
 */
document.body.addEventListener('keydown',function (event) {
    //console.log(event.keyCode);
    var windowText = event.key;
    //    console.log(event.key);
    CreateNewWindow(windowText);
});
