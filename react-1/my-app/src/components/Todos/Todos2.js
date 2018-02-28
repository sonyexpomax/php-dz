import React, { Component } from "react";
import './Todos.css';

let tasksTemp = [];

class Todos2 extends React.Component {

    constructor() {
        super();

        this.state = {tasks: []};

        this.addItem = this.addItem.bind(this);
    }

    componentWillMount() {
        fetch('http://frer.zzz.com.ua/getTasks.php')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({tasks: responseJson});
                tasksTemp = this.state.tasks;
                console.log(this.state.tasks);
            })
            .catch((error) => {
                console.error(error);
            });
    }

    render() {
        var items = this.state.tasks.map((item) => {

            console.log(item);
            return <div>{item.text}</div>;
        });
        return(
            <div>
                <ul>{items}</ul>
                <p><NewTodoItem addEvent={this.addItem} /></p>
            </div>
        );
    }

    addItem(e) {
        e.preventDefault();
        var itemArray = this.state.items;

        if (this.refs.itemName.value !== "") {
            itemArray.push({text: this.refs.itemName.value, date: new Date});

            this.setState({
                tasks: itemArray
            });

            this.refs.itemName.value = "";
        }

        console.log(this.state.tasks);
    }
}

class NewTodoItem extends React.Component {
    constructor(props){
        super(props);
        this.onSubmit = this.onSubmit.bind(this);
    }
    // componentDidMount(){
    //     React.findDOMNode(this.refs.itemName).focus();
    // }
    render(){
        return (<form onSubmit={this.onSubmit}>
            <input ref="itemName" type="text" />
            <input type="submit"/>
        </form>);
    }
    onSubmit(event){
        event.preventDefault();
        // var input = React.findDOMNode(this.refs.itemName);
        var newItem = this.refs.itemName.value;
        console.log(newItem);
        this.props.addEvent({ newItem });
        // // this.refs.itemName.setState({value: ''});
        // console.log(this.allItems);
    }
}

export default Todos2;