import { HTMLGroupView } from "./view/HTMLGroupView.js";

function main()
{
    let groupView = new HTMLGroupView();
    document.body.appendChild(groupView);
}

window.addEventListener('load', main);


