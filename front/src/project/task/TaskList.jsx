
import React, {useState, useEffect} from 'react';
import axios from 'axios';


const TaskList= (props) => {
    const handleSubmit = () => {
        axios.get('api/tasks').then(res => console.log(res));
    }
    const handleSubmit2 = () => {
        axios.get('api/tasks/user').then(res => console.log(res));
    }

    return (
        <div>
              <button onClick ={handleSubmit}>listAny</button>
              <button onClick ={handleSubmit2}>listUser</button>
        </div>
            
    );
    
}

export default TaskList;