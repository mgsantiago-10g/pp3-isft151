import { HTMLUserDataTable } from "./HTMLUserDataTable.js";

function main()
{
    let dataTableView = new HTMLUserDataTable();

    document.body.appendChild(dataTableView);
}

window.addEventListener('load', main);