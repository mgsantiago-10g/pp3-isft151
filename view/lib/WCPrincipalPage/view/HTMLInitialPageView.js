import { GenericButton } from "../items/genericButton.js";

class InicialPage extends HTMLElement {

    constructor(){

        super()
		
        this.classList.add('main-page', 'background-image');

        this.header = document.createElement('header');
        this.header.classList.add('w3-container', 'w3-xxlarge', 'logo-image', 'w3-center');
    

        this.body = document.createElement('body');
        this.body.classList.add('w3-container');


        this.centerCard = document.createElement('div');
        this.centerCard.classList.add('w3-container', 'w3-dark-gray', 'w3-card-2', 'w3-quarter', );
        this.centerCard.classList.add('w3-round-large', 'w3-padding', 'w3-display-middle', 'w3-opacity');

        this.signInButton = new GenericButton('Crear Cuenta');
        this.signInButton.classList.add('w3-margin', 'w3-opacity-off');
        this.logInButton = new GenericButton('Iniciar Sesión');
        this.logInButton.classList.add('w3-margin');

        this.footer = document.createElement('footer');
        this.footer.classList.add('w3-container', 'w3-center');
        this.footer.innerText = 'Todos los Derechos Reservados - 2022©';
    }

    connectedCallback() {


        this.appendChild(this.header);

        this.appendChild(this.body);

        this.body.appendChild(this.centerCard);
        this.centerCard.appendChild(this.signInButton);
        this.centerCard.appendChild(this.logInButton);

        this.appendChild(this.footer);


	
    }
}

window.addEventListener('load', () => {
    customElements.define('x-inicial-page', InicialPage)
})

export {InicialPage}