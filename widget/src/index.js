import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as serviceWorker from './serviceWorker';

// The argument passed to our component is a "props" object. Use ES6
// destructuring assignment syntax to extract `props.settings` as a named
// variable. Then, use `color` and `name` from it in our output.
const App = ({ settings }) => (
  <div className="App" style={{borderColor: settings.color}}>
    <span className="App__Message">Hello,<br />{settings.name}!</span>
  </div>
);

const targets = document.querySelectorAll('.erw-root');
Array.prototype.forEach.call(targets, target => {
  // Retrieve this instance's unique ID from the dataset.
  const id = target.dataset.id;

  // Pull the settings object unique to this instance from the window-global
  // settings object.
  const settings = window.erwSettings[id];

  // Pass settings to our component as a named property ("prop").
  ReactDOM.render(<App settings={settings} />, target)
});

serviceWorker.unregister();
