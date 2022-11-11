import { HTMLGroupDataTable } from "./HTMLGroupDataTable.js";

function main()
{
    let dataTableView = new HTMLGroupDataTable();

    document.body.appendChild(dataTableView);
}

window.addEventListener('load', main);