import { AppView } from "./lib/WCPrincipalPage/dom/appView";
import { AppModel } from "./lib/WCPrincipalPage/dom/appModel";

function main()
{
    // Crea una view con un modelo para luego vincularlo al cuerpo de la pagina web.
    let view = new AppView(new AppModel());
    document.body.appendChild(view);
}

window.addEventListener('load', main);
