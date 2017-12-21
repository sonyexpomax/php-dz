let countOfNewWindows = 0;
let dragEl;
let maxZindex = 20;
let isHeadOfWindow;
/**
 *  Creating New window
 * @param text
 */
function createNewWindow(text) {

    let newWindow = document.createElement('div');
    addNewWindowToDom(newWindow,text);
    countOfNewWindows ++;

    //drag n drop
    dragEl = document.querySelectorAll('.modal');

    dragEl.forEach(function(el) {
        el.ondragstart = function (e) {
            if(isHeadOfWindow) {
                setZIndex(el);
                el.style.opacity = 0.9;
                drg = el;
                diffX = e.pageX - getCoords(el).left;
                diffY = e.pageY - getCoords(el).top;
            }
        };
        el.ondragend = function (e) {
            if(isHeadOfWindow) {
                el.style.opacity = 1;
                drg.style.left = (e.pageX - diffX) + 'px';
                drg.style.top = (e.pageY - diffY) + 'px';
                drg = null;
            }
        };
    });
}

deleteWindow = (id) => {
    document.querySelector('#' + id).parentElement.removeChild(document.querySelector('#' + id));
};

function addNewWindowToDom(newWindow, text) {

    //create div.modal
    newWindow.id = 'modal-' + (countOfNewWindows + 1);
    newWindow.className = 'modal';
    newWindow.setAttributeNS(null, 'style', 'z-index:20');
    newWindow.style.top = (countOfNewWindows * 50) + "px";
    newWindow.style.left = (countOfNewWindows * 50) + "px";
    newWindow.setAttributeNS(null, 'draggable', true);


    //create header
    let newWindowHeader = document.createElement('h2');
    newWindowHeader.textContent = 'Attention';
    newWindowHeader.className = 'modal-head';
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
    let windowText = event.key;
    createNewWindow(windowText);
});

document.body.addEventListener('click',function (event) {
    var elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'close') {
        deleteWindow(elementWithClick.parentElement.id);
    }
    if (elementWithClick.className === 'modal-head') {
        setZIndex(elementWithClick.parentElement);
    }
});

document.body.addEventListener('mousedown',function (event) {
    var elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'modal-head') {
        isHeadOfWindow = true;
    }
    else {
        isHeadOfWindow = false;
    }
});

function getCoords(elem) {
    let box = elem.getBoundingClientRect();
    return {
        top: box.top + pageYOffset,
        left: box.left + pageXOffset
    };
}

function setZIndex(elem) {
    elem.style.zIndex = maxZindex + 5;
    maxZindex +=5;
}