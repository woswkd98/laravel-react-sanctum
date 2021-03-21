import React, {useEffect, useState} from 'react';
import axios from 'axios';

import BoardCol from './boardCol'
import LinkButton from '../common/LinkButton'
import apiClient from '../../services/api';
const BoardNew = () => { 
    const [title, setTitle] = useState('');
    const [context, setContext] = useState('');
    
    const submit = (e) => {
        e.preventDefault();
        if(title === '' || context === ''){
            alert('제목 또는 내용이 작성되지 않았습니다')
            return;
        }

        apiClient.post('api/tasks', {
            title : title,
            context : context
        }).then(
            res => {
                console.log(res.data)
                
            }
        );
    }
    return (
        <div>
            title :<input 
                type="text" 
                name="title" 
                value={title}
                onChange={e => {
                    console.log(e.target.value);
                    console.log(title);
                    setTitle(e.target.value)
                }}
                required
            />
            <br/>
            context : <textarea 
                onChange={e => setContext(e.target.value)} 
                rows="5"
            ></textarea>                
            <LinkButton to='/boardList'
                onClick={submit}>submit</LinkButton>        
        </div>
    )
}











export default BoardNew;

//export default BoardNew;