import React, {useState} from "react";
import axios from "axios";
import apiClient from '../../services/api';
const Users = (props) => {

    const getAll = () => {
        apiClient.get('api/users')
        .then(res => {
            console.log(res);
        });
    }

    return (
        <div>
            <button onClick = {getAll}>getAll</button>  
        </div>
    );
}

export default Users;
  