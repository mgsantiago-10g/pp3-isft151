//import { InicialPage } from "../inicialPage.js";


class AppController
{
    constructor(model, view)
    {
        this.innerModel = model;
        this.innerView = view;
        
    }

    onClickSignInButton () //crear cuenta
    {
        this.innerView.setSignInView();
    }

    

    onClickLogInButton()  //iniciar sesión
    {
		this.innerView.setLogInView();
    }

 
}
export { AppController }