import React, {useEffect, useState} from 'react';
import axios from 'axios';

import BoardCol from './boardCol'
import LinkButton from '../common/LinkButton'
import { connect } from 'react-redux';
import appClient from '../../services/api'
import {useCookies} from 'react-cookie'

const BoardList = ({user_id}) => {
    const [tasks, setTasks] = useState([])
    const [cookies, setCookies, removeCookies] = useCookies([]);
    
    useEffect(() => {
        console.log("11111111");
        console.log(cookies.user_id);
        appClient.get("/api/tasks").then(res => {
           
            return res.data.posts;      
        }).then((val) => {
            
            setTasks(
                [ ...val.map((val, k) => {
                    return <BoardCol 
                    author = {val.email}
                    title = {val.title}
                    context = {val.context}
                    createdAt = {val.created_at}
                    updatedAt = {val.updated_at}
                    index = {val.id}
                />})]
                )
        })

        return () => {
            
        }
    }, [])

    

    return(
        
        <div>
            <table border="1">
            <thead>
                <tr>
                <th>Index</th>
                <th>Author</th>
	            <th>title</th>
	            <th>createdAt</th>
                <th>updatedAt</th>
                <th>delete</th>
                </tr>
                </thead>
            <tbody>
                {tasks}
            </tbody>
         
            </table>
            <br/>
            <br/>
            {
                cookies.user_id !== undefined ? 
                    <LinkButton to = '/boardNew' >New</LinkButton>   
                    : 
                    null
            }
            <br/>
            <br/>
           
            
           
            
        </div>
    )
}


export default (BoardList);








