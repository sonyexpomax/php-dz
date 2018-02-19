import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import Toggle from './Toggle';
import Button from './Button';
import UserForm from './UserForm/UserForm';

class App extends Component {

  render() {
      const checkBoxState = true;

    return (
      <div className="App">
           {/*<Toggle isChecked={checkBoxState} />*/}
          {/*<Button />*/}
          <UserForm />
      </div>

    );
  }
}

export default App;
