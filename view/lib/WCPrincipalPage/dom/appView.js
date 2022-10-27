import { InicialPage } from '../components/inicialPage.js';
import { RegisterForm } from '../components/registerForm.js';
import { AppModel } from './appModel.js'


class AppView extends HTMLElement
{
    constructor(model)
    {
        super();

        this.innerModel = model;

        this.id = 'view';

        this.inicialPage = new InicialPage();

        //this.registerForm = new RegisterForm();

    }

    connectedCallback()
    {
        this.appendChild(this.inicialPage);
        // this.appendChild(this.registerForm); 
    }
}

customElements.define('x-app', AppView)

export { AppView }