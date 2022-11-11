class HTMLGroupView extends HTMLElement {

    constructor(){

        super()

        this.classList.add('main-page', 'background-image');                            //Style Clases

        this.header = document.createElement('header');
        this.header.classList.add('header');                                            //Style Clases

        this.mainLogo = document.createElement('div');
        this.mainLogo.classList.add('w3-col', 'm3');                                    //W3 Clases
        this.mainLogo.classList.add('main-logo');                                       //Style Clases

        this.welcomeText = document.createElement('div');
        this.welcomeText.classList.add('w3-col', 'm6', 'w3-center', 'w3-xlarge');       //W3 Clases
        this.welcomeText.innerText = 'Bienvenido @name';

        this.logOut = document.createElement('button');
        this.logOut.classList.add('w3-right', 'w3-btn', 'w3-round', 'w3-ripple');       //W3 Clases
        this.logOut.innerText = 'Log Out';

        this.container = document.createElement('div');
        this.container.classList.add('container');                                      //Style Clases

        this.navLeft = document.createElement('nav');
        this.navLeft.classList.add('nav-left');                                         //Style Clases

        this.userButton = document.createElement('button');
        this.userButton.classList.add('button-user');                                   //Style Clases

        this.groupButton = document.createElement('button');
        this.groupButton.classList.add('button-group');                                 // Style Clases


        this.body = document.createElement('body');
        this.body.classList.add('rest-height');                                         //Style Clases

        this.bodyContent = document.createElement('div');
        this.bodyContent.classList.add('body-content');                                 //Style Clases

        this.footer = document.createElement('footer');
        this.footer.classList.add('w3-container', 'w3-center', 'w3-text-white');        //W3 Clases
        this.footer.classList.add('footer');                                            //Style Clases
        this.footer.innerText = 'Todos los Derechos Reservados - 2022©';
    }

    connectedCallback() {


        this.appendChild(this.header);
        this.header.appendChild(this.mainLogo);
        this.header.appendChild(this.welcomeText);
        this.header.appendChild(this.logOut);

        this.appendChild(this.container);

        this.container.appendChild(this.navLeft);

        this.navLeft.appendChild(this.userButton);
        this.navLeft.appendChild(this.groupButton);

        this.container.appendChild(this.body);
        this.body.appendChild(this.bodyContent);

        this.appendChild(this.footer);

    }
}


customElements.define('x-group-view', HTMLGroupView);

export {HTMLGroupView}