
class GenericButton extends HTMLElement
{
    constructor(name)
    {
        super();

        this.genericButton = document.createElement('button');
        this.genericButton.className = 'genericButton';
        this.genericButton.innerText = name
        this.genericButton.classList.add('w3-button', 'w3-block', 'w3-round-large', 'w3-medium', 'w3-ripple');

    }

    connectedCallback()
    {
        this.appendChild(this.genericButton);
    }

}

window.addEventListener('load', () => {
    customElements.define('x-generic-button', GenericButton)
})

export { GenericButton }