
class GenericButton extends HTMLElement
{
    constructor(name)
    {
        super();

        this.genericButton = document.createElement('button');
        this.genericButton.className = 'genericButton';
        this.genericButton.innerText = name

        this.appendChild(this.genericButton);
    }
}

window.addEventListener('load', () => {
    customElements.define('x-generic-button', GenericButton)
})

export { GenericButton }