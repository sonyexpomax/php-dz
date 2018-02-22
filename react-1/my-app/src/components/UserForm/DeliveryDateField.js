import React, { Component } from 'react';
import './DeliveryDateField.css';

class DeliveryDateField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }
    validate(val){
        var pattr =  /^([0-2]\d|3[01])\.(0\d|1[012])\.(\d{4})$/;
        if(val.match(pattr)){
            return true;
        }
        return false;
    }
    onChange(e) {
        var val = e.target.value;
        var isValid = this.validate(val);
        this.setState({value: val, valid: isValid});
    }
    render() {
        var color = this.state.valid===true?"green":"red";
        return <p className="pad">
            <label>Дата дост:
                <span>*</span>
                <br />
                <input type="text" required id="e2" value={this.state.value} onChange={this.onChange} style={{borderColor:color}}  />
                <br />
                <small>Пример заполнения: 20.10.2017</small>
            </label>
        </p>;
    }
}
export default DeliveryDateField;
