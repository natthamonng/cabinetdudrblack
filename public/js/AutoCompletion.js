// WebComponent responsible for feching query results and display it in a list.
// Should be usable as an input in a form, or to react on DOM events.

class AutoCompletion extends HTMLElement {

    lastSearch;

    $root;
    $container;
    $innerInput;
    $list;

    constructor(){
        super();

        this.$root = this.attachShadow({ mode: 'open' });
        this.$root.innerHTML = `
            <style>
            ${AutoCompletion.STYLE}
            </style>
        `;
    }

    connectedCallback(){
        this.init();
    }

    init(){
        this.$container = document.createElement('div');
        this.$container.setAttribute('class', 'autocomplete');

        this.$innerInput = document.createElement('input');
        this.$innerInput.setAttribute('placeholder', 'Rechercher un patient...');

        this.$container.appendChild(this.$innerInput);
        this.$root.appendChild(this.$container);

        this.$innerInput.addEventListener('input', e => this.handleChange(e));

        this.$list = document.createElement('ul');
        this.$list.setAttribute('class', 'autocomplete-items');
        this.$root.appendChild(this.$list);
    }

    handleChange(e){
        const value = this.$innerInput.value;
        if(this.lastSearch != value){
            this.lastSearch = value;
            this.updateList(value);
        }
    }

    handleSelect(patient){

        const event = new CustomEvent("select", {
            detail: {
              patient
            }
          });
          this.dispatchEvent(event);
    }

    updateList(searchTerm){
        const uri = this.getSearchURI(searchTerm);
        fetch(uri)
            .then(res => res.json())
            .then(data => this.updateFromData(data));
    }

    updateFromData(data) {
        this.$list.innerHTML = '';
        data.forEach(patient => {
            const $li = document.createElement('li');
            $li.setAttribute('class', 'autocomplete-item');
            $li.textContent = patient.firstname + ' ' + patient.lastname;
            this.$list.appendChild($li);

            $li.addEventListener('click', () => this.handleSelect(patient));
        })
    }

    getSearchURI(searchTerm){
        const baseURI = this.getBaseURI();
        const field = this.getQueryField();

        const delimiter = baseURI.indexOf('?') > -1 ? "&" : "?";

        return `${baseURI}${delimiter}${field}=${searchTerm}`;
    }

    getBaseURI(){
        return this.getSafeAttribute('url');
    }

    getQueryField(){
        return this.getSafeAttribute('field', 'q');
    }

    getSafeAttribute(shortName, defaultValue = ""){
        return this.hasAttribute('query-'+shortName) ? this.getAttribute('query-'+shortName) : defaultValue;
    }

    static STYLE = `
        .autocomplete {
            position: relative;
            display: inline-block;
            width: 15vw;
        }
        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 8px;
            font-size: 1em;
            border: 1px solid #d4d4d4;
            border-radius: 5px;
            width: 100%;
        }
        ul.autocomplete-items {
            position: absolute;
            list-style-type: none;
            color: #000;
            z-index: 100;
        }
        li.autocomplete-item {
            padding: 5px;
            cursor: pointer;
            background-color: #6c757d;
            border: 1px solid #d4d4d4;
            text-align: left;
            width: 250px;
        }

        @media screen and (max-width: 992px) {
            .autocomplete {
                width: 80vw;
            }
    `;

}

window.customElements.define('auto-complete', AutoCompletion);