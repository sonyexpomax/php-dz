import React, { Component } from 'react';
import './App.css';
import RoutingWithSubPages from './components/Routing/RoutingWithSubPages';
class App extends Component {

    constructor(){
        super();
        this.state = {users:[]};
    }

    componentDidMount() {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then((response) => response.json())
            .then((responseJson) => {
                this.setState({users: responseJson});
            })
            .catch((error) => {
                console.error(error);
            });
    }
    render() {
        return (
            <div className="App">
                <RoutingWithSubPages />
            </div>

        )
    }}

export default App;
