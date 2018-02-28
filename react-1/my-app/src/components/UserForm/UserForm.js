import React, { Component } from 'react';
import FIOField from './FIOField';
import EmailField from './EmailField';
import PhoneField from './PhoneField';
import CountField from './CountField';
import DeliveryDateField from './DeliveryDateField';
import './UserForm.css';

class UserForm extends React.Component {
    constructor(props) {
        super(props);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.clearInput = this.clearInput.bind(this);
    }

    clearInput(e){
        e.preventDefault();

        this.refs.FIOField.setState({value: ''});
        this.refs.PhoneField.setState({value: ''});
        this.refs.EmailField.setState({value: ''});
        this.refs.DeliveryDateField.setState({value: ''});
        this.refs.CountField.setState({value: ''});
    }

    handleSubmit(e) {
        e.preventDefault();
console.log(this.refs);
        var fields = [];
        fields.push({name:'FIO', refs:this.refs.FIOField});
        fields.push({name:'Phone', refs:this.refs.PhoneField});
        fields.push({name:'Count', refs:this.refs.CountField});
        fields.push({name:'DeliveryDate', refs:this.refs.DeliveryDateField});
        fields.push({name:'Email', refs:this.refs.EmailField});

       fields.forEach(function (field, i) {
           if(field.refs.state.valid){
               console.log('%c '+ field.name +': ' + field.refs.state.value, 'background: green; color: white');
           }
           else {
               console.log('%c '+ field.name +': ' + field.refs.state.value, 'background: red; color: white');
           }
       });
    }

    render() {
        return (
            <div>
                <h2>User form</h2>
                <form id="form_1" name="form_submit" onSubmit={this.handleSubmit}>
                    <FIOField value="" ref="FIOField" />
                    <EmailField value="" ref="EmailField" />
                    <PhoneField value="" ref="PhoneField" />
                    <CountField value="" ref="CountField" />
                    <DeliveryDateField value="" ref="DeliveryDateField" />
                    <div className="sub">
                        <div className="footer">
                            <input type="submit" id="submit" value="Отправить" />
                            <input type="reset" id="reset" value="Очистить" onClick={this.clearInput}/>
                        </div>
                    </div>
                </form>
            </div>

        );
    }
}

export default UserForm;
