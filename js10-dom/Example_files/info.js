var i = 0;
var box;

function createDiv3() {
    deleteDiv(i-1);
    if(i < notifications.length){
        var newDiv = document.createElement('div');
        newDiv.id = notifications[i].type;
        newDiv.className = 'info ' + notifications[i].type + 'Background';
        newDiv.textContent = notifications[i].message;
        document.body.appendChild(newDiv);
        i++;
    }
    else{
        i = 0;
        clearInterval(box);
    }
}

function deleteDiv() {
    if(i > 0){
        document.body.removeChild(document.getElementById((notifications[i-1].type)))
    }
}

function startCreation() {
    box = setInterval(createDiv3, 2000);
}