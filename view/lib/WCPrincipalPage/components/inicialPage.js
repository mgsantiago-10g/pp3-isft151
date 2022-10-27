import { GenericButton } from "../items/genericButton.js";

class InicialPage extends HTMLElement {

    constructor(){

        super()
        // this.className = 'main-page';
        this.classList.add('main-page', 'background-image');

        // this.background = document.createElement('div');
        // this.background.classList.add('w3-image', 'w3-container');
        // this.background.classList.add('background-image')

        this.header = document.createElement('header');
        this.header.classList.add('w3-container', 'w3-xxlarge', 'logo-image', 'w3-center');
        // this.header.innerText = 'Pataforma IPFL';

        this.body = document.createElement('body');
        this.body.classList.add('w3-container');
        this.body.classList.add('rest-height');
        // this.body.id = 'body';

        this.centerCard = document.createElement('div');
        this.centerCard.classList.add('w3-container', 'w3-dark-gray', 'w3-card-2', 'w3-quarter', );
        this.centerCard.classList.add('w3-round-large', 'w3-padding', 'w3-display-middle', 'w3-opacity');
        // this.centerCard.id = 'center-card';

        this.singInButton = new GenericButton('Create Account');
        this.singInButton.classList.add('w3-margin', 'w3-opacity-off');
        this.logInButton = new GenericButton('Log In');
        this.logInButton.classList.add('w3-margin');

        this.footer = document.createElement('footer');
        this.footer.classList.add('w3-container', 'w3-center');
        this.footer.innerText = 'Todos los Derechos Reservados - 2022©';
    }

    connectedCallback() {

        // this.appendChild(this.background);

        // this.background.appendChild(this.header);

        // this.background.appendChild(this.body);

        // this.background.body.appendChild(this.centerCard);
        // this.background.centerCard.appendChild(this.singInButton);
        // this.background.centerCard.appendChild(this.logInButton);

        // this.background.appendChild(this.footer);

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