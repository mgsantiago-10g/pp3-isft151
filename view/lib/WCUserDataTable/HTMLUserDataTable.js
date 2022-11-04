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
    
        this.nameInput = document.createElement('input');
        this.nameInput.placeholder = 'Name';

        this.lastnameInput = document.createElement('input');
        this.lastnameInput.placeholder = 'Last Name';

        this.genderInput = document.createElement('input');
        this.genderInput.placeholder = 'Gender';

        this.emailInput = document.createElement('input');
        this.emailInput.placeholder = 'Email';

        this.addUserButton = document.createElement('button');
        this.addUserButton.innerText = 'Add User to Table';
        this.addUserButton.addEventListener('click', () => {
            this.modalCreate.modal.style.display = 'none';
        })

        this.ABMDataTable.createButton.addEventListener('click', () =>{
            this.modalCreate.modal.style.display = 'block';
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
        this.modalCreate.modalContent.appendChild(this.nameInput);
        this.modalCreate.modalContent.appendChild(this.lastnameInput);
        this.modalCreate.modalContent.appendChild(this.genderInput);
        this.modalCreate.modalContent.appendChild(this.emailInput);
        this.modalCreate.modalContent.appendChild(this.addUserButton);
    }
}


customElements.define('x-user-table', HTMLUserDataTable);

export {HTMLUserDataTable}