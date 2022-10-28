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

class HTMLEmailCell extends HTMLTableCellElement
{
	constructor()
	{
		super();

		this._email = document.createElement('a');
		this.classList.add('td-email');

		this.appendChild(this._email);
	}

	set value( value )
	{
		this._email.href = 'mailto:'+value.toString();
		this._email.innerText = value.toString();
	}

	get value()
	{
		return this._email.innerText;
	}

}


//registration requeriment
customElements.define('x-datatable-email-cell', HTMLEmailCell, { extends:'td'});

//export module
export { HTMLEmailCell };