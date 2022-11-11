
/*

    Para añadir elementos y event listeners al modal,
    hacerlo desde HTMLUserDataTable/HTMLGroupDataTable.
    Vease "HTMLUSERDataTable.js" para un ejemplo.

*/


class Modal extends HTMLElement
{
    constructor()
    {
        super();

        this.modal = document.createElement('div');
        this.modal.classList.add('w3-modal');

        this.modalContent = document.createElement('div');
        this.modalContent.classList.add('w3-display-container');
        this.modalContent.classList.add('w3-modal-content');
        this.modalContent.style.textAlign = 'center';
        this.modalContent.style.padding = '30px';

        this.closeSpan = document.createElement('span');
        this.closeSpan.classList.add('w3-button', 'w3-display-topright');
        this.closeSpan.innerText = 'x';
        this.closeSpan.style.color = 'gray';
        this.closeSpan.addEventListener('click', () => {
            this.modal.style.display = 'none';
        })

    }

    connectedCallback()
    {
        this.appendChild(this.modal);
        this.modal.appendChild(this.modalContent);
        this.modalContent.appendChild(this.closeSpan);
    }

}

customElements.define('x-modal', Modal);

export {Modal}