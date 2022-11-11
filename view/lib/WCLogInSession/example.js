import {AppView} from './view/appView.js';
//import {HomeModel} from './model.js';

function startGUIApplication()
{
	let myappView = new AppView();
	document.body.appendChild(myappView);
}
window.addEventListener('load',startGUIApplication );
