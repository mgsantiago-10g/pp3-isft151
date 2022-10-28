/*

Vanilla JS WebComponent's Toolkit
Copyright (C) 2019  Matías Gastón Santiago

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

import {HTMLDataTableElement} from './HTMLDataTableElement.js';
import {HTMLDataTablePaginator} from './HTMLDataTablePaginator.js';
import {DataTableButton} from '../items/HTMLDataTableButton.js'


class HTMLDataTableView extends HTMLElement
{
	constructor()
	{
		super();

		let div = document.createElement('div');


		this.buttonsContainer = document.createElement('div');
		this.buttonsContainer.classList.add('buttons-container');

		this.addButton = new DataTableButton('Add', 'data-table-button');
		this.addButton.addEventListener('click', () => {
			console.log('Boton Add');
		})

		this.editButton = new DataTableButton('Edit', 'data-table-button');
		this.editButton.addEventListener('click', () => {
			console.log('Boton Edit');
		})

		this.deleteButton = new DataTableButton('Delete', 'data-table-button');
		this.deleteButton.addEventListener('click', () => {
			console.log('Boton Delete');
		})

		this.filter = document.createElement('input');
		this.filter.type = 'text';
		this.filter.placeholder = 'Filter...';
		

		this.table = new HTMLDataTableElement();		
		this.paginator = new HTMLDataTablePaginator();

		this.paginator.page = 0;

		let divr = document.createElement('div');
		divr.classList.add('flexright');

		divr.appendChild(this.buttonsContainer);

		this.buttonsContainer.appendChild(this.addButton);
		this.buttonsContainer.appendChild(this.editButton);
		this.buttonsContainer.appendChild(this.deleteButton);

		divr.appendChild(this.filter);
		this.table.caption.appendChild(divr);

		
		div.appendChild( this.table );
		div.appendChild( this.paginator );

		div.classList.add('divt');

		this.appendChild( div );
	}


}

customElements.define('x-datatable-view', HTMLDataTableView );
//export module
export { HTMLDataTableView };