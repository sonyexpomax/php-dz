import React, { Component } from 'react';

class EmailField extends React.Component {
    constructor(props) {
        super(props);
        var isValid = this.validate(props.value);
        this.state = {value: props.value, valid: isValid};
        this.onChange = this.onChange.bind(this);
    }
    validate(val){
        var pattr =  /^[a-z\-0-9\_\.]+\@[a-z\-0-9\_]+\.[a-z]{2,4}$/i;
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
            <label>E-mail:
                <span>*</span>
                <br />
                <input type="text" name="e-mail" required id="e2" value={this.state.value} onChange={this.onChange} style={{borderColor:color}}  />
            </label>
        </p>;
    }
}
export default EmailField;
