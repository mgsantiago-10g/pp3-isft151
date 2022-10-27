import { AppModel } from '../dom/appModel.js';
import { GenericButton } from '../items/genericButton.js'

class RegisterForm extends HTMLElement {

    constructor(){

        super();

        this.innerModel = new AppModel();

        this.classList.add('w3-container', 'register-form')

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

        this.genericButton = new GenericButton('Submit');
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
        
        this.appendChild(this.nameH1)
        this.appendChild(this.nameInput);
        
        this.appendChild(this.lastnameH1)
        this.appendChild(this.lastnameInput);

        this.appendChild(this.genderH1)
        this.appendChild(this.genderInput);
        
        this.appendChild(this.phonenumberH1)
        this.appendChild(this.phonenumberInput);
        
        this.appendChild(this.adressH1);
        this.appendChild(this.adressInput);
        
        this.appendChild(this.emailH1);
        this.appendChild(this.emailInput);
        
        this.appendChild(this.idnumberH1);
        this.appendChild(this.idnumberInput);
        
        this.appendChild(this.passwordH1)
        this.appendChild(this.passwordInput);
        
        this.appendChild(this.repeatpasswordH1);
        this.appendChild(this.repeatpasswordInput);
        
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