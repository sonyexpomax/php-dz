//------------------------  Задание 1 -----------------------
console.log("Задание 1");

var Runner = function() {
    this.medals = [];
};

Runner.DescriptionMedal = [];

Runner.giveMedal = function (obj, description) {

    if (FindId(description) == -1){
        var NewId = Runner.DescriptionMedal.length;
        Runner.DescriptionMedal[NewId] = description;
        obj.medals[obj.medals.length] = NewId;
    }
    else {
        obj.medals[obj.medals.length] = FindId(description);
    }

    /**
     *
     * @param description
     * @returns {number}
     * @constructor
     */
    function FindId (description) {
        for (var i = 0; i < Runner.DescriptionMedal.length; i++) {
            if (Runner.DescriptionMedal[i] == description) {
                return i;
            }
        }
        return -1;
    }
}
/*
    var DecorRunnerMedals = function (f) {
        return function() {
            var result = f.apply(this, arguments);
            result = result.join(',');
            return result;
        }
    }

    Runner.medals = DecorRunnerMedals(Runner.medals);
*/
var runner1 = new Runner;
var runner2 = new Runner;
Runner.giveMedal(runner1, 'Gold, 1000 m');
Runner.giveMedal(runner1, 'Silver, 500 m');
console.log(runner1.medals); // 1,2
Runner.giveMedal(runner2, 'Silver, 500 m');
console.log(runner1.medals); // 2




//------------------------  Задание 2 -----------------------
//фабричные методы
console.log("Задание 2");

var Car = function(brand) {
    this.brand = brand;
    this.wheels = 4;
};

Car.FromCarWith3Wheels = function(brand) {
    var car = new Car();
    car.brand = brand;
    car.wheels = 3;
    return car;
}
Car.FromCarWith8Wheels = function(brand) {
    var car = new Car();
    car.brand = brand;
    car.wheels = 8;
    return car;
}


//------------------------  Задание 3 -----------------------
// call
console.log("Задание 3");

var RuningPlayer = function (name, medals) {
    this.name = name;
    this.medals = medals;

}

var LotteryPlayer = function (CountBuyingTickets, CountWinningTickets) {
    this.CountBuyingTickets = CountBuyingTickets;
    this.CountWinningTickets = CountWinningTickets;

}
LotteryPlayer.Payment = function() {
    this.PrizeMoney = 1000;
};


var NewRunner = new RuningPlayer('Ivan',12);
var NewLotteryPlayer = new LotteryPlayer(32,2);
LotteryPlayer.Payment.call(NewRunner);


//------------------------  Задание 4 -----------------------
console.log("Задание 4");

function sorting() {
    arguments.sort=[].sort;
    arguments.sort(function (a,b) {
        return (b%10 - a%10)
    })
    delete arguments.sort;
    return arguments;
}

console.log(sorting(72,25,51,35,96));

//------------------------  Задание 5 -----------------------
console.log("Задание 5");

var DecorMax = function (f) {
    return function() {
        var args = arguments;
        console.log(args);
        for (var key in args) {
            if (typeof args[key] == "string") {
                var VarString = args[key];
                args[key] = VarString.length;
            }
            if (typeof  args[key] == "object") {
                var VarObject = args[key];
                for (var key1 in VarObject) {
                    if (typeof VarObject[key1] == "number") {
                        args[key]  = VarObject[key1];
                        break;
                    }
                }
            }
        };
        var result = f.apply(this, args);
        return result;
    };
};

Math.max = DecorMax(Math.max);

console.log(
    Math.max(
        2,
        1,
        'строка',
        {
            field1:'строка в объекте',
            field2:9,
            field3:44
        },
        4
    )
);