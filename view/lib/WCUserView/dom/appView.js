import { MainApplicationView } from '../components/mainApplicationView.js';
import { RegisterForm } from '../components/registerForm.js';
import { AppModel } from './appModel.js'


class AppView extends HTMLElement
{
    constructor(model)
    {
        super();

        this.innerModel = model;

        this.id = 'view';

        this.MainApplicationView = new MainApplicationView();

        //this.registerForm = new RegisterForm();

    }

    connectedCallback()
    {
        this.appendChild(this.MainApplicationView);
        // this.appendChild(this.registerForm); 
    }
}

customElements.define('x-app', AppView)

export { AppView }