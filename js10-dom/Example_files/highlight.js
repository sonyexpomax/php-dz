var obj = {};

function getParamsFromUri() {
    var arr = window.location.search.slice(1).split('&');
    for(var i = 0; i < arr.length; i++ ){
        var stringFromArr = arr[i].toString();
        var named = stringFromArr.substr(0,stringFromArr.indexOf('='));
        var value = stringFromArr.substr(stringFromArr.indexOf('=')+1, stringFromArr.length);
        obj[named] = value;
    }
}

function createDivFromUri() {
    getParamsFromUri();
    var element = document.createElement('div');
    element.style.background = '#' + obj.color;
    element.dataset.id = obj.id;
    element.className = 'highlight';
    document.body.appendChild(element);
}
