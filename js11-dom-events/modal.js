let countOfNewWindows = 0;

/**
 *  Creating New window
 * @param text
 */
function createNewWindow(text) {

    let newWindow = document.createElement('div');
    addNewWindowToDom(newWindow,text);
    countOfNewWindows ++;
    let newWindowHeader = document.body.querySelector('#' + newWindow.id).firstChild;

    //drag n drop
    newWindowHeader.onmousedown = function(e) {

        let coords = getCoords(newWindow);
        let shiftX = e.pageX - coords.left;
        let shiftY = e.pageY - coords.top;

        newWindow.style.position = 'absolute';
        document.body.appendChild(newWindow);
        moveAt(e);

        newWindow.style.zIndex = 1000; // над другими элементами

        function moveAt(e) {
            newWindow.style.left = e.pageX - shiftX + 'px';
            newWindow.style.top = e.pageY - shiftY + 'px';
        }

        document.onmousemove = function(e) {
            moveAt(e);
        };

        newWindow.onmouseup = function() {
            document.onmousemove = null;
            newWindow.onmouseup = null;
        };
    };

    newWindow.ondragstart = function() {
        return false;
    };

    function getCoords(elem) {
        let box = elem.getBoundingClientRect();
        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset
        };
    }
}

deleteWindow = (id) => {
    document.querySelector('#' + id).parentElement.removeChild(document.querySelector('#' + id));
};

function addNewWindowToDom(newWindow, text) {

    //create div.modal
    newWindow.id = 'modal-' + (countOfNewWindows + 1);
    newWindow.className = 'modal';
    newWindow.style.top = (countOfNewWindows * 50) + "px";
    newWindow.style.left = (countOfNewWindows * 50) + "px";
    
    //create header
    let newWindowHeader = document.createElement('h2');
    newWindowHeader.textContent = 'Attention';
    newWindow.appendChild(newWindowHeader);

    //create p
    let NewWindowParagraph = document.createElement('p');
    NewWindowParagraph.textContent = 'You have pressed:';
    
    //create b
    let NewWindowText = document.createElement('b');
    NewWindowText.textContent = " '" + text + "'";
    NewWindowParagraph.appendChild(NewWindowText);
    newWindow.appendChild(NewWindowParagraph);

    //create closetab
    let newWindowCloseTab = document.createElement('a');
    newWindowCloseTab.className = 'close';
    newWindow.appendChild(newWindowCloseTab);

    document.body.appendChild(newWindow);
}

/**
 * trace the keyboard
 */
document.body.addEventListener('keydown',function (event) {
    //console.log(event.keyCode);
    let windowText = event.key;
    //    console.log(event.key);
    createNewWindow(windowText);
});

document.body.addEventListener('click',function (event) {
    var elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'close') {
       deleteWindow(elementWithClick.parentElement.id);
    }
});
