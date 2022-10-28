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

import {HTMLDataTableColumn} from './HTMLDataTableColumn.js';
import {HTMLDataTableHeader} from './HTMLDataTableHeader.js';
import {HTMLDataTableBody} from './HTMLDataTableBody.js';

class HTMLDataTableElement extends HTMLTableElement
{
	constructor()
	{
		super();	

		this.createTBody();
		this.createTHead();
		this.createCaption();
	}

	connectedCallback()
	{
		this.tHead.addEventListener('click', event =>
		{
			const column = event.target.closest('th');

			if( column instanceof HTMLDataTableColumn && column.sortable )
			{
				if ( column.ascending == null )
					column.ascending = true;
				else
					column.ascending = !column.ascending;

				for( let current of this.tHead.rows[0].cells )
				{
					if ( current != column )
					{
						current.ascending = null;
					}
				}

				console.log(column.name+'->'+column.ascending);
				this.dispatchEvent( new CustomEvent('sort', { detail: {order:column.name, ascending:column.ascending} }));
			}
		});


	}

	createTBody()
	{
		let tbody = new HTMLDataTableBody();
		this.appendChild( tbody );
		return tbody;
	}

	createTHead()
	{
		if( this.tHead == null )
		{
			let thead = new HTMLDataTableHeader();			
			this.appendChild(thead);
			return thead;
		}
		else
		{
			return this.tHead;
		}		
	}

	insertRow( args, index )
	{
		this.tBodies[0].insertRow(args,index);
	}


	deleteRow(index)
	{
		this.tBodies[0].deleteRow(index);
	}

	get rows()
	{
		return this.tBodies[0].rows;
	}
	
	get columns()
	{
		return this.tHead.rows[0].cells;
	}
}

customElements.define('x-datatable', HTMLDataTableElement, { extends:'table'} );

//export module
export { HTMLDataTableElement };