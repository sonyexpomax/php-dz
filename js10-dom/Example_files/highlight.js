var highligts = {
    paramsFromURI:{},

    getParamsFromUri: function() {
        var arr = window.location.search.slice(1).split('&');
        for(var i = 0; i < arr.length; i++ ){
            var stringFromArr = arr[i].toString();
            var named = stringFromArr.substr(0,stringFromArr.indexOf('='));
            var vals = stringFromArr.substr(stringFromArr.indexOf('=')+1, stringFromArr.length);
            highligts.paramsFromURI[named] = vals;

        }
    },

    findDivFromUri: function() {
        highligts.getParamsFromUri();
        var arrFindClass = document.body.getElementsByClassName('highlight');
        for(var i = 0 ; i < arrFindClass.length; i++){
            if (arrFindClass[i].getAttribute('data-id') === highligts.paramsFromURI['id']){
                arrFindClass[i].style.background = '#' + highligts.paramsFromURI['color'];
                return;
            }
        }
        return alert("Can`t find div");
    }
};


