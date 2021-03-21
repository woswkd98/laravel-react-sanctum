import React, { useEffect, useState} from 'react';

import LinkButton from '../common/LinkButton'

import axios from 'axios';


const Board = ({match}) => {
    const [post, setPost] = useState({});
    useEffect(() => {
        
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
            <LinkButton to = '/boardList'>list</LinkButton> 
            <LinkButton to = {linkPath}>edit</LinkButton> 
            
        </div>
    
    
    );
}


export default Board;