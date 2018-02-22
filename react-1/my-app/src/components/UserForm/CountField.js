import React, { Component } from 'react';
import './CountField.css';

class CountField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }

    validate(val){
        if(val.length > 0){
            var pattr =  /^[0-9]+$/i;
            if(val.match(pattr)){
                return true;
            }
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
            <label>Количество:
                <span>*</span>
                <br />
                <input type="text" id="k2" required value={this.state.value} onChange={this.onChange} style={{borderColor:color}} />
            </label>
        </p>;
    }
}
export default CountField;
