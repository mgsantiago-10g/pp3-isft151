class DataTableButton extends HTMLElement
{
    constructor(name, classname)
    {
        super();

        this.button = document.createElement('button');
        this.button.className = classname;
        this.button.innerText = name;        

    }

    connectedCallback()
    {
        this.appendChild(this.button);
    }

}

    customElements.define('x-data-table-button', DataTableButton)


export { DataTableButton }