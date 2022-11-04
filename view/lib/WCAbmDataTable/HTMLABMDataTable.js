import { HTMLDataTable } from "../WCDataTable/controller/HTMLDataTable.js";

class HTMLABMDataTableView extends HTMLElement
{
    constructor()
    {
        super();
        this.datatable = new HTMLDataTable();
        
        //Agregar la parte que agrega los botones a la instancia this.datatable
        this.abm_buttons = document.createElement('div');


        this.createButton = document.createElement('button');
        this.createButton.classList.add('data-table-button');
        this.createButton.innerText = 'Create';

        this.editButton = document.createElement('button');
        this.editButton.classList.add('data-table-button');
        this.editButton.innerText = 'Edit';

        this.deleteButton = document.createElement('button');
        this.deleteButton.classList.add('data-table-button');
        this.deleteButton.innerText = 'Delete';

        //Append de los botones al abm_buttons

        //Luego.. append del abm_buttons a la barra superior del datatable.
        //datatable.div
    }
    
    connectedCallback()
    {
        this.abm_buttons.appendChild(this.createButton);
        this.abm_buttons.appendChild(this.editButton);
        this.abm_buttons.appendChild(this.deleteButton);
        this.datatable.view.children[0].children[0].children[0].children[0].appendChild(this.abm_buttons);
        this.appendChild(this.datatable);
    }

}

customElements.define('x-abm-datatable', HTMLABMDataTableView);

export { HTMLABMDataTableView };