import React, {useEffect} from 'react';
import { Route } from 'react-router-dom';
import BoardList from './project/Board/boardList'
import BoardNew from './project/Board/boardNew'
import Login from './project/login/Login'
import Register from './project/login/Register'
import Board from './project/Board/board'
import BoardEdit from './project/Board/boardEdit' 
import axios from 'axios';
import apiClient from './services/api'
import LinkButton from './project/common/LinkButton'
import Users from './project/user/Users'
import Fileupload from './project/fileupload/Fileupload'
function App() {

  
  return (
    <div className="App">

          <Route path="/BoardNew" component={BoardNew} exact = {true} />  
          <Route path="/BoardList" component={BoardList} exact = {true}  />
          <Route path="/Login" component={Login} exact = {true}  />
          <Route path="/Join" component={Register} exact = {true}  />
          <Route path="/board/:post_id" component = {Board} exact = {true}/>
          <Route path="/boardEdit/:post_id" component = {BoardEdit} exact = {true}/>
          <LinkButton to = '/Login'>login</LinkButton> 
          <LinkButton to = '/BoardList'>board</LinkButton> 
          <LinkButton to = '/Join'>Register</LinkButton> 
          <Route path="/fileupload" component={Fileupload}/>
          <Route path="/user" component={Users}/>
    </div>
  );
}

export default App;
