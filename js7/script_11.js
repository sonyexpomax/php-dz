//---------------------- задание1 ------------------
var pet = {
    age: 11,
    name: 'vik',
    walk: function () {
        console.log('I can walk')
    },
    sleep: function () {
        console.log('I can sleep')
    }
};

var homeAnimal = {
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
Cat.prototype = homeAnimal;

//--------for Dog-------

var Dog = function () {
    this.bark = function () {
        console.log('bark');
    }
}

Dog.prototype = pet;
Dog.prototype = homeAnimal;

myCat = new Cat;
myDog = new Dog;


//----------------задание 2 ------------------

var male = {
    crow : function() {
        alert("Cock-A-Doodle-Doo!");
    }
};

var female = {
    produceEgg : function() {
        var egg = {type: null};
        return egg;
    }
};

var Chicken = function(name, sex) {
    this.name = name;
    if(sex == "male") {
        this.__proto__ = male;
    } else {
        this.__proto__ = female;
    }
    this.getSex = function() {
        return sex;
    };
};

myChicken = new Chicken('Rew','female');
