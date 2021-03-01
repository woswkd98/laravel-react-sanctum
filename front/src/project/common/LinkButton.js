import React from 'react';

import PropTypes from 'prop-types';
import { withRouter } from 'react-router';
//https://stackoverflow.com/questions/42463263/wrapping-a-react-router-link-in-an-html-button 써먹기 좋은 링크 버튼 코드

const LinkButton = (props) => {
    const {
        history,
        location,
        match,
        staticContext,
        to,
        onClick, // 프롭스로 내가 넣을껄 다 지정해 놓고

        ...rest
    } = props
    return (
        <button
            {...rest}


            onClick={(event) => {
                onClick && onClick(event); // 내가 선택한게 함수냐
                history.push(to); // 실행
            }}
        />
    )
}

LinkButton.propTypes = {
    to: PropTypes.string.isRequired, // props에서 to는 스트링 형태여야하고
    children: PropTypes.node.isRequired // child는 노드형태여야한다
}

export default withRouter(LinkButton) //라우터 컴포넌트가 아닌 곳에서 math, location, history 사용하는 속성이다.

