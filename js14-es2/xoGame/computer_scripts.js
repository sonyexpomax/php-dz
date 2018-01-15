let xoComputer = {
    computerMoves: [],
    computerPossibleCombination: [],
    computerMove: null,
    computerCalculation : false,
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
};

xoComputer.stupidComputerMove = (userPossibleCombination, userMoves, freeFields) => {
    let id = null;
    xoComputer.computerCalculation = true;
    if(xoComputer.countOfEmptyFields(freeFields)[0] === 1){
        id = xoComputer.countOfEmptyFields(freeFields)[1];
    }
    else {
        id = xoComputer.stupidGetId(freeFields);
    }
    xoComputer.setComputerMove(id, freeFields, computerSymbol);
};

xoComputer.smartComputerMove = (userPossibleCombination, userMoves, freeFields) => {
    let id = null;
    xoComputer.computerCalculation = true;

    //last move
    if(xoComputer.countOfEmptyFields(freeFields)[0] === 1){
        id = xoComputer.countOfEmptyFields(freeFields)[1];
    }
    else {
        //first move
        if (xoComputer.computerMoves.length === 0) {
            // check central field
            id = (freeFields[5] !== undefined) ? 5 : xoComputer.stupidGetId();
        }
        else {  // next moves
            xoComputer.deleteUnpossibleCombinations(userMoves, xoComputer.computerPossibleCombination);
            id = xoComputer.smartGetId(userPossibleCombination, userMoves, freeFields);
        }
        xoComputer.makeListOfPossibleCombinations(id, xoComputer.computerMoves, userMoves, xoComputer.computerPossibleCombination);
    }
    xoComputer.setComputerMove(id, freeFields, computerSymbol);
};

xoComputer.stupidGetId = (freeFields) => {
    let i = 0;
    let id = null;
    while (i < 1) {
        id = Math.floor(Math.random() * 9);
        freeFields[id] === undefined ? i = 0 : i++;
    }
    return id;
};

xoComputer.smartGetId = (userPossibleCombination, userMoves) => {

    //attack move
    for (let i = 0; i < xoComputer.computerPossibleCombination.length; i++) {
        for (let j = 0; j < xoComputer.computerPossibleCombination[i].length; j++) {
            if(freeFields.indexOf(xoComputer.computerPossibleCombination[i][j]) !== -1){
                console.log('attack');
                return xoComputer.computerPossibleCombination[i][j];
            }
        }
    }

    //defence move
    for (let i = 0; i < userPossibleCombination.length; i++) {
        console.log('defence');
        let k = 0;
        for (let j = 0; j < userMoves.length; j++) {
            if (userMoves[j] === userPossibleCombination[i][0] || userMoves[j] === userPossibleCombination[i][1] || userMoves[j] === userPossibleCombination[i][2]){
                k++;
            }
        }
        if(k === 2){
            for (let y = 0; y < userPossibleCombination[i].length; y++) {
                if (freeFields.indexOf(userPossibleCombination[i][y]) !== -1) {
                    return userPossibleCombination[i][y];
                }
            }
        }
    }

    //random move
    return xoComputer.stupidGetId();
};

xoComputer.deleteUnpossibleCombinations = (typeMoves, typePossibleCombination) => {
    let previousId = typeMoves[typeMoves.length - 1];
    let possibleCombinationToDel = [];

    for (let i = 0; i < typePossibleCombination.length; i++) {
        for (let j = 0; j < typePossibleCombination[i].length; j++) {
            if (previousId === typePossibleCombination[i][j]) {
                possibleCombinationToDel.push(i);
            }
        }
    }

    for (let i = 0; i < possibleCombinationToDel.length; i++) {
        typePossibleCombination.splice(possibleCombinationToDel[i], 1);
    }
};

xoComputer.countOfEmptyFields = (freeFields) => {
    let emptyFields = 9;
    let lastEmptyField = null;
    for (let i = 1; i < freeFields.length; i++) {
        if (freeFields[i] === undefined){
            emptyFields--;
        }
        else{
            lastEmptyField = i;
        }
    }
    return [emptyFields, lastEmptyField];
};

xoComputer.setComputerMove = (id, freeFields, computerSymbol) => {
    console.log('setComputerMove id = ' + id);
    delete freeFields[id];
    setTimeout(function () {
        document.body.querySelector('#field-' + id).textContent = computerSymbol;
        document.body.querySelector('#field-' + id).style.cursor = 'not-allowed';
        xoComputer.computerCalculation = false;
    },300);

    xoComputer.computerMoves.push(id);

};

xoComputer.makeListOfPossibleCombinations = (id, againstMoves ) => {
    for (let i = 0; i < xoComputer.possibleCombination.length; i++) {
        if (xoComputer.possibleCombination[i][0] === id || xoComputer.possibleCombination[i][1] === id || xoComputer.possibleCombination[i][2] === id) {
            if (xoComputer.possibleCombination[i][0] !== againstMoves[0] && xoComputer.possibleCombination[i][1] !== againstMoves[0] && xoComputer.possibleCombination[i][2] !== againstMoves[0]) {
                if(xoComputer.computerMoves.length > 1) {
                    let k = 0;
                    for (let j = 0; j < xoComputer.computerPossibleCombination.length; j++) {
                        if (xoComputer.possibleCombination[i] === xoComputer.computerPossibleCombination[j]) {
                            k++;
                        }
                    }
                    (k === 0) ? xoComputer.computerPossibleCombination.push(xoComputer.possibleCombination[i]) : '';
                }
                else {
                    xoComputer.computerPossibleCombination.push(xoComputer.possibleCombination[i]);
                }
            }
        }
    }
};

export {xoComputer};