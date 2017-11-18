//------------------------  Задание 1 -----------------------
console.log("Задание 1");

var Runner = function() {
    this.medals = [];
};

Runner.DescriptionMedal = [];

Runner.giveMedal = function (obj, description) {
    if (Runner.DescriptionMedal.indexOf(description) == -1){
        var NewId = Runner.DescriptionMedal.length;
        Runner.DescriptionMedal[NewId] = description;
        obj.medals.push(NewId);
    }
    else {
        obj.medals.push(Runner.DescriptionMedal.indexOf(description));
    }
}

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
    var newCar = new Car(brand);
    newCar.wheels = 3;
    return newCar;
}
Car.FromCarWith8Wheels = function(brand) {
    var newCar = new Car(brand);
    newCar.wheels = 8;
    return newCar;
}


//------------------------  Задание 3 -----------------------
// call
console.log("Задание 3");

var RuningPlayer = function (name, medals) {
    this.name = name;
    this.medals = medals;

}

var LotteryPlayer = function (countBuyingTickets, countWinningTickets) {
    this.countBuyingTickets = countBuyingTickets;
    this.countWinningTickets = countWinningTickets;

}

var newLotteryPlayer = new LotteryPlayer(32,2);

newLotteryPlayer.payment = function() {
    this.prizeMoney = 1000;
};

var newRunner = new RuningPlayer('Ivan',12);


newLotteryPlayer.payment.call(newRunner);


//------------------------  Задание 4 -----------------------
console.log("Задание 4");

/*
pseudomass = {
    0:72,
    1:25,
    2:51,
    3:35,
    4:96
};
*/
pseudomass = [72, 25, 51, 35, 96];

console.log("-----------Входные данные:--------");
console.log(pseudomass);

pseudomass.sort = function () {
    var count = this.length-1;
    for (var i = 0; i < count; i++) {
        for (var j = 0; j < count - i; j++) {
            if ((this[j] % 10) < (this[j + 1]) % 10) {
                var max = this[j];
                this[j] = this[j + 1];
                this[j + 1] = max;
            }
        }
    }
    return this;
};

console.log("---------Собственный метод:-------");
console.log(pseudomass.sort());

console.log("---------Отдолженный метод:-------");
var pseudomassTemp = [].sort.call(pseudomass);

console.log(pseudomassTemp.sort(function (a,b) {  return (b%10 - a%10) }));

delete pseudomassTemp;

//------------------------  Задание 5 -----------------------
console.log("Задание 5");

var decorMax = function (f) {
    return function() {
        var args = arguments;
        console.log(args);
        for (var key in args) {
            if (typeof args[key] == "string") {
                var varString = args[key];
                args[key] = varString.length;
            }
            if (typeof  args[key] == "object") {
                var varObject = args[key];
                for (var key1 in varObject) {
                    if (typeof varObject[key1] == "number") {
                        args[key]  = varObject[key1];
                        break;
                    }
                }
                if (typeof  args[key] == "object") {
                    args[key] = 0;
                }
            }
        };
        var result = f.apply(this, args);
        return result;
    };
};

Math.max = decorMax(Math.max);

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
