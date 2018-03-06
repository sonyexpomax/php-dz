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
         return (
             <div>
                <div className={'task-list'}>
                {
                    this.props.tasks.map((item) => {
                        return <TodoListItem key={item.text+item.date} task = {item} itemId={item.id} onRemove = {ctx.removeItem} onChangeStateList = {ctx.changeItem} />
                    })
                }
                </div>
             </div>
         )
    };
}

export default TodoList;