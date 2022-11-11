import { HTMLMainApplicationView } from "./view/HTMLMainApplicationView.js";

// import { UserView } from "../../WCUserView/components/userView.js";

// import { AppModel } from "./appModel.js";

function main()
{
    // Crea una view con un modelo para luego vincularlo al cuerpo de la pagina web.
    let mainApplicationView = new HTMLMainApplicationView();
    // let userView = new UserView();

    //mainView.MainApplicationView.userButton.addEventListener('click', ()=>{ alert("hola")});
    // mainView.MainApplicationView.userButton.addEventListener('click', ()=>{ document.body.appendChild(userView)});

   /*     let a = document.createElement('button');
        a.innerText = 'Hola';

        mainView.bodyContent.appendChild(a);
     });*/

    document.body.appendChild(mainApplicationView);
}

window.addEventListener('load', main);
