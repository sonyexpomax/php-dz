import React, { Component } from "react";
import './TodoListItem.css';

class TodoListItem extends Component {

    removeHandler = (e) => {
        e.preventDefault();
        this.props.onRemove(this.props.itemId);
    };

    changeHandler = (e) => {
        console.log(this.props);
        this.props.onChangeStateList(this.props.itemId);
    };

    render() {
        console.log(this.props);
        let d = new Date(parseInt(this.props.task.date));
        return (
            <div className={this.props.task.isDone < 1 ? 'task-item' : 'task-item isDone'} key={this.props.task.id}>
                <input type="checkbox" onChange={this.changeHandler} defaultChecked={(this.props.task.isDone > 0)} />
                {this.props.task.text}
                <small>{d.toLocaleString()}</small>
                <button className={'remove-task'} title={'Удалить'}  ref={this.props.task.id} onClick={this.removeHandler}>x</button>
            </div>
        )
    };
}

export default TodoListItem;