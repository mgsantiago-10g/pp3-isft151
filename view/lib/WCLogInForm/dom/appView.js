import { GenericButton } from '../items/genericButton.js';
import { RegisterForm } from '../components/registerForm.js';
import { AppModel } from './appModel.js'


class AppView extends HTMLElement
{
    constructor(model)
    {
        super();

        this.id = 'view';

        this.registerForm = new RegisterForm();


    }

    connectedCallback()
    {
        this.appendChild(this.registerForm) 
    }
}

customElements.define('x-app', AppView)

export { AppView }