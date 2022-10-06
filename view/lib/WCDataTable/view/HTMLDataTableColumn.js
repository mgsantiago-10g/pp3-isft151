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

class HTMLDataTableColumn extends HTMLTableCellElement
{
	constructor()
	{
		super();

		this.classList.add('unsortable');
		this.classList.add('undefined');
	}

	set title( value )
	{
		this.innerText = value.toString();
	}

	get title()
	{
		return this.innerText;
	}

	get sortable()
	{
		return this.classList.contains('sortable');
	}

	set sortable( value )
	{
		if ( value == true )
		{
			this.classList.replace('unsortable', 'sortable');
		}
		else
		{
			this.classList.replace('sortable', 'unsortable');
		}
	}

	set ascending( value )
	{
		if ( this.sortable ) switch ( value )
		{
			case true:
			{
				this.classList.remove('undefined','descending');
				this.classList.add('ascending');
				break;
			};

			case false:
			{
				this.classList.remove('ascending','undefined');
				this.classList.add('descending');
				break;
			};

			default:
			{
				this.classList.remove('ascending','descending');
				this.classList.add('undefined');
				break;
			};
		}
	}

	isSorted()
	{
		return ( this.ascending == true || this.ascending == false )? true : false;
	}

	get ascending()
	{
		return (this.classList.contains('ascending'))? true : this.classList.contains('descending')? false : null;
	}

}

customElements.define('x-datatable-column', HTMLDataTableColumn, { extends:'th'});

//export module
export { HTMLDataTableColumn };