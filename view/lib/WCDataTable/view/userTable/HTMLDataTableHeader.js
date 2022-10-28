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

import {HTMLDataTableHeaderRow} from './HTMLDataTableHeaderRow.js';

class HTMLDataTableHeader extends HTMLTableSectionElement 
{
	constructor()
	{
		super();
		this.insertRow();
	}

	insertRow( index )
	{
		let r = new HTMLDataTableHeaderRow();
		super.insertRow(index).replaceWith( r );

		return r;
	}

	deleteRow(index)
	{
		if ( this.rows.length == 1 )
		{
			console.log('Cannot delete the first row');
		}
		else
		{
			super.deleteRow(index);
		}
	}
}

customElements.define('x-thead', HTMLDataTableHeader, { extends: 'thead'} );

//export module
export { HTMLDataTableHeader };