
import { HTMLABMDataTableView } from "./HTMLABMDataTable.js"

function main()
{
    let HTMLDataTable = new HTMLABMDataTableView();

    document.body.appendChild(HTMLDataTable);
}

window.addEventListener('load', main);