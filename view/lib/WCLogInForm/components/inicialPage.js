import { GenericButton } from "../items/genericButton.js";

class InicialPage extends HTMLElement {

    constructor(){

        super()
        this.className = 'main-page';

        this.header = document.createElement('header');
        this.header.classList.add('w3-container', 'w3-blue', 'w3-xxlarge');
        this.header.innerText = 'Pataforma IPFL';

        this.body = document.createElement('body');
        this.body.classList.add('w3-container', 'w3-green');
        this.body.id = 'body'

        this.centerCard = document.createElement('div');
        this.centerCard.classList.add("w3-container", "w3-center", 'w3-dark-gray', 'w3-card-2', 'w3-round-large');
        this.centerCard.classList.add('w3-padding-24', 'w3-section', 'w3-quarter', 'w3-margin');
        this.centerCard.id = 'center-card'

        this.singInButton = new GenericButton('Create Account');
        this.singInButton.classList.add('w3-margin');
        this.logInButton = new GenericButton('Log In');
        this.logInButton.classList.add('w3-margin');

        this.footer = document.createElement('footer');
        this.footer.classList.add('w3-container', 'w3-red');
        this.footer.innerText = 'Footer';
    }

    connectedCallback() {
        this.appendChild(this.header);

        this.appendChild(this.body);

        this.body.appendChild(this.centerCard);
        this.centerCard.appendChild(this.singInButton);
        this.centerCard.appendChild(this.logInButton);

        this.appendChild(this.footer);

    }
}

window.addEventListener('load', () => {
    customElements.define('x-inicial-page', InicialPage)
})

export {InicialPage}