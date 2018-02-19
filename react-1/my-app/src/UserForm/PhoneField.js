import React, { Component } from 'react';

class PhoneField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }
    validate(val){
        var pattr =  /^[\+]{0,1}[0-9]{7,12}$/i;
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
            <label>Телефон:
                <br />
                <input type="text" name="phone" id="p3" value={this.state.value} onChange={this.onChange} style={{borderColor:color}} />
            </label>
            <br />
            <small>Заполнять можно только цифрами и знаком + в начале</small>
        </p>;
    }
}
export default PhoneField;
