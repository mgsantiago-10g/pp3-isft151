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

import {HTMLDataTableHeader} from './HTMLDataTableHeader.js';

class HTMLDataTableBody extends HTMLTableSectionElement
{
	constructor()
	{
		super();
	}

	insertRow( args, index )
	{
		const row = super.insertRow(index);

		if ( this.parentElement.tHead instanceof HTMLDataTableHeader )
		{
			for( let column of this.parentElement.tHead.rows[0].cells )
			{				
				let cellFormat = new column.type();

				cellFormat.value = column.reader(args);
				let cell = row.insertCell(index);
				cell.replaceWith(cellFormat);
			}
		}

		return row;
	}

	deleteRow(index)
	{
		super.deleteRow(index);
	}

	showEmptyRow()
	{
		this.clear();

		const row = super.insertRow();
		
		const td = row.insertCell();

		td.setAttribute('colspan', this.parentElement.tHead.rows[0].cells.length);
		td.style.textAlign = 'center';
		td.innerText = 'No data available';

		return row;
	}

	clear()
	{
		while( this.childElementCount != 0 )
		{
			this.deleteRow(0);
		}			
	}

	

}

customElements.define('x-tbody', HTMLDataTableBody, { extends: 'tbody'} );

//export module
export { HTMLDataTableBody };