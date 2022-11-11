import { AppModel } from '../dom/appModel.js';
import { GenericButton } from '../items/genericButton.js'

class RegisterForm extends HTMLElement {

    constructor(){

        super();

        this.innerModel = new AppModel();

        this.classList.add('w3-container', 'register-form')

        this.registerTitle = this.__setH1__("ISFT151 Register Form");
        this.registerTitle.classList.add('register-title')

        this.formContainer = document.createElement('div');
        this.formContainer.classList.add('form-container')

        this.leftSideContainer = document.createElement('div');
        this.leftSideContainer.classList.add('left-side-container');

        this.rightSideContainer = document.createElement('div');
        this.rightSideContainer.classList.add('right-side-container');

        this.nameH1 = this.__setH1__("Nombre");
        
        this.nameInput = document.createElement('input')
        this.nameInput.className = 'nameInput';
        this.nameInput.innerText = 'Nombre'

        this.lastnameH1 = this.__setH1__("Apellido")
        this.lastnameInput = document.createElement('input')
        this.lastnameInput.className = 'lastnameInput';
        this.lastnameInput.innerText = 'Apellido';

        this.genderH1 = this.__setH1__("Genero")
        this.genderInput = document.createElement('input')
        this.genderInput.className = 'genderInput';
        this.genderInput.innerText = 'Genero';
        
        this.phonenumberH1 = this.__setH1__("Numero de Telefono")
        this.phonenumberInput = document.createElement('input')
        this.phonenumberInput.className = 'phonenumberInput';
        this.phonenumberInput.innerText = 'Numero de Telefono';

        this.adressH1 = this.__setH1__("Domicilio")
        this.adressInput = document.createElement('input')
        this.adressInput.className = 'adressInput';
        this.adressInput.innerText = 'Domicilio';

        this.emailH1 = this.__setH1__("Correo Electronico")
        this.emailInput = document.createElement('input')
        this.emailInput.className = 'emailInput';
        this.emailInput.innerText = 'Correo Electronico'

        this.idnumberH1 = this.__setH1__("Numero de Documento")
        this.idnumberInput = document.createElement('input')
        this.idnumberInput.className = 'idnumberInput';
        this.idnumberInput.innerText = 'Numero de Documento';

        this.passwordH1 = this.__setH1__("Contraseña")
        this.passwordInput = document.createElement('input')
        this.passwordInput.className = 'passwordInput';
        this.passwordInput.innerText = 'Contraseña';

        this.repeatpasswordH1 = this.__setH1__("Repetir Contraseña")
        this.repeatpasswordInput = document.createElement('input')
        this.repeatpasswordInput.className = 'repeatpasswordInput';
        this.repeatpasswordInput.innerText = 'Repetir Contraseña';

        this.genericButton = new GenericButton('Submit', 'submit-button');
        this.genericButton.addEventListener('click', ()=>{
            let formData = 
            {
                username: this.nameInput.value,
                lastname: this.lastnameInput.value,
                gender: this.genderInput.value,
                phoneNumber: this.phonenumberInput.value,
                adress: this.adressInput.value,
                email: this.emailInput.value,
                idNumber: this.idnumberInput.value,
                password: this.passwordInput.value,
                repeatPassword: this.repeatpasswordInput.value
            }

            this.innerModel.sendRegisterData( formData ).then(response => window.location.href='/main-page')
        });

 
    }
    
    connectedCallback() {
        
        this.appendChild(this.registerTitle)

        this.appendChild(this.formContainer)

        this.formContainer.appendChild(this.leftSideContainer);
        this.formContainer.appendChild(this.rightSideContainer);

        this.leftSideContainer.appendChild(this.nameH1);
        this.leftSideContainer.appendChild(this.nameInput);
        
        this.leftSideContainer.appendChild(this.lastnameH1)
        this.leftSideContainer.appendChild(this.lastnameInput);

        this.leftSideContainer.appendChild(this.genderH1)
        this.leftSideContainer.appendChild(this.genderInput);
        
        this.leftSideContainer.appendChild(this.phonenumberH1)
        this.leftSideContainer.appendChild(this.phonenumberInput);
        
        this.rightSideContainer.appendChild(this.adressH1);
        this.rightSideContainer.appendChild(this.adressInput);
        
        this.rightSideContainer.appendChild(this.emailH1);
        this.rightSideContainer.appendChild(this.emailInput);
        
        this.rightSideContainer.appendChild(this.idnumberH1);
        this.rightSideContainer.appendChild(this.idnumberInput);
        
        this.rightSideContainer.appendChild(this.passwordH1)
        this.rightSideContainer.appendChild(this.passwordInput);
        
        this.rightSideContainer.appendChild(this.repeatpasswordH1);
        this.rightSideContainer.appendChild(this.repeatpasswordInput);
        
        this.appendChild(this.genericButton)
    }

    
    // Private Functions

    __setH1__(name)
    {
        let h1 = document.createElement('h1');
        h1.innerText = name;
        return h1;
    }

}

window.addEventListener('load', () => {
    customElements.define('x-register-form', RegisterForm)
})

export {RegisterForm}