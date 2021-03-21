import {createAction, handleActions} from 'redux-actions'

const LOGIN ='login/LOGIN';
const LOGOUT = 'login/LOGOUT';

export const login = createAction(
        LOGIN, 
        input => ({
            user_id : input.user_id,
            user_email : input.user_email
        })
    );
export const logout = createAction(
        LOGOUT,
        input => ({
            user_id : '',
            user_email : ''
        })
    );

const initalState = {
    user_id : '',
    user_email : ''
}

const loginReducer = handleActions(
    {
        [LOGIN] : (state, action) => ({
            user_id : action.payload.user_id,
            user_email : action.payload.user_email,
        }),
        [LOGOUT] : (state, action) => ({
            user_id : '',
            user_email :'',
        }),
        
    },
    initalState, 
)
export default loginReducer;