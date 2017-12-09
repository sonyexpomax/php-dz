let xoComputer = {};
xoComputer.stupidComputerMove = () => {
    let id = null;
    xo.computerCalculation = true;
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
    xo.computerCalculation = true;
    //last move
    if(xo.countOfEmptyFields()[0] === 1){
        id = xo.countOfEmptyFields()[1];
    }
    else {
        //first move
        if (xo.computerMoves.length === 0) {

            // check central field
            id = (xo.freeFields[5] !== undefined) ? 5 : xoComputer.stupidGetId();

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

            id = xoComputer.smartGetId();
            console.log('id = ' + id);
        }
    }
    xoComputer.setComputerMove(id);
};

xoComputer.setComputerMove = (id) => {

    let promise = new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve("result");
        }, 1000);
    });

    promise.then(
            result => {
                delete xo.freeFields[id];
                document.body.querySelector('#field-' + id).textContent = xo.computerSymbol;
                document.body.querySelector('#field-' + id).style.cursor = 'not-allowed';
                xo.computerMoves.push(id);
                xo.checkWinning(xo.computerMoves, 'computer');
                xo.computerCalculation = false;
            },
            error => {
                alert("Rejected: " + error); // error - аргумент reject
            }
    );
};

/**
 *
 * @returns id
 */
xoComputer.stupidGetId = () => {
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
xoComputer.smartGetId = () => {
    for (let i = 0; i < xo.computerPossibleCombination.length; i++) {
        for (let j = 0; j < xo.computerPossibleCombination[i].length; j++) {
            if(xo.freeFields.indexOf(xo.computerPossibleCombination[i][j]) !== -1){
                return xo.computerPossibleCombination[i][j];
            }
        }
    }
    console.log('id = ' + id);
};
export {xoComputer};