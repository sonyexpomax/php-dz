//------------------------  Задание 1 -----------------------
console.log("Задание 1");
var user = {
    setNewName: function (newFirstName) {
        var capitalizedName = newFirstName[0].toUpperCase() +
            newFirstName.substr(1);
        var prettyfiedName = "-=" + capitalizedName + "=-";
        this.name = prettyfiedName;
    }
};
var newFirstName = "boris";
var newFirstName2 = "basil";
//user.setNewName = setNewName;
user.setNewName(newFirstName); // user.name = "-=Boris=-", OK
// user.setNewName(newFirstName2); // user.name = "-=Boris=-", ???
console.log(user.name);


//------------------------  Задание 2 -----------------------
console.log("Задание 2");
var tempClone = {};
var Clone = function() {
    if (tempClone.number == undefined){
        tempClone = this;
    }
    else{
        return tempClone;
    }
};
var clone1 = new Clone;
var clone2 = new Clone;
clone1 == clone2 ;// true

//--------------------------- Задание 3 ---------------------
console.log('Задание 3')
function Spammer(TimeInterval) {
    if (IsSeconds(TimeInterval)) {
        this.TimeInterval = TimeInterval
        this.startSpam = function (SpamText) {
            setInterval(function () {
                var TimeNow = new Date();
                console.log(SpamText + "  //  " +
                    TimeNow.getHours() + ":" +
                    TimeNow.getMinutes() + ":" +
                    TimeNow.getSeconds());
            }, TimeInterval);
        }
    }
    else{
        console.log('Значение Timeinterval должно вводиться в милисекундах!');
    }
}
function IsSeconds(n) {
    return (n > 0) && (n % 1 == 0) && (n % 1000 == 0);
}

//--------------------------- Задание 4 ---------------------
console.log('Задание 4')
/**
 *
 * @param type
 * @param name
 * @param birthYear
 * @constructor
 */
var Pet = function(type,name,birthYear) {
    this.type = type;
    this.name = name;
    this.birthYear = birthYear;
    Object.defineProperty(this, "type", {
        configurable: false,
        writable: false
    } );
    Object.defineProperty(this, "birthYear", {
        configurable: false,
        writable: false,
        enumerable: false
    } );
    var DateNow = new Date();
    var nowYear = DateNow.getFullYear();
    this.info = this.type + " " + this.name + ": " + (nowYear - this.birthYear) + " years";
};

var myPet = new Pet("cat", "Barsik", 2015);
for(var key in myPet) { console.log(key); } // type, name
myPet.type = "dog";
myPet.name = "Murzik";
myPet.birthYear = 1700;
console.log(myPet.info); // "cat Murzik: 2 years"


//--------------------------- Задание 5 ---------------------
console.log('Задание 4')
function Years(year) {
    this.year = year;
    if (this.year % 4 == 0 && this.year % 100 != 0 || this.year % 400 == 0) {
        this.LeapYear = true;
    }
    else {
        this.LeapYear = false;
    }

    /**
     *
     * @returns {string}
     */
    this.toString = function () {
        if(this.LeapYear){
            return (this.year + ", високосный");
        }
        else {
            return (this.year + ", не високосный");
        }
    }

    /**
     *
     * @returns {integer}
     */
    this.valueOf = function () {
        return this.year;
    }
}
