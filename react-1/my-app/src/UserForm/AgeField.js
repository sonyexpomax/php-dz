import React, { Component } from 'react';

class AgeField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }
    validate(val){
        return val>=0;
    }
    onChange(e) {
        var val = e.target.value;
        var isValid = this.validate(val);
        this.setState({value: val, valid: isValid});
    }
    render() {
        var color = this.state.valid===true?"green":"red";
        return <p>
            <label>Возраст:</label><br />
            <input type="number" value={this.state.value}
                   onChange={this.onChange} style={{borderColor:color}} />
        </p>;
    }
}
export default AgeField;
