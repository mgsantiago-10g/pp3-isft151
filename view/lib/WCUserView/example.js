import { HTMLUserView } from "./view/HTMLUserView.js";

function main()
{
    // Crea una view con un modelo para luego vincularlo al cuerpo de la pagina web.
    let userView = new HTMLUserView();
    document.body.appendChild(userView);
}

window.addEventListener('load', main);
