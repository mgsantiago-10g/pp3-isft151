
class AppView extends HTMLElement 
{
    
	constructor(){

        super(); 
        this.container = document.createElement('div');
        this.container.classList.add("container","w3-container", "w3-modal-content", "w3-card-4", "w3-animate-zoom", "w3-center");
        
        this.logo = document.createElement('img');
        this.logo.classList.add("w3-center","logo");
        this.logo.src = './items/logo.png';
        
        
        this.loginForm = document.createElement('div');
        this.loginForm.classList.add("w3-container", "w3-section");
        

        this.usernameLabel = document.createElement('label');
        this.usernameLabel.innerText = 'Usuario';
        this.usernameLabel.classList.add("login","text");
        

        this.usernameInput = document.createElement('input');
        this.usernameInput.classList.add("w3-input", "w3-border", "w3-margin-bottom");
        this.usernameInput.placeholder = "ingresar usuario";
        this.usernameInput.setAttribute('required','true');

        this.passwordLabel = document.createElement('label');
        this.passwordLabel.innerText = 'Contraseña';
        this.passwordLabel.classList.add("login","text");
        

        this.passwordInput = document.createElement('input');
        this.passwordInput.type = 'password';
        this.passwordInput.classList.add("w3-input", "w3-border", "w3-margin-bottom");
        this.passwordInput.placeholder = "Ingresar contraseña";
        this.passwordInput.setAttribute('required','true');

        this.loginButton = document.createElement('button');
        this.loginButton.innerText = 'Iniciar Sesión';
        this.loginButton.classList.add("w3-button", "w3-block", "w3-blue", "w3-section", "w3-padding");


    }

    getFormValues()
    {
        let values = {
            username: this.usernameInput.value,
            password: this.passwordInput.value
        }
        return values;
    }
    getSessionToken()
    {
	    let authData =
	    {
		    token: window.sessionStorage.getItem('token')
	    };

	    return authData;
    }
    welcomeView( data )
    {
	    if ( data.status == 'OK')
	    {
		    alert('Bienvenido al sistema usuario: '+data.response );
		    window.sessionStorage.setItem('token', data.response );
	    }else
	    {
		    alert('ERROR: '+data.description);
	    }
    }
    onValidateUserButtonClick(data)
    {
	    
	   fetch('./backend/test.php', { method:'post', body: JSON.stringify(this.getFormValues()) } )
	    .then( response => response.json() )
	    .then( response => { this.welcomeView(response) } );
	
    }
        

    connectedCallback(){

        this.appendChild(this.logo);
        this.appendChild(this.container);

        this.container.appendChild(this.loginForm);
        this.loginForm.appendChild(this.usernameLabel);
        this.loginForm.appendChild(this.usernameInput);
        this.loginForm.appendChild(this.passwordLabel);
        this.loginForm.appendChild(this.passwordInput);

        this.loginForm.appendChild(this.loginButton);

       this.loginButton.addEventListener('click', ()=>this.onValidateUserButtonClick());

       
    }
    
}
customElements.define('x-app-view', AppView);

export {AppView};
