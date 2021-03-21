import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import { BrowserRouter } from 'react-router-dom';
import * as serviceWorker from './serviceWorker';
import {Provider} from 'react-redux'
import { createStore}  from 'redux' // 전역 데이터에 접근하기 위해 
import { composeWithDevTools } from "redux-devtools-extension";
import rootReducer from './project/redux/reducers/rootReducer'
import { CookiesProvider } from 'react-cookie';

const store = createStore(rootReducer, composeWithDevTools());

ReactDOM.render(
  <CookiesProvider>
  <Provider store = {store}>
    <BrowserRouter>
    <App />
    </BrowserRouter>
    </Provider>
    </CookiesProvider>
  ,
  document.getElementById('root')
);



// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
//<React.StrictMode>
serviceWorker.unregister();
