import { AppView } from "./appView.js";
import { AppModel } from "./appModel.js";

function main()
{
    // Crea una view con un modelo para luego vincularlo al cuerpo de la pagina web.
    let view = new AppView(new AppModel());
    document.body.appendChild(view);
}

window.addEventListener('load', main);
