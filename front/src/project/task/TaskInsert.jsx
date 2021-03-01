import React, {useState} from "react";
import axios from "axios";
import apiClient from '../../services/api';
const TaskInsert = (props) => {

    const [title, setTitle] = useState('');
    const [context, setContext] = useState('');
    const handleSubmit = (e) => {
        e.preventDefault();
        axios.post('api/tasks', {
            title : title,
            context : context,
        }).then(res => console.log(res));
    }

    return (
        <div>
                <input
                    type="title"
                    name="title"
                    placeholder="title"
                    value={title}
                    onChange={e => setTitle(e.target.value)}
                    required
                />
                <input
                    type="context"
                    name="context"
                    placeholder="context"
                    value={context}
                    onChange={e => setContext(e.target.value)}
                    required
                /> 
                <button onClick ={handleSubmit}>todo save</button>

        </div>
    );
}

export default TaskInsert;
  