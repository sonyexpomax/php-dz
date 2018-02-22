import React, { Component } from 'react';
import './FIOField.css';

class FIOField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }
    validate(val){
        var pattr = /^[a-zа-яё\-\s]+\s[a-zа-яё\-\s]+\s[a-zа-яё\-\s]+$/i;
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
            <label>ФИО:
                <span>*</span>
                <br />
                <input type="text" required id="f1" value={this.state.value} onChange={this.onChange} style={{borderColor:color}} />
            </label>
        </p>;
    }
}
export default FIOField;
