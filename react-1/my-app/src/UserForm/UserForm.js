import React, { Component } from 'react';
import AgeField from './AgeField';
import NameField from './NameField';

class UserForm extends React.Component {
    constructor(props) {
        super(props);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleSubmit(e) {
        e.preventDefault();
        var name = this.refs.nameField.state.value;
        var age = this.refs.ageField.state.value;
        var message = " Имя: " + name + ", возраст: " + age + '  ';
        if(this.refs.nameField.state.valid && this.refs.ageField.state.valid){
            console.log('%c '+ message, 'background: green; color: white');
        }
        else {
            console.log('%c '+ message, 'background: red; color: white');
        }
    }

    render() {
        return (
            <div className="main-form">
                <h3>Форма заполнения</h3>
                <form onSubmit={this.handleSubmit}>
                    <NameField value="" ref="nameField" />
                    <AgeField value="5" ref="ageField" />
                    <input type="submit" onClick={this.handleSubmit} value="Отправить" />
                </form>
            </div>
        );
  }

}

export default UserForm;
