import { HTMLABMDataTableView } from "../WCAbmDataTable/HTMLABMDataTable.js";
import { HTMLTextCell } from "../WCDataTable/view/HTMLTextCell.js";
import { Modal } from "./modal/modal.js";

class HTMLGroupDataTable extends HTMLElement
{
    constructor()
    {
        super();

        this.ABMDataTable = new HTMLABMDataTableView();
        this.modalCreate = new Modal();
        this.modalEdit = new Modal();
        this.modalDelete = new Modal();
    
        // MODAL CREATE CONTENT

        this.idInputCreate = document.createElement('input');
        this.idInputCreate.placeholder = 'ID';

        this.nameInputCreate = document.createElement('input');
        this.nameInputCreate.placeholder = 'Name';

        this.descriptionInputCreate = document.createElement('input');
        this.descriptionInputCreate.placeholder = 'Description';

        this.addGroupButton = document.createElement('button');
        this.addGroupButton.innerText = 'Add Group to Table';
        this.addGroupButton.classList.add('modal-button');
        this.addGroupButton.addEventListener('click', () => {
            this.modalCreate.modal.style.display = 'none';
        })

        // MODAL EDIT CONTENT

        this.idInputEdit = document.createElement('input');
        this.idInputEdit.placeholder = 'ID';

        this.nameInputEdit = document.createElement('input');
        this.nameInputEdit.placeholder = 'Name';

        this.descriptionInputEdit = document.createElement('input');
        this.descriptionInputEdit.placeholder = 'Description';

        this.editGroupButton = document.createElement('button');
        this.editGroupButton.innerText = 'Update Group';
        this.editGroupButton.classList.add('modal-button');
        this.editGroupButton.addEventListener('click', () => {
            this.modalEdit.modal.style.display = 'none';
        })

        // MODAL DELETE CONTENT

        this.idInputDelete = document.createElement('input');
        this.idInputDelete.placeholder = 'ID';

        this.nameInputDelete = document.createElement('input');
        this.nameInputDelete.placeholder = 'Name';

        this.descriptionInputDelete = document.createElement('input');
        this.descriptionInputDelete.placeholder = 'Description';

        this.deleteGroupButton = document.createElement('button');
        this.deleteGroupButton.innerText = 'Delete Group';
        this.deleteGroupButton.classList.add('modal-button');
        this.deleteGroupButton.addEventListener('click', () => {
            this.modalDelete.modal.style.display = 'none';
        })

        // TABLE BUTTONS

        this.ABMDataTable.createButton.addEventListener('click', () =>{
            this.modalCreate.modal.style.display = 'block';
        })

        this.ABMDataTable.editButton.addEventListener('click', () => {
            this.modalEdit.modal.style.display = ' block';
        })

        this.ABMDataTable.deleteButton.addEventListener('click', () => {
            this.modalDelete.modal.style.display = 'block';
        })


        // Columns
        this.table = this.ABMDataTable.datatable;
        this.table.appendColumn({name:'ID', sortable:true, type:HTMLTextCell,	title:"ID", reader: x=>x.id});
        this.table.appendColumn({name:'name', sortable:true, type:HTMLTextCell, title:"Name", reader: x=>x.name});
        this.table.appendColumn({name:'description', sortable:true, type:HTMLTextCell, title:"Description", reader: x=>x.description});
    }

    connectedCallback()
    {
        this.appendChild(this.ABMDataTable);
        this.appendChild(this.modalCreate);
        this.modalCreate.modalContent.appendChild(this.idInputCreate);
        this.modalCreate.modalContent.appendChild(this.nameInputCreate);
        this.modalCreate.modalContent.appendChild(this.descriptionInputCreate);
        this.modalCreate.modalContent.appendChild(this.addGroupButton);

        this.appendChild(this.modalEdit);
        this.modalEdit.modalContent.appendChild(this.idInputEdit);
        this.modalEdit.modalContent.appendChild(this.nameInputEdit);
        this.modalEdit.modalContent.appendChild(this.descriptionInputEdit);
        this.modalEdit.modalContent.appendChild(this.editGroupButton);

        this.appendChild(this.modalDelete);
        this.modalDelete.modalContent.appendChild(this.idInputDelete);
        this.modalDelete.modalContent.appendChild(this.nameInputDelete);
        this.modalDelete.modalContent.appendChild(this.descriptionInputDelete);
        this.modalDelete.modalContent.appendChild(this.deleteGroupButton);
    }
}


customElements.define('x-group-table', HTMLGroupDataTable);

export {HTMLGroupDataTable}