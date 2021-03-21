import React, { useEffect, useState} from 'react';

import LinkButton from '../common/LinkButton'

import axios from 'axios';
import {useCookies} from 'react-cookie'

const Board = ({match}) => {
    const [cookies, setCookies, removeCookies] = useCookies([]);
    const [post, setPost] = useState({});
    useEffect(() => {
        console.log(match.params.post_id);
        axios.get('/api/tasks/' + match.params.post_id).then(
            res => {setPost(res.data.post)
            console.log(res);}
        )
        return () => {
            
        }
    }, [])
    const linkPath = '/boardEdit/' + match.params.post_id;

    return (
        <div>
            <li>
                {post.title}
            </li>
            <li>
                {post.context}
            </li>
            {post.user_id}
            {cookies.user_id}
            <LinkButton to = '/boardList'>list</LinkButton> 
            {
                cookies.user_id == post.user_id ?
                <LinkButton to = {linkPath}>edit</LinkButton>    
                    : 
                    null
            }
            
            
        </div>
    
    
    );
}


export default Board;