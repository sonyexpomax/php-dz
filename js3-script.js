//------------------------  Задание 1 -----------------------
console.log("Задание 1");
var obj1 = { name: 'Rea', age: 24, look:'bad' };
var obj2 = { name: "Val", size: 43, look:"nice"};
objects = function (obj1,obj2) {
    var objRes = {};
    var key;
    for (key in obj1) {
        objRes[key] = obj1[key]
    }
    for (key in obj2) {
        objRes[key] = obj2[key]
    }
    return objRes;
}
console.log(objects(obj1,obj2));

//------------------------  Задание 2 -----------------------
console.log("Задание 2");
var sportsmen = [
    {name:"Ivan2", age: 33},
    {name:"Ivan1", age: 31},
    {name:"Ivan3", age: 21},
    {name:"Ivan4", age: 20},
    {name:"Ivan5", age: 42},
    {name:"Ivan6", age: 41},
    {name:"Ivan7", age: 36},
    {name:"Ivan8", age: 42},
    {name:"Ivan9", age: 22},
];
function topOldest(menlist, limit) {
    if(menlist.length >= limit) {
        menlist.sort(function (a, b) {
            return a.age < b.age;
        });
        var i = 0;
        var topOld=[];
        console.log("Имена " + limit + " самых старых спортсменов");
        while (i < limit) {
            topOld[topOld.length] = menlist[i].name;
            i++;
        }
        return topOld;
    }
    else {
        alert("limit не может принимать значение больше чем количество спортсменов!");
    }
}
console.log(topOldest(sportsmen,3));

//--------------------------- Задание 3 ---------------------
console.log('Задание 3')
var runner = {
    name:'hert',
}
function give(obj, medalType, medalNum) {
    if (runner.medals == undefined) {
        runner.medals = {}
    }
    if (medalType == 'gold' || medalType == 'silver' || medalType == 'bronze') {
        if (medalNum % 1 == 0 && medalNum > 0) {
            if (obj.medals[medalType] != undefined) {
                obj.medals[medalType] += medalNum;
            }
            else {
                obj.medals[medalType] = medalNum;
            }
        }
        else {
            console.log('Количество медалей может быть только целым положительным');
        }
    }
    else{
        console.log('Медали могут быть только gold, silver, bronze');
    }
}
give(runner,'gold', 3);
give(runner,'silver', 23);
give(runner,'gold', 8);
console.log(runner.medals);


//--------------------------- Задание 4 ---------------------
console.log('Задание 4')
//var existTimer = false;
var spammer = {
    existTimer: false,
    startSpam: function (input){
        this.arr.push(input);
        (!spammer.existTimer) ? this.StartStopTimer() : "";
    },

    stopSpam: function (output) {
        this.arr.splice(this.arr.indexOf(output),1);
        this.StartStopTimer();
    },
    arr:[],

    StartStopTimer:function () {
        if (spammer.arr.length == 0) {
            spammer.existTimer = false;
            clearInterval(spammer.timer);
        }
        else{
            if (!spammer.existTimer) {
                spammer.existTimer = true;
                spammer.timer = setInterval(function () {
                    spammer.listStr();
                }, 1000);
            }
        }
    },


    listStr: function () {
        var ListStrings ='';
        this.arr.forEach(function(item,i,arr){
            var TimeNow = new Date();
            ListStrings = ListStrings + '\r\n' + arr[i] + "  //  " +
                TimeNow.getHours()+ ":" +
                TimeNow.getMinutes() + ":" +
                TimeNow.getSeconds();
        });
        console.log(ListStrings);
    }
};


//--------------------------- Задание 5 ---------------------
console.log('Задание 5')
function beautify(str) {
    var smiles = [':)', ';)', '(:', ':p', ':D', ':-*'];
    var punctation = ['.', ',', '?', '!', ';'];
    var TempStr = '';
    var len = str.length;
    console.log('Входная строка \n' + str);
    //console.log(punctation.indexOf(";"));
    for (var i = 0; i < len; i++){
        if (punctation.indexOf(str[i]) != -1 || str[i] == ' '){
            var smileCode = Math.floor(Math.random(smiles.length-1) * (smiles.length));
            TempStr += smiles[smileCode] + str[i];
            if(str[i+1] == ' '){
                i++;
                TempStr += ' ';
            }
        }
        else {
            var registrCode = Math.floor(Math.random() * 2);
            registrCode == 1 ? TempStr += str[i].toUpperCase() : TempStr += str[i].toLowerCase();
        }
    }
    console.log('Выходная строка \n' + TempStr);
}
beautify('Поддерживается. в следующих, режимах документов; стандартный режим?');


//--------------------------- Задание 6 ---------------------
console.log('Задание 6')
var password = "YzBiYTk=";
console.log("Зашифрованный пароль: " + password);

function bruteForce(password) {
    var arr = [0, 'a', 'b', 'c', 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var MaxSize = 6;
    var res = [];
    var answer = '';
    for (var j = 1; j <= MaxSize; j++) {
        perebor(arr, res, j);
    }
    if (answer == ''){
        return "Расшифровать пароль не удалось";
    }
    else {
        return answer;
    }

    /**
     *
     * @param arr
     * @param res
     * @param SizeSmall
     */
    function perebor(res,SizeSmall) {
        var StartCountI;
        if (SizeSmall != 0) {
            StartCountI = (SizeSmall == j ?  1 :  0);
            for (var i = StartCountI; i < arr.length; i++) {
                res[MaxSize-SizeSmall] = arr[i];
                perebor(arr, res, SizeSmall-1);
                if (SizeSmall == 1 && answer =='') {
                    var variant = res.join('');
                    var encodedVariant = btoa(variant);
                    if ( encodedVariant == password){
                        answer = /*"Расшифрованный пароль: " + */  variant;
                    }
                }
            }
        }
    }
}

console.log(bruteForce(password));