import React, { Component } from "react";
import './TodoListItem.css';

class TodoListItem extends Component {

    removeHandler = (e) => {
        e.preventDefault();
        this.props.onRemove(this.props.itemId);
    };

    changeHandler = (e) => {
        this.props.onChangeStateList(this.props.itemId);
        console.log(this.props.task);
    };

    render() {
        let date = new Date(parseInt(this.props.task.date)).toLocaleString();
        let isCheckedClass = this.props.task.isDone < 1 ? 'task-item' : 'task-item isDone';
        let isChecked = this.props.task.isDone > 0;
        return (
            <div className={isCheckedClass} key={this.props.task.id}>

                <input type="checkbox"
                       onChange = {this.changeHandler}
                       defaultChecked = {isChecked}
                />

                {this.props.task.text}

                <small>{date}</small>
                <button
                    className={'remove-task'}
                    title={'Удалить'}
                    ref={this.props.task.id}
                    onClick={this.removeHandler}
                >x</button>

            </div>
        )
    };
}

export default TodoListItem;