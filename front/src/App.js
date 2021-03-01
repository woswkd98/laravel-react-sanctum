import React from 'react';
import { Route } from 'react-router-dom';
import Register from './project/login/Register';
import Login from './project/login/Login'
import Users from './project/user/Users'
import TaskInsert from './project/task/TaskInsert'
import TaskList from './project/task/TaskList'


function App() {
  return (
    <div className="App">
         <Route path="/register" component={Register}/>
         <Route path="/login" component={Login}/>
         <Route path="/user" component={Users}/>
         <Route path="/tasksInsert" component={TaskInsert}/>
         <Route path="/taskList" component={TaskList}/>
         <Route path="/get/tasks/Any" component={TaskInsert}/>
    </div>
  );
}

export default App;
