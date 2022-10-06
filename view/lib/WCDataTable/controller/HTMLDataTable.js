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

import {HTMLDataTableServerModel} from '../model/HTMLDataTableServerModel.js';
import {HTMLDataTableView} from '../view/HTMLDataTableView.js';

class HTMLDataTable extends HTMLElement
{
	constructor()
	{
		super();

		this.view = new HTMLDataTableView();
		this.model = new HTMLDataTableServerModel();		
	}

	connectedCallback()
	{
		this.appendChild(this.view);
		
		this.view.table.addEventListener('sort', event => this.onsortrequest(event.detail));
		this.view.paginator.pagesize.addEventListener('change', event =>this.onpagesizechange(event));

		this.view.filter.addEventListener('keydown', event => this.onfilterrequest(event) );
		this.view.filter.addEventListener('input', event => this.onfilterdefaultrequest(event) );

		this.view.paginator.first.addEventListener('click', event =>this.onfirstpagerequest(event));
		this.view.paginator.previous.addEventListener('click', event =>this.onpreviouspagerequest(event));
		this.view.paginator.next.addEventListener('click', event =>this.onnextpagerequest(event));

		this.view.table.tBodies[0].showEmptyRow();
	}

	onfirstpagerequest(args)
	{
		const request = this.readForm;
		request.page=1;

		this.model.submit( request ).then( response =>
		{
			populate( this.view.table, response );

			this.view.paginator.page = request.page;

			if( response.length < request.pagesize )
			{
				this.view.paginator.next.disabled = true;
			}
		});
	}

	onpreviouspagerequest(args)
	{
		if( this.view.paginator.page > 1 )
		{
			const request = this.readForm;
			request.page--;

			this.model.submit( request ).then( response =>
			{
				populate( this.view.table, response );
				this.view.paginator.page = request.page;
			});
		}		
	}

	onnextpagerequest( args )
	{
		const request = this.readForm;
		request.page++;

		this.model.submit( request ).then( response =>
		{
			populate( this.view.table, response );

			this.view.paginator.page = request.page;

			if( response.length < request.pagesize )
			{
				this.view.paginator.next.disabled = true;
			}
		});
	}

	onfilterrequest( args )
	{
		if (event.key === 'Enter')
		{
			const request = this.readForm;
			request.page=1;

			this.model.submit( request ).then( response =>
			{
				populate( this.view.table, response );

				this.view.paginator.page = request.page;

				if( response.length < request.pagesize )
				{
					this.view.paginator.next.disabled = true;
				}
			});
	    }
		
	}

	onfilterdefaultrequest( args )
	{
		if( this.view.filter.value == '' )
		{
			const request = this.readForm;
			request.page=1;

			this.model.submit( request ).then( response =>
			{
				populate( this.view.table, response );

				this.view.paginator.page = request.page;

				if( response.length < request.pagesize )
				{
					this.view.paginator.next.disabled = true;
				}
			});
		}
	}

	onpagesizechange( args )
	{
		const request = this.readForm;
		request.page=1;

		this.model.submit( request ).then( response =>
		{
			populate( this.view.table, response );

			this.view.paginator.page = request.page;

			if( response.length < request.pagesize )
			{
				this.view.paginator.next.disabled = true;
			}
		});
	}

	onsortrequest( args )
	{
		const request = this.readForm;

		if ( request.page == 0 )
			request.page=1;

		this.model.submit( request ).then( response =>
		{
			populate( this.view.table, response );

			this.view.paginator.page = request.page;

			if( response.length < request.pagesize )
			{
				this.view.paginator.next.disabled = true;
			}
		});
	}

	
	get readForm()
	{
		let order = null;

		//search order column
		for( let current of this.view.table.tHead.rows[0].cells )
		{
			if ( current.isSorted() )
			{
				order = current;
				break;
			}
		}

		const form =
		{ 
			ascending: ( order != null )? order.ascending : null,
			filter: (this.view.filter.value == '')? null : this.view.filter.value,
			order: ( order != null )? order.name : null,
			page: this.view.paginator.page,
			pagesize:this.view.paginator.pagesize.value
		};

		return form;
	}

	appendColumn( columnData )
	{
		this.view.table.tHead.rows[0].insertCell( columnData );
	}
	
}

function populate( datatable, data )
{
	//fill body table
	if ( data instanceof Array && data.length > 0 )
	{
		datatable.tBodies[0].clear();
		for( let row of data )
		{
			datatable.insertRow( row );
		}
	}
	else
	{
		datatable.tBodies[0].showEmptyRow();
	}
}

customElements.define('x-dtable', HTMLDataTable);
//export module
export { HTMLDataTable };
