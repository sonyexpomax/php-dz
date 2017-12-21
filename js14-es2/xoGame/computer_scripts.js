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
    xo.setComputerMove(id);
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
    xo.setComputerMove(id);
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

    //attack move
    for (let i = 0; i < xoComputer.computerPossibleCombination.length; i++) {
        for (let j = 0; j < xoComputer.computerPossibleCombination[i].length; j++) {
            if(xo.freeFields.indexOf(xoComputer.computerPossibleCombination[i][j]) !== -1){
                console.log('attack');
                return xoComputer.computerPossibleCombination[i][j];
            }
        }
    }

    //defence move
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

    //random move
    return xoComputer.stupidGetId();
};
export {xoComputer};