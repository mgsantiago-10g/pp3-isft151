import { InicialPage } from '../components/inicialPage.js';
import { RegisterForm } from './WCRegisterSession/components/registerForm.js';
import { AppModel } from './appModel.js'
import { AppController } from './appController.js'
import { GenericButton } from '../items/genericButton.js'


class AppView extends HTMLElement
{
    constructor(model)
    {
		super()
		
        this.appController = new AppController(null,this);
		
		this.inicialPage = new InicialPage();
		
		this.inicialPage.signInButton.addEventListener('click', (event) => this.appController.onClickSignInButton(event) );
		        
        this.inicialPage.logInButton.addEventListener('click', (event) => this.appController.onClickLogInButton(event) );

    }
	
	setSignInView(){

        this.removeChild(this.inicialPage);
		this.signInView = new RegisterForm();
		document.body.appendChild(this.signInView);

    }

    setLogInView(){
		this.removeChild(this.inicialPage);
		//this.LogInView = new RegisterForm();
		//document.body.appendChild(signInView);
        

    }

    connectedCallback()
    {
			
        this.appendChild(this.inicialPage);
        // this.appendChild(this.registerForm); 
    }
}

customElements.define('x-app', AppView)

export { AppView }