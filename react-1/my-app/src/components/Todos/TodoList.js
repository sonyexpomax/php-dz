import React, { Component } from "react";
import TodoListItem from './TodoListItem';
import './TodoList.css';


class TodoList extends Component {

    removeItem = (id) => {
        this.props.onDelete(id);
    };

    changeItem = (id) => {
        this.props.onChangeState(id);
    };

    render() {
        let ctx = this;
        console.log(this.props);
         return (
             <div>
                <h3>Список заданий</h3>
                <div className={'task-list'}>
                {
                    this.props.tasks.map(function (item) {
                        return <TodoListItem key={item.text+item.date} task = {item} itemId={item.id} onRemove = {ctx.removeItem} onChangeStateList = {ctx.changeItem} /*remove={this.removeTask(item)}*/ />
                    })
                }
                </div>
             </div>
         )
    };
}


export default TodoList;