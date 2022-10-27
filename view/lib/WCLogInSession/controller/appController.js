class AppController
{
    constructor( model, view )
    {
        this.innerModel = model;
        this.innerView = view;
        
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

    }

export { AppController }