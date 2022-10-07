import { GenericButton } from '../items/genericButton.js';
import { AppModel } from './appModel.js'


class AppView extends HTMLElement
{
    constructor(model)
    {
        super();

        this.id = 'view';

        this.loginH1 = document.createElement('h1');
        this.loginH1.innerText = 'Login'


        this.usernameInput = document.createElement('input');
        this.usernameInput.id = 'usernameInput'
        this.usernameInput.type = 'text';
        this.usernameInput.placeholder = 'Nombre de usuario'
        this.usernameInput.value = ''
        this.usernameInput.style.margin = '3px'

        this.passwordInput = document.createElement('input');
        this.passwordInput.id = 'passwordInput'
        this.passwordInput.type = 'password'
        this.passwordInput.placeholder = 'Contraseña'
        this.passwordInput.value = '';
        this.passwordInput.style.margin = '3px'


        this.genericButton = new GenericButton('Submit');

        this.submitButton = document.createElement('button');
        this.submitButton.id = 'validateUserButton'
        this.submitButton.innerText = 'Login'
        this.submitButton.style.margin = '3px'


    }

    connectedCallback()
    {
        this.appendChild(this.loginH1);
        this.appendChild(this.usernameInput);
        this.appendChild(this.passwordInput);
        this.appendChild(this.genericButton)
    }
}

customElements.define('x-app', AppView)

export { AppView }