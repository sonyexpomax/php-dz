import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Link, Switch } from "react-router-dom";
import './Users.css';

class Users extends Component {

    constructor(){
        super();
        this.state = {users:[]};
    }

    componentWillMount() {
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
        const userId = parseInt(this.props.match.params.userId);
        const users = this.state.users;
        console.log('userId = ' + userId);
        console.log(users);

            if (this.props.match.params.userId) {
                return (
                    <div>
                        {
                            users.map(function (item) {
                                if(item.id === userId) {
                                    return (
                                        <div className={'contact'}>
                                            <h2>{item.name}</h2>
                                            <p><strong>User name: </strong>{item.username}</p>
                                            <p><strong>Phone number: </strong>{item.phone}</p>
                                            <p><strong>Email: </strong>{item.email}</p>
                                            <p><strong>Web address: </strong>{item.website}</p>
                                            <p><strong>Address: </strong>{item.address.city}, {item.address.street}, {item.address.suite}</p>
                                        </div>
                                    )
                                }
                            })

                        }
                    </div>
                )
            }
            else{
                return (
                    <div>
                        <aside>
                            <h2>Users+</h2>
                            <ul>
                                {
                                    users.map(function (item) {
                                        return (
                                            <li key={item.id}>
                                                <Link to={`/users/${item.id}`}>{item.name}</Link>
                                            </li>
                                        )

                                    })

                                }
                            </ul>
                        </aside>
                        <Switch>
                            <Route path="/users/:userId(\d+)" component={Users} />
                        </Switch>

                    </div>

                )}
            }
}

const User = ({ match }) => (
            <article>
                <p>dfsdfsdfsdfssdf</p>
                {
                this.state.users.map(function(item, i){
                // if (item.id == match.params.userId){
                return (
                <h2 key={item.id + "-" + item.name}>{item.name}</h2>
                )
                // }
                })
                }
            </article>
);

export default Users;