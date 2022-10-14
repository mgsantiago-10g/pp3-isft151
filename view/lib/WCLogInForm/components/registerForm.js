import { GenericButton } from '../items/genericButton.js'

class RegisterForm extends HTMLElement {

    constructor(){

        super();

        this.nameInput = document.createElement('input')
        this.nameInput.className = 'nameInput';
        this.nameInput.innerText = 'Nombre'

        this.lastnameInput = document.createElement('input')
        this.lastnameInput.className = 'lastnameInput';
        this.lastnameInput.innerText = 'Apellido';

        this.phonenumberInput = document.createElement('input')
        this.phonenumberInput.className = 'phonenumberInput';
        this.phonenumberInput.innerText = 'Numero de Telefono';

        this.adressInput = document.createElement('input')
        this.adressInput.className = 'adressInput';
        this.adressInput.innerText = 'Domicilio';

        this.emailInput = document.createElement('input')
        this.emailInput.className = 'emailInput';
        this.emailInput.innerText = 'Correo Electronico'

        this.idnumberInput = document.createElement('input')
        this.idnumberInput.className = 'idnumberInput';
        this.idnumberInput.innerText = 'Numero de Documento';

        this.passwordInput = document.createElement('input')
        this.passwordInput.className = 'passwordInput';
        this.passwordInput.innerText = 'Contraseña';

        this.repeatpasswordInput = document.createElement('input')
        this.repeatpasswordInput.className = 'repeatpasswordInput';
        this.repeatpasswordInput.innerText = 'Repetir Contraseña';

        this.genericButton = new GenericButton('Submit');
 
    }
    
    connectedCallback() {
        this.appendChild(this.nameInput);
        this.appendChild(this.lastnameInput);
        this.appendChild(this.phonenumberInput);
        this.appendChild(this.adressInput);
        this.appendChild(this.emailInput);
        this.appendChild(this.idnumberInput);
        this.appendChild(this.passwordInput);
        this.appendChild(this.repeatpasswordInput);
        this.appendChild(this.genericButton)
    }
    
}

window.addEventListener('load', () => {
    customElements.define('x-register-form', RegisterForm)
})

export {RegisterForm}