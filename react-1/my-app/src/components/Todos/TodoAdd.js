import React, { Component } from "react";
import './TodoAdd.css';

class TodoAdd extends Component {

    addTask = (e) => {
        e.preventDefault();
        this.props.onFormSubmit(this.refs.taskInput.value);
        this.refs.taskInput.value = '';
    };

    render(){
        return (
            <div>
                <h3>Добавить задание</h3>
                <form onSubmit={this.addTask} className={'add-form'}>
                    <input ref='taskInput' placeholder="Введите новое задание" className={'add-text'} />
                    <button type="submit" className={'add-button'}>Добавить</button>
                </form>
            </div>
        );
    }
}

export default TodoAdd;