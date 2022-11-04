import { HTMLABMDataTableView } from "../WCAbmDataTable/HTMLABMDataTable.js";

class HTMLUserDataTable extends HTMLElement
{
    constructor()
    {
        super();

        this.ABMDataTable = new HTMLABMDataTableView();
    }

    connectedCallback()
    {
        this.appendChild(this.ABMDataTable);
    }
}


customElements.define('x-user-table', HTMLUserDataTable);

export {HTMLUserDataTable}