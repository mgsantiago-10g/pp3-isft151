import { RegisterForm } from '../components/registerForm.js';


class AppView extends HTMLElement
{
    constructor(model)
    {
        super();

        this.innerModel = model;

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