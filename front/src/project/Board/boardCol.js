
import React from 'react';
import Axios from 'axios';

import PropTypes from 'prop-types';
import { Link,Redirect } from "react-router-dom";
import LinkButton from '../common/LinkButton';
import appClient from '../../services/api'
const BoardCol= (props) => {
    const {
        index,
        title,
        createdAt,
        updatedAt,
        author,
        history,
      } = props;


  const linkPath = '/board/' + index;

   const deleteCol = () => {
    
      
       
      appClient.delete('api/tasks/' + index).then(res => console.log(res));
      
        
        return <Redirect to = "/board/List"></Redirect>
    }
        
    return (
           
                <tr>
                <td>{index}</td>
                <td>{author}</td>
                <td>
                <Link to = {linkPath}>
                    {title}
                  </Link>
                </td>
                <td>{createdAt}</td>
                <td>{updatedAt}</td>
                <td><button onClick = {() => {
                  deleteCol();
                }
                }>삭제</button></td>
                </tr>
    );

          


}
BoardCol.propTypes = {
    title: PropTypes.string.isRequired, // props에서 to는 스트링 형태여야하고
    createdAt: PropTypes.string.isRequired,
    index: PropTypes.number.isRequired, // child는 노드형태여야한다
  }
export default BoardCol;
