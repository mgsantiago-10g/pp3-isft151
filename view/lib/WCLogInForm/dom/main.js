import { AppView } from "./appView.js";
import { AppModel } from "./appModel.js";

function main()
{
    let view = new AppView(new AppModel());

    document.body.appendChild(view);
}

window.addEventListener('load', main);
