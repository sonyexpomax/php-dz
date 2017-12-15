

let xoComputer = {
    computerMoves: [],
    computerPossibleCombination: [],
    computerMove: null,
    computerCalculation : false,


};

xoComputer.stupidComputerMove = () => {
    let id = null;
    xoComputer.computerCalculation = true;
    if(xo.countOfEmptyFields()[0] === 1){
        id = xo.countOfEmptyFields()[1];
    }
    else {
        id = xoComputer.stupidGetId();
    }
    xoComputer.setComputerMove(id);
};


xoComputer.smartComputerMove = () => {
    let id = null;
    xoComputer.computerCalculation = true;

    //last move
    if(xo.countOfEmptyFields()[0] === 1){
        id = xo.countOfEmptyFields()[1];
    }
    else {
        //first move
        if (xoComputer.computerMoves.length === 0) {
            // check central field
            id = (xo.freeFields[5] !== undefined) ? 5 : xo.stupidGetId();
        }
        else {  // next moves
            xo.deleteUnpossibleCombinations(xo.userMoves, xoComputer.computerPossibleCombination);
            id = xoComputer.smartGetId();
        }
        xo.makeListOfPossibleCombinations(id, xoComputer.computerMoves, xo.userMoves, xoComputer.computerPossibleCombination);
    }
    xoComputer.setComputerMove(id);
};


xo.deleteUnpossibleCombinations = (typeMoves, typePossibleCombination) => {
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


xoComputer.setComputerMove = (id) => {
    console.log('setComputerMove id = ' + id);
    delete xo.freeFields[id];
    setTimeout(function () {
        document.body.querySelector('#field-' + id).textContent = xo.computerSymbol;
        document.body.querySelector('#field-' + id).style.cursor = 'not-allowed';
        xoComputer.computerCalculation = false;
    },300);

    xoComputer.computerMoves.push(id);
    xo.checkWinning(xoComputer.computerMoves, 'computer');
};


xoComputer.stupidGetId = () => {
    let i = 0;
    let id = null;
    while (i < 1) {
        id = Math.floor(Math.random() * 9);
        xo.freeFields[id] === undefined ? i = 0 : i++;
    }
    return id;
};

xoComputer.smartGetId = () => {
    //attack
    for (let i = 0; i < xoComputer.computerPossibleCombination.length; i++) {
        for (let j = 0; j < xoComputer.computerPossibleCombination[i].length; j++) {
            if(xo.freeFields.indexOf(xoComputer.computerPossibleCombination[i][j]) !== -1){
                console.log('attack');
                return xoComputer.computerPossibleCombination[i][j];
            }
        }
    }

    //defence

    for (let i = 0; i < xo.userPossibleCombination.length; i++) {
        console.log('defence');
        let k = 0;
        for (let j = 0; j < xo.userMoves.length; j++) {
            if (xo.userMoves[j] === xo.userPossibleCombination[i][0] || xo.userMoves[j] === xo.userPossibleCombination[i][1] || xo.userMoves[j] === xo.userPossibleCombination[i][2]){
                k++;
            }
        }
        if(k === 2){
            for (let y = 0; y < xo.userPossibleCombination[i].length; y++) {
                if (xo.freeFields.indexOf(xo.userPossibleCombination[i][y]) !== -1) {
                    return xo.userPossibleCombination[i][y];
                }
            }
        }
    }
    return xoComputer.stupidGetId();
};
export {xoComputer};