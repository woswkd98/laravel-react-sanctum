
import React, {useState} from "react";
import axios from "axios";
import apiClient from '../../services/api';
const Fileupload = (props) => {
    const [image, setImage] =useState(null); 
    const [visImage, setVisImage] = useState(null); 
    const handleFileInput = (e) => {
        setImage(e.target.files[0]);
        console.log(e.target.files[0]);
      }
    
     const handlePost = () => {
        const formData = new FormData();
        formData.append('file', image);
        console.log(image);
        const config = { //config 객체
            header: { "content-type": "multipart/form-data" }, // 헤더 변경 
        };
        return axios.post("api/files", formData, config).then(res => {
            console.log(res);
        })
      }
    const getImage = () => { 
      
      
    }
 
        return (
          <div>
            <input type="file" name="file" onChange={handleFileInput}/>
            <button type="button" onClick={handlePost}>ㅁㄴㅇㄻ</button>
          </div>
        )
    
}

export default Fileupload;
  
