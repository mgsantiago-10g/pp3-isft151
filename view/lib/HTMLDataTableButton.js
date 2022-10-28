class DataTableButton extends HTMLElement
{
    constructor(name, classname)
    {
        super();

        this.addButton = document.createElement('button');
        this.addButton.className = AddButton;
        this.addButton.innerText = 'Añadir';

        this.editButton = document.createElement('button');
        this.editButton.className = EditButton;
        this.editButton.innerText = 'Editar';

        this.deleteButoon = document.createElement('button');
        this.deleteButoon.className = DeleteButton;
        this.deleteButoon.innerText = 'Borrar';
        

    }

    connectedCallback()
    {
        this.appendChild(this.AddButton);
        
        this.appendChild(this.EditButton);
        
        this.appendChild(this.DeleteButton);
    }

}

window.addEventListener('load', () => {
    customElements.define('x-data-table-button', DataTableButton)
})

export { DataTableButton }