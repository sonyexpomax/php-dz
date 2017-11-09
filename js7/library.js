
String.prototype.reverse = function (string) {
    return string.split('').reverse().join('')
}

String.prototype.intrim = function (string) {
    return string.trim().replace(/\s{2,}/g, ' ');
}

String.prototype.isPalindrome = function (string) {
    return string == reverse(string) ? true : false;
}

Array.prototype.even = function(callback){
    for (var i = 0; i< this.length; i+=2){
        callback(this[i], i, this);
    }
}

Array.prototype.odd = function(callback){
    for (var i = 1; i< this.length; i+=2){
        callback(this[i], i, this);
    }
}

Array.prototype.shuffle = function (arr) {
    var randIndex;
    var len =arr.length;
    var arrTemp = [];
    for(var i = len; i > 0; i--){
        randIndex =  Math.floor(Math.random() * i) ;
        arrTemp.push(arr[randIndex]) ;
        arr.splice(randIndex, 1);
    }
    return arrTemp;
}