import React, { Component } from "react";
import { connect } from 'react-redux';
import TodoList from './TodoList';
import TodoAdd from './TodoAdd';
import TodoFilter from './TodoFilter';
import './Todos.css';

class Todos extends Component {

    constructor() {
        super();
        this.state = {
            tasks: [],
            maxId: 0
        };
        console.log(this.props);
    }

    componentDidMount() {
        console.log(this.props);
    }

    addTaskToState = (newId, newText, newDate) => {
        this.props.onAddTask(
            {
                id:newId.toString(),
                text:newText,
                date:newDate,
                isDone: '0'
            }
        );
        this.setState({maxId: (this.state.maxId + 1)});
        console.log(this.state.maxId);
        console.log(this.props.testStore);
    };

    removeTaskFromState = (id) => {
        this.props.onRemoveTask(id);
    };

    changeStateInState = (id) => {
        this.props.onUpdateTask(id);
    };

    findMaxId = (arrayOfTasks) => {

        console.log(arrayOfTasks);
        let m = 0;
        for(let i = 0; i < arrayOfTasks.length; i++ ){
            console.log(parseInt(arrayOfTasks[i].id));
            if(parseInt(arrayOfTasks[i].id) > m ){
                m = parseInt(arrayOfTasks[i].id);
            }
        }
        return m;
    };


    addTask = (newText) => {

        let newId = this.findMaxId(this.props.testStore) + 1;
        console.log(newId);
        let newDate = Date.now().toString();
        fetch('http://frer.zzz.com.ua/addTask.php', {
            method: 'POST',
            body: JSON.stringify({
                newText: newText,
                newDate: newDate,
                newId: newId
            })
        })
            .then(() => {
                this.addTaskToState(newId, newText, newDate);
            })
            .catch((error) => {
                console.error(error);
            });
    };

    deleteTask = (id) => {

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

    changeTaskState = (id) => {

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

    changeFilter = (filterName) => {

        if(filterName === 'completed') {
            this.props.filterCompleted();
        }
        else if (filterName === 'active') {
            this.props.filterActive();
        }
        else if (filterName === 'all') {
            this.props.filterAll();
        }
    };

    render() {
        console.log(this.props.testStore);
        return (
            <div className="todoListMain">
                <TodoAdd onFormSubmit={this.addTask}/>
                <TodoFilter onChangeFilter={this.changeFilter} />
                <h3>Список заданий</h3>
                <TodoList tasks={this.props.testStore} onDelete={this.deleteTask} onChangeState={this.changeTaskState} />
            </div>
        );
    }
}
export default connect(
    state => ({
        testStore: state
    }),
    dispatch => ({
        onAddTask: (task) => {
            console.log(task);
            dispatch({type: 'ADD_TASK', payload: task})
        },
        onRemoveTask: (id) => {
            console.log(id);
           dispatch({type: 'REMOVE_TASK', payload: id})
        },
        onUpdateTask: (id) => {
            console.log(id);
            dispatch({type: 'UPDATE_TASK', payload: id})
        },
        filterAll: () => {
            dispatch({type: 'SHOW_ALL_1'})
        },
        filterCompleted: () => {
            dispatch({type: 'SHOW_COMPLETED'})
        },
        filterActive: () => {
            dispatch({type: 'SHOW_ACTIVE'})
        }
    })
)
(Todos);
