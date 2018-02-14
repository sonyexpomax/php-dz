import React, { Component } from 'react';
import './App.css';


class Toggle extends Component {
  render() {
    return (
      <div>
        <p>Label for checkbox</p>
          <input type="checkbox"  checked={this.props.isChecked}/>
      </div>
    );
  }
}

export default Toggle;
