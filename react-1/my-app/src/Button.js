import React, { Component } from 'react';
import './App.css';

class Button extends Component {

  constructor(){
    super();
    this.state = {value:'push', state: false};
    this.push = this.push.bind(this);
  }

  push (e){
    if(this.state.state){
        this.setState({state:!this.state.state});
        this.setState({value:"push"});
    }
    else{
        this.setState({state:!this.state.state});
        this.setState({value:"pushed"});
    }

  }

  render() {
    return (
      <div>
        <p>Label for checkbox</p>
          <input type="button"  value = {this.state.value} onClick={this.push}/>
      </div>
    );
  }

}
Button.defaultProps ={value:"Push"};
export default Button;
