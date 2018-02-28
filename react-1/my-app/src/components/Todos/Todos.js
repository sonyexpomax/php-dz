import React, { Component } from "react";
import TodoList from './TodoList'
import TodoAdd from './TodoAdd'
import './Todos.css';

class Todos extends Component {

    constructor() {
        super();
        this.state = {
            tasks: [],
            maxId: 0
        };
    }

    componentWillMount() {
        this.getTasks();
    }

    findMaxId = () => {
        let m = 0;
        for(let i = 0; i < this.state.tasks.length; i++ ){
            if(parseInt(this.state.tasks[i].id) > m ){
                m = parseInt(this.state.tasks[i].id);
            }
        }
        this.setState({maxId: (m+1)});
    };

    getTasks = () => {
        fetch('http://frer.zzz.com.ua/getTasks.php')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({tasks: responseJson});
                this.findMaxId();
            })
            .catch((error) => {
                console.error(error);
            });
    };

    addTaskToState = (newText, newDate) => {
        this.state.tasks.push({
            id:this.state.maxId.toString(),
            text:newText,
            date:newDate,
            isDone: '0'
        });
        this.setState({maxId: (this.state.maxId + 1)});
    };

    removeTaskFromState = (id) => {
        let f = this.state.tasks.filter(function (item) {
            return (item.id !== id);
        });
        this.setState({ tasks: f });
    };

    changeStateInState = (id) => {
        for(let i = 0; i < this.state.tasks.length; i++){
            let item = this.state.tasks[i];
            if(item.id == id){
                if(this.state.tasks[i].isDone > 0){
                    this.state.tasks[i].isDone = '0';
                }
                else {
                    this.state.tasks[i].isDone = '1';
                }
                return;
            }
        }
    };

    updateItems = (newText) => {

        let newDate = Date.now().toString();
        fetch('http://frer.zzz.com.ua/addTask.php', {
            method: 'POST',
            body: JSON.stringify({
                newText: newText,
                newDate: newDate
            })
        })
            .then(() => {
                this.addTaskToState(newText, newDate);
            })
            .catch((error) => {
                console.error(error);
            });
    };

    deleteItem = (id) => {
        fetch('http://frer.zzz.com.ua/removeTask.php', {
            method: 'POST',
            body: JSON.stringify({
                id: id,
            })
        })
            .then(() => {
                this.removeTaskFromState(id);
            })
            .catch((error) => {
                console.error(error);
            });
    };

    changeStateItem = (id) => {
        fetch('http://frer.zzz.com.ua/changeStateTask.php', {
            method: 'POST',
            body: JSON.stringify({
                id: id,
            })
        })
            .then(() => {
                this.changeStateInState(id);
            })
            .catch((error) => {
                console.error(error);
            });
    };

    render() {
        return (
            <div className="todoListMain">
                <TodoAdd onFormSubmit={this.updateItems}/>
                <TodoList tasks={this.state.tasks} onDelete={this.deleteItem} onChangeState={this.changeStateItem} />
            </div>
        );
    }
}

export default Todos;