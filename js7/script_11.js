
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
var Chicken = function(name, sex) {
    this.name = name;
    this_sex = sex;
};

Chicken.prototype.getSex = function () {
    return this.sex;
};

//male
var maleChicken = function (name) {
    Chicken.apply(this, [name, 'male']);
};

maleChicken.prototype.crow = function () {
    alert("Cock-A-Doodle-Doo!");
};

//female
var femaleChicken  = function (name) {
    Chicken.apply(this, [name, 'female']);
};

femaleChicken.prototype.produceEgg = function () {
    var egg = {type: null};
    return egg;
};


var myChicken1 = new maleChicken('qqq');
var myChicken2 = new femaleChicken('qwqwqw');


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