import React, { Component } from "react";
import { createStore } from "redux";
import { Provider } from "react-redux";
import Todos from "./Todos";

let tempState = [];

let getTasks = new Promise((resolve, reject) => {
    fetch('http://frer.zzz.com.ua/getTasks.php')
        .then((response) => response.json())
        .then((responseJson) => {
            console.log(responseJson);
            resolve(responseJson);
        })
        .catch((error) => {
            console.error(error);
        });
});

let showAll = () => {
    getTasks
        .then(
            result => { store.dispatch({type: 'SHOW_ALL', payload:result}); },
            error =>  { console.warn(error); }
        );
};

let tasks = (state = [], action) => {

    if (action.type === "CREATE_TASK_LIST") {
        return [
            ...state,
            ...action.payload
        ]
    }

    else if (action.type === "ADD_TASK") {
        return [
            ...state,
            action.payload
        ]
    }

    else if (action.type === "REMOVE_TASK") {
        return state.filter(item => item.id !== action.payload);
    }

    else if (action.type === "UPDATE_TASK") {

        let newState = state;
        for(let i = 0; i < newState.length; i++){
            if(newState[i].id === action.payload){
                newState[i].isDone = (newState[i].isDone === "1") ? "0" : "1";
                break;
            }
        }
        return newState;
    }

    else if (action.type === "SHOW_ALL_1") {
        showAll();
    }

    if (action.type === "SHOW_ALL") {
        return [
            ...action.payload
        ]
    }

    else if (action.type === "SHOW_COMPLETED") {
        return state.filter(item => item.isDone === '1');
    }
    return state;
};

const store = createStore(tasks);

getTasks
    .then(
        result => { store.dispatch({type: 'CREATE_TASK_LIST', payload:result}); },
        error =>  { console.warn(error); }
    );

const TodoMain = () => (
    <Provider store={store}>
        <Todos maxId={this.maxId}/>
    </Provider>
);

export default TodoMain;