
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
    const getImageIdx = () => { 
        axios.get("api/files/index").then(res => {
          console.log(res);
        })
    }

    const getImageById = () => { 
      axios.get("api/files/1").then(res => {
        setVisImage(res.data.imageInfos.path);
      })
  }

        return (
          <div>
            <input type="file" name="file" onChange={handleFileInput}/>
            <button type="button" onClick={handlePost}>전송</button>
            <button type="button" onClick={getImageIdx}>내가 가지고 있는 이미지 목록</button>
            
          </div>
        )
    /*
    <button type="button" onClick={getImageById}>이미지 보여주기</button>
            <img src={"http://127.0.0.1:8000/" + 'storage/' + visImage}  width="90px" height="50px"></img>
    
    */
}

export default Fileupload;
  
