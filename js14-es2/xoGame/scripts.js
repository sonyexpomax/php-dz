let xo = {
    userSymbol: 'O',
    computerSymbol: 'X',
    userMoves: [],
    computerMoves: [],
    computerPossibleCombination: [],
    freeFields: [, 1, 2, 3, 4, 5, 6, 7, 8, 9],
    possibleCombination: [
        [1, 2, 3],
        [1, 4, 7],
        [1, 5, 9],
        [2, 5, 8],
        [3, 6, 9],
        [3, 5, 7],
        [4, 5, 6],
        [7, 8, 9],
    ],
    computerMove: null,
    score : [0, 0],
    computerCalculation : false,
};

xo.checkGameMode = (type) => {
    let mainHeader = document.createElement('h2');
    if(type === 'stupid'){
        mainHeader.textContent = 'Глупый режим';
        xo.computerMove = xo.stupidComputerMove;
    }
    else{
        mainHeader.textContent = 'Умный режим';
        xo.computerMove = xo.smartComputerMove;
    }

    document.querySelector('.main').style.display = 'block';
    document.querySelector('.main').appendChild(mainHeader);
    document.querySelector(".buttons").style.display = 'none';

    xo.startGame(false);

};

xo.startGame = (isReplay) => {

    if(isReplay){
        xo.clearFields();
        xo.clearInfo();
        let temp = xo.computerSymbol;
        xo.computerSymbol = xo.userSymbol;
        xo.userSymbol = temp;
        xo.userMoves = [];
        xo.computerMoves = [];
        xo.computerPossibleCombination = [];
        xo.freeFields = [,1,2,3,4,5,6,7,8,9];
    }else{
        document.querySelector('header').children[1].style.display='none';
        xo.createFields();
    }

    xo.createInfo();
    document.body.onclick = function(event) {
        let elementWithClick = event.target || event.srcElement;
        if (elementWithClick.className === 'field'){
            let id = elementWithClick.id.substr(elementWithClick.id.length-1,1);
            if(xo.freeFields[id] !== undefined) {
                xo.userMove(elementWithClick.id);
            }
        }
    };
    if(xo.computerSymbol === 'X'){
        xo.computerMove();
    }
};

xo.finish = () => {
    document.body.onclick = null;
    document.querySelector('.info').children['NewGame'].style.display = 'block';
    console.log('finish');
};

xo.createInfo = () => {
    //create info about the current game
    document.querySelector('.info').style.display = 'block';

    let scoreHeader = document.createElement('h3');
    scoreHeader.textContent = 'Общий счет';
    document.querySelector('.info').appendChild(scoreHeader);

    xo.createScore();

    let newParagaph1 = document.createElement('p');
    newParagaph1.textContent = 'Пользователь играет ' + (xo.userSymbol === 'X' ? 'крестиками.' : 'ноликами.');
    document.querySelector('.info').appendChild(newParagaph1);

    let newParagaph2 = document.createElement('p');
    newParagaph2.textContent = 'Компьютер играет ' + (xo.userSymbol === 'X' ? 'ноликами.' : 'крестиками.');
    document.querySelector('.info').appendChild(newParagaph2);
};

xo.createScore = () => {
    let tbl = document.createElement("table");
    let row = document.createElement("tr");
    let cell = document.createElement("td");

    cell.textContent = 'Компьютер';
    row.appendChild(cell);

    cell = document.createElement("td");
    cell.textContent = 'Пользователь';
    row.appendChild(cell);

    tbl.appendChild(row);

    row = document.createElement("tr");

    cell = document.createElement("td");
    cell.textContent = `${xo.score[0]}`;
    row.appendChild(cell);

    cell = document.createElement("td");
    cell.textContent = `${xo.score[1]}`;
    row.appendChild(cell);

    tbl.appendChild(row);

    document.querySelector('.info').appendChild(tbl);
};

xo.clearInfo = () => {
    for(let i = 0; i < 6; i++) {
        let elem = document.querySelector(".info").lastChild;
        elem.parentElement.removeChild(elem);
    }
    document.querySelector('.info').children['NewGame'].style.display = 'none';
};

xo.createFields = () => {
    //create fields
    for(let i = 1; i < 10; i++){
        let newDiv = document.createElement('div');
        newDiv.id = 'field-' + i;
        newDiv.className = 'field';
        document.querySelector('.main').appendChild(newDiv);
    }
};

xo.clearFields = () => {
    for(let i = 1; i < 10; i++){
        document.body.querySelector('#field-' + i).textContent = '';
        document.body.querySelector('#field-' + i).className = 'field';
        document.body.querySelector('#field-' + i).style.cursor = 'pointer';
    }
};

xo.userMove = (id) => {
    let numberId = parseFloat(id.substr(id.length-1,1));
    document.body.querySelector('#' + id).textContent = xo.userSymbol;
    document.body.querySelector('#' + id).style.cursor = 'not-allowed';
    xo.userMoves.push(numberId);

    delete xo.freeFields[numberId];

    if(xo.checkWinning(xo.userMoves, 'user')){
        return;
    }

    xo.computerMove();
};

xo.stupidComputerMove = () => {
    let id = null;
    xo.computerCalculation = true;
    if(xo.countOfEmptyFields()[0] === 1){
        id = xo.countOfEmptyFields()[1];
    }
    else {
        id = xo.stupidGetId();
    }
    setComputerMove(id);
};

xo.smartComputerMove = () => {
    let id = null;
    xo.computerCalculation = true;
    //last move
    if(xo.countOfEmptyFields()[0] === 1){
        id = xo.countOfEmptyFields()[1];
    }
    else {
        //first move
        if (xo.computerMoves.length === 0) {

            // check central field
            id = (xo.freeFields[5] !== undefined) ? 5 : xo.stupidGetId();

            // make list of computer possible combinations
            for (let i = 0; i < xo.possibleCombination.length; i++) {
                if (xo.possibleCombination[i][0] === id || xo.possibleCombination[i][1] === id || xo.possibleCombination[i][2] === id) {
                    if (xo.possibleCombination[i][0] !== xo.userMoves[0] && xo.possibleCombination[i][1] !== xo.userMoves[0] && xo.possibleCombination[i][2] !== xo.userMoves[0]) {
                        xo.computerPossibleCombination.push(xo.possibleCombination[i]);
                    }
                }
            }
        }

        // next moves
        else {
            let previousId = xo.userMoves[xo.userMoves.length - 1];
            let computerPossibleCombinationToDel = [];

            // make list of computer Unpossible combinations
            for (let i = 0; i < xo.computerPossibleCombination.length; i++) {
                for (let j = 0; j < xo.computerPossibleCombination[i].length; j++) {
                    if (previousId === xo.computerPossibleCombination[i][j]) {
                        computerPossibleCombinationToDel.push(i);
                    }
                }
            }

            // delete computer Unpossible combinations
            for (let i = 0; i < computerPossibleCombinationToDel.length; i++) {
                xo.computerPossibleCombination.splice(computerPossibleCombinationToDel[i], 1);
            }

            id = xo.smartGetId();
            console.log('id = ' + id);
        }
    }
    setComputerMove(id);
};

setComputerMove = (id) => {
    delete xo.freeFields[id];
    setTimeout(function () {
        document.body.querySelector('#field-' + id).textContent = xo.computerSymbol;
        document.body.querySelector('#field-' + id).style.cursor = 'not-allowed';
    },300);

    xo.computerMoves.push(id);
    xo.checkWinning(xo.computerMoves, 'computer');
    xo.computerCalculation = false;
};

/**
 *
 * @returns id
 */
xo.stupidGetId = () => {
    let i = 0;
    let id = null;
    while (i < 1) {
        id = Math.floor(Math.random() * 9);
        xo.freeFields[id] === undefined ? i = 0 : i++;
    }
    return id;
};

/**
 *
 * @returns id
 */
xo.smartGetId = () => {
    for (let i = 0; i < xo.computerPossibleCombination.length; i++) {
        for (let j = 0; j < xo.computerPossibleCombination[i].length; j++) {
            if(xo.freeFields.indexOf(xo.computerPossibleCombination[i][j]) !== -1){
                return xo.computerPossibleCombination[i][j];
            }
        }
    }
    console.log('id = ' + id);
};

/**
 *
 * @param checkArray
 * @param who
 * @returns {boolean}
 */
xo.checkWinning = (checkArray, who) => {
    if(checkArray.length >= 3) {
        console.log(checkArray);
        for (let i = 0; i < xo.possibleCombination.length; i++) {

            let  x0 = xo.possibleCombination[i][0];
            let  x1 = xo.possibleCombination[i][1];
            let  x2 = xo.possibleCombination[i][2];

            if (checkArray.indexOf(x0) !== -1 && checkArray.indexOf(x1) !== -1 && checkArray.indexOf(x2) !== -1) {          //if won
                let whoName = '';
                if(who === 'user'){
                    whoName ='Пользователь';
                    xo.score[0]++;
                }else{
                    whoName ='Компьютер';
                    xo.score[1]++;
                }

                let newParagaph1 = document.createElement('h4');
                newParagaph1.textContent = `Выиграл ${whoName} !!!`;

                let newParagaph2 = document.createElement('h4');
                newParagaph2.textContent = `Выигрышная комбинация - ${x0}, ${x1}, ${x2}`;

                setTimeout(function () {
                    document.querySelector('#field-' + x0).className += ' won';
                    document.querySelector('#field-' + x1).className += ' won';
                    document.querySelector('#field-' + x2).className += ' won';
                    document.querySelector('.info').appendChild(newParagaph1);
                    document.querySelector('.info').appendChild(newParagaph2);
                },300);
                xo.finish();
                return true;
            }
        }
        console.log('empty = ' + xo.countOfEmptyFields()[0]);

        // check for draw
        if(xo.countOfEmptyFields()[0] === 0){
            setTimeout(function () {
                for (let i = 1; i < 10; i++) {
                    document.querySelector('#field-' + i).className += ' draw';
                }
                xo.score[0] += 0.5;
                xo.score[1] += 0.5;
                let newParagaph1 = document.createElement('h4');
                newParagaph1.textContent = `У нас ничья !!!`;
                document.querySelector('.info').appendChild(newParagaph1);

                let newParagaph2 = document.createElement('h4');
                newParagaph2.textContent = `Нет выигрышной комбинации`;
                document.querySelector('.info').appendChild(newParagaph2);

            },300);
            xo.finish();
        }
        console.log('empty = ' + xo.countOfEmptyFields()[0]);
    }
    return false;
};

xo.countOfEmptyFields = () => {
    let emptyFields = 9;
    let lastEmptyField = null;
    for (let i = 1; i < xo.freeFields.length; i++) {
        if (xo.freeFields[i] === undefined){
            emptyFields--;
        }
        else{
            lastEmptyField = i;
        }
    }
    return [emptyFields, lastEmptyField];
};