import React, {useState} from "react";
import { connect } from 'react-redux';
import axios from "axios";
import apiClient from '../../services/api';
//import {withSanctum} from 'react-sanctum';
import {login, logout} from '../redux/reducers/loginReducer'
import {useCookies} from 'react-cookie'

const Login = (/*{login, logout}*/) => {
   
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [cookies, setCookies, removeCookies] = useCookies([]);

    const handleSubmit = (e) => {
        e.preventDefault();
        apiClient.get('/sanctum/csrf-cookie') // 생텀 로그인 핵심 
            .then(res => {
                console.log(res);
                apiClient.post('/api/login', {
                    email : email,
                    password : password,
                }).then(res =>{
                    if(res.data.result) {
                        setCookies('user_id',res.data.user_id, {maxAge : 3 * 24 * 60 * 60});
                        setCookies('user_email',res.data.user_email, {maxAge : 3 * 24 * 60 * 60});
                    }
                    alert(res.data.msg)
                    
                })
            })
    }
    const logoutHandle = () => {
        //logout();
        removeCookies('user_id');
        removeCookies('user_email');
        axios.get('/api/logout').then(res =>{    
            alert(res.data.msg);
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
            <button onClick={logoutHandle}>Logout</button>
          
        </div>
    );
}
//https://velog.io/@tunakim/%EB%A6%AC%EC%95%A1%ED%8A%B8%EB%A5%BC-%EB%8B%A4%EB%A3%A8%EB%8A%94-%EA%B8%B0%EC%88%A0-%EC%A0%95%EB%A6%AC-17-3
// 여기서 보면 결국 이 형식을 쓰게 되는데 bindActionCreators 함수를 
/*export default connect(

    state => ({
        user_id : state.user_id,
        user_email : state.user_email
    }), {
        login,
        logout
    }
)(Login);*/
export default Login;

  

