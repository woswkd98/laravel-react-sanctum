import React, {useState} from "react";
import axios from "axios";
import apiClient from '../../services/api';
//import {withSanctum} from 'react-sanctum';

const Login = (props) => {
   
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    
    const handleSubmit = (e) => {
        e.preventDefault();
        apiClient.get('/sanctum/csrf-cookie') // 생텀 로그인 핵심 
            .then(res => {
                console.log(res);
                
                apiClient.post('/api/login', {
                    email : email,
                    password : password,
                }).then(res =>{
                    console.log(res);
                });
            })
    }
    const logout = () => {
        axios.get('/api/logout').then(res =>{
            console.log(res);
        });
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
                <button type="submit">Login</button>  
            </form>
            <button onClick={logout}>Logout</button>
        </div>
    );
}

export default Login;
  

