
//---------------------- задание1 ------------------
var pet = {
    age: 11,
    name: 'vik',
    walk: function () {
        console.log('I can walk')
    },
    sleep: function () {
        console.log('I can sleep')
    },
    furType: 'A+',
    tailLength: '5'
};

//--------for Cat-------
var Cat = function () {
    this.meow = function () {
        console.log('meow');
    }
}

Cat.prototype = pet;

//--------for Dog-------

var Dog = function () {
    this.bark = function () {
        console.log('bark');
    }
}

Dog.prototype = pet;

myCat = new Cat;
myDog = new Dog;


//----------------задание 2 ------------------

var male = {
    crow: function () {
        alert("Cock-A-Doodle-Doo!");
    }
}

var female = {
    produceEgg: function () {
        var egg = {type: null};
        return egg;
    }
}

function Chicken(name, sex) {

    if(sex = 'male'){
        this.prototype = male;
    }

    if(sex = 'female'){
        this.prototype = female;
    }

    this.name = name;

    this.getSex = function () {
        return sex;
    };
}

var myChicken1 = new Chicken('qqq','male');
var myChicken2 = new Chicken('qwqwqw','female');

//----------------задание 3 ------------------


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