
String.prototype.reverse = function(){
    return this.split('').reverse().join('')
}

String.prototype.intrim = function () {
    return this.trim().replace(/\s{2,}/g, ' ');
}

String.prototype.isPalindrome = function () {
    return this == this.reverse() ? true : false;
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

Array.prototype.shuffle = function () {
    var randIndex;
    var len = this.length;
    var arrTemp = [];
    for(var i = len; i > 0; i--){
        randIndex =  Math.floor(Math.random() * i) ;
        arrTemp.push(this[randIndex]) ;
        this.splice(randIndex, 1);
    }
    return arrTemp;
}