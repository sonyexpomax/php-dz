import React, { Component } from "react";
import './TodoFilter.css';

class TodoFilter extends Component {

    changeFilter = (e) => {
        this.props.onChangeFilter(e.target.value);
    };

    render(){
        return (
            <div className={'filter-main'}>
                <h4>Фильтр</h4>
                    <select onChange={this.changeFilter}>
                        <option value="all">All</option>
                        <option value="completed">Completed</option>
                    </select>
            </div>
        );
    }
}

export default TodoFilter;