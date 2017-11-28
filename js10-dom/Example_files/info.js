var info = {
    i : 0,
    box : "",

    createDiv : function() {
        info.deleteDiv(info.i - 1);
        if (info.i < notifications.length) {
            var newDiv = document.createElement('div');
            newDiv.id = notifications[info.i].type;
            newDiv.className = 'info ' + notifications[info.i].type + 'Background';
            newDiv.textContent = notifications[info.i].message;
            document.body.appendChild(newDiv);
            info.i++;
        }
        else {
            info.i = 0;
            clearInterval(info.box);
        }
    },

    deleteDiv : function() {
        if (info.i > 0) {
            document.body.removeChild(document.getElementById((notifications[info.i - 1].type)))
        }
    },

    startCreation :function () {
        info.box = setInterval(info.createDiv, 2000);
    }
};