// resources/js/components/Main.jsx
import React from 'react';
import ReactDOM from 'react-dom';
import HelloWorld from './HelloWorld';

const Main = () => {
    return (
        <div>
            <h1>Laravel React App</h1>
            <HelloWorld />
        </div>
    );
};

ReactDOM.render(<Main />, document.getElementById('app'));
