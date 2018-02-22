import React, { Component } from 'react';
import './App.css';
import Toggle from './Toggle';
import Button from './Button';
import UserForm from './components/UserForm/UserForm';
import RoutingWithSubPages from './components/Routing/RoutingWithSubPages';

import {BrowserRouter as Router, Route, Switch, Link } from 'react-router-dom'

class App extends Component {

  render() {
      // const checkBoxState = true;

    return (
      <div className="App">
            <RoutingWithSubPages />
          {/*<Router>*/}
              {/*<div>*/}
                  {/*<nav>*/}
                      {/*<ul>*/}
                          {/*<li><Link to='/'>Home</Link></li>*/}
                          {/*<li><Link to='/about'>About</Link></li>*/}
                      {/*</ul>*/}
                  {/*</nav>*/}

                  {/*<Switch>*/}
                      {/*<Route exact path="/" component = {Main}/>*/}
                      {/*<Route exact path="/about" component = {About}/>*/}
                      {/*<Route component = {Non}/>*/}
                  {/*</Switch>*/}
              {/*</div>*/}

          {/*</Router>*/}

          {/*<h2 className="h">Форма оформления заказа</h2>*/}
          {/*<Toggle isChecked={checkBoxState} />*/}
          {/*<Button />*/}
          {/*<UserForm />*/}
       </div>


    );
  }
}

export default App;
