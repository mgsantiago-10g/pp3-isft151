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

class HTMLDataTableServerModel extends EventTarget
{
	constructor()
	{
		super();
	}

	//server side
	submit( args )
	{
		//This is the place to use the args to build the request. 
		//You can serialize in any way that you want, make a formdata or similar.
		//Also you can use a xhr ajax request. The required thing is to return a promise.
		//If you don't need to make a http request, you need to return a resolved promise instead.

		return fetch('./backend/test.php', { method:'post', body: JSON.stringify(args) } ).then( response=> response.json() );
	}

	
}


//export module
export { HTMLDataTableServerModel };