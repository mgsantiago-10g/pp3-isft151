import { HTMLABMDataTableView } from "../WCAbmDataTable/HTMLABMDataTable.js";
import { HTMLEmailCell } from "../WCDataTable/view/HTMLEmailCell.js";
import { HTMLTextCell } from "../WCDataTable/view/HTMLTextCell.js";

class HTMLUserDataTable extends HTMLElement
{
    constructor()
    {
        super();

        this.ABMDataTable = new HTMLABMDataTableView();
        this.table = this.ABMDataTable.datatable;
        this.table.appendColumn({name:'name', sortable:true, type:HTMLTextCell,	title:"Name", reader: x=>x.name});
        this.table.appendColumn({name:'lastname', sortable:true, type:HTMLTextCell, title:"Last Name", reader: x=>x.lastname});
        this.table.appendColumn({name:'email', sortable:true, type:HTMLEmailCell, title:"Email", reader: x=>x.email.toString().toLowerCase()});
        this.table.appendColumn({name:'gender', sortable:true, type:HTMLTextCell, title:"Gender", reader: x=>x.gender});
        this.table.appendColumn({name:'phoneNumber', sortable:true, type:HTMLTextCell, title:"Phone Number", reader: x=>x.phoneNumber});
        this.table.appendColumn({name:'password', sortable:true, type:HTMLTextCell,	title:"Password", reader: x=>'???'});

    }

    connectedCallback()
    {
        this.appendChild(this.ABMDataTable);
    }
}


customElements.define('x-user-table', HTMLUserDataTable);

export {HTMLUserDataTable}