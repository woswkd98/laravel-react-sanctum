import React, { useState, useEffect } from 'react'
import axios from 'axios'
import LinkButton from '../common/LinkButton'
import appClient from '../../services/api'

const BoardEdit = ({match}) => {
    const [title, setTitle] = useState('')
    const [context, setContext] = useState('')

    const submit =  () => {
        appClient.put('/api/tasks/' + match.params.post_id, {
            title : title,
            context : context
        })

    }
    const linkPath = '/tasks/' + match.params.post_id;

    return (
        <div>
            
            title<input type="text" onChange={e => setTitle(e.target.value)}></input>
            <br></br>
            body<textarea onChange={e => setContext(e.target.value)} rows="5"></textarea>  
       
            <LinkButton to = {linkPath} onClick = {submit}>awetawe</LinkButton>

        </div>
    )    
}

export default BoardEdit;