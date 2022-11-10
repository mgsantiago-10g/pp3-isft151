import { HTMLABMDataTableView } from "../WCAbmDataTable/HTMLABMDataTable.js";
import { HTMLEmailCell } from "../WCDataTable/view/HTMLEmailCell.js";
import { HTMLTextCell } from "../WCDataTable/view/HTMLTextCell.js";
import { Modal } from "./modal/modal.js";

class HTMLUserDataTable extends HTMLElement
{
    constructor()
    {
        super();

        this.ABMDataTable = new HTMLABMDataTableView();
        this.modalCreate = new Modal();
        this.modalEdit = new Modal();
        this.modalDelete = new Modal();
    
        // MODAL CREATE CONTENT
        this.nameInputCreate = document.createElement('input');
        this.nameInputCreate.placeholder = 'Name';

        this.lastnameInputCreate = document.createElement('input');
        this.lastnameInputCreate.placeholder = 'Last Name';

        this.genderInputCreate = document.createElement('input');
        this.genderInputCreate.placeholder = 'Gender';

        this.emailInputCreate = document.createElement('input');
        this.emailInputCreate.placeholder = 'Email';

        this.addUserButton = document.createElement('button');
        this.addUserButton.innerText = 'Add User to Table';
        this.addUserButton.addEventListener('click', () => {
            this.modalCreate.modal.style.display = 'none';
        })

        // MODAL EDIT CONTENT

        this.nameInputEdit = document.createElement('input');
        this.nameInputEdit.placeholder = 'Name';

        this.lastnameInputEdit = document.createElement('input');
        this.lastnameInputEdit.placeholder = 'Last Name';

        this.genderInputEdit = document.createElement('input');
        this.genderInputEdit.placeholder = 'Gender';
        
        this.emailInputEdit = document.createElement('input');
        this.emailInputEdit.placeholder = 'Email';

        this.editUserButton = document.createElement('button');
        this.editUserButton.innerText = 'Update User';
        this.editUserButton.addEventListener('click', () => {
            this.modalEdit.modal.style.display = 'none';
        })

        // MODAL DELETE CONTENT

        this.nameInputDelete = document.createElement('input');
        this.nameInputDelete.placeholder = 'Name';

        this.lastnameInputDelete = document.createElement('input');
        this.lastnameInputDelete.placeholder = 'Last Name';

        this.emailInputDelete = document.createElement('input');
        this.emailInputDelete.placeholder = 'Email'

        this.deleteUserButton = document.createElement('button');
        this.deleteUserButton.innerText = 'Delete User';
        this.deleteUserButton.addEventListener('click', () => {
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
        this.appendChild(this.modalCreate);
        this.modalCreate.modalContent.appendChild(this.nameInputCreate);
        this.modalCreate.modalContent.appendChild(this.lastnameInputCreate);
        this.modalCreate.modalContent.appendChild(this.genderInputCreate);
        this.modalCreate.modalContent.appendChild(this.emailInputCreate);
        this.modalCreate.modalContent.appendChild(this.addUserButton);

        this.appendChild(this.modalEdit);
        this.modalEdit.modalContent.appendChild(this.nameInputEdit);
        this.modalEdit.modalContent.appendChild(this.lastnameInputEdit);
        this.modalEdit.modalContent.appendChild(this.genderInputEdit);
        this.modalEdit.modalContent.appendChild(this.emailInputEdit);
        this.modalEdit.modalContent.appendChild(this.editUserButton);

        this.appendChild(this.modalDelete);
        this.modalDelete.modalContent.appendChild(this.nameInputDelete);
        this.modalDelete.modalContent.appendChild(this.lastnameInputDelete);
        this.modalDelete.modalContent.appendChild(this.emailInputDelete);
        this.modalDelete.modalContent.appendChild(this.deleteUserButton);
    }
}


customElements.define('x-user-table', HTMLUserDataTable);

export {HTMLUserDataTable}