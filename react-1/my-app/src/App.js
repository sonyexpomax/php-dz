import React, { Component } from 'react';
import './App.css';
import RoutingWithSubPages from './components/Routing/RoutingWithSubPages';
class App extends Component {

    constructor(){
        super();
        this.state = {users:[]};
        console.log(this.state);
    }

    componentDidMount() {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then((response) => response.json())
            .then((responseJson) => {

                this.setState({users: responseJson});
                console.log(this.state);
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

//
// const Users = ({ match }) => (
//     <div>
//         <aside>
//             <h2>Users</h2>
//             <ul>
//                 {
//                     this.state.users.map(function(item){
//                         return (
//                             <li key={item.id}>
//                                 <Link to={`${match.url}/${item.id}`}>{item.name}</Link>
//                             </li>
//                         )
//                     })
//                 }
//             </ul>
//         </aside>
//         <Route path={`${match.url}/:userId`} component={User} />
//         <Route exact path={match.url} component={ChooseUser} />
//     </div>
// );

// const User = ({ match }) => (
//     <article>
//         {
//             this.state.user.map(function(item, i){
//                 if (item.id == match.params.userId){
//                     return (
//                         <div>
//                             <h2 key={item.id + "-" + item.name}>{item.name}</h2>
//                             <p>{item.user.name}</p>
//                         </div>
//                     )
//                 }
//             })
//         }
//     </article>



export default App;
