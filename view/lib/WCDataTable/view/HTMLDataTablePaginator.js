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

class HTMLDataTablePaginator extends HTMLElement
{
	constructor()
	{
		super();

		this.classList.add('paginator');

		this.first = document.createElement('button');
		this.previous = document.createElement('button');
		this.next = document.createElement('button');
		this.pagesize = document.createElement('select');

		this.first.innerText = 'FirstPage';	
		this.previous.innerText = 'PreviousPage';	
		this.next.innerText = 'NextPage';
		

		this.first.classList.add('pure-button');
		this.first.classList.add('pure-button-primary');
		this.previous.classList.add('pure-button');
		this.previous.classList.add('pure-button-primary');
		this.next.classList.add('pure-button');
		this.next.classList.add('pure-button-primary');



		this.setPageSizes( [ {value:5,text:'5'}, {value:10,text:'10'}, {value:20,text:'20'}, {value:50,text:'50'} ] );

		this.appendChild(this.first);
		this.appendChild(this.previous);
		this.appendChild(this.next);
		this.appendChild(this.pagesize);

		this._page = 0;

	}

	setPageSizes( optionArray )
	{
		for( let settingOption of optionArray )
		{
			let option = document.createElement('option');
			option.text = settingOption.text;
			option.value = settingOption.value;
			this.pagesize.add(option);
		}
	}

	set disabled( value )
	{
		if ( value == false )
		{
			this.first.disabled = false;
			this.previous.disabled = false;
			this.next.disabled = false;
			this.pagesize.disabled = false;
		}
		else
		{
			this.first.disabled = true;
			this.previous.disabled = true;
			this.next.disabled = true;
			this.pagesize.disabled = true;
		}
	}

	set page(number)
	{
		if( number < 1 )
		{
			this.first.disabled = false;
			this.previous.disabled = true;
			this.next.disabled = true;
			this._page = number;
		}
		else if( number == 1 )
		{
			this.first.disabled = true;
			this.previous.disabled = true;
			this.next.disabled = false;
			this._page = number;
		}
		else if( number > 1 )
		{
			this.first.disabled = false;
			this.previous.disabled = false;
			this.next.disabled = false;
			this._page = number;
		}

	}

	get page()
	{
		return this._page;
	}
}

customElements.define('x-datatable-paginator', HTMLDataTablePaginator );
export { HTMLDataTablePaginator };