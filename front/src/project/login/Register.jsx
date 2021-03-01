import React, {useState} from "react";
import axios from "axios";


const Register = (props) => {
   
    
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('')
    const [name, setName] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        axios.post('/api/register', {
            email : email,
            password : password,
            password_confirmation : passwordConfirmation, // 비밀번호 재입력
            name : name
        }).then(res => console.log(res));
    }

    return (
        <div>
         <form onSubmit={handleSubmit}>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required
                />
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    required
                />
                <input
                    type="password"
                    name="passwordConfirmation"
                    placeholder="passwordConfirmation"
                    value={passwordConfirmation}
                    onChange={e => setPasswordConfirmation(e.target.value)}
                    required
                />
                <input
                    type="name"
                    name="name"
                    placeholder="name"
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required
                />
                <button type="submit">Register</button>  
            </form>
        </div>
    );
}

export default Register;