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

import { HTMLDataTable } from './controller/HTMLDataTable.js';
import { HTMLTextCell } from './view/HTMLTextCell.js';
import { HTMLEmailCell } from './view/HTMLEmailCell.js';


let dt = new HTMLDataTable();

dt.appendColumn({name:'name', sortable:true, type:HTMLTextCell,	title:"Name", reader: x=>x.name});
dt.appendColumn({name:'email', sortable:true, type:HTMLEmailCell,	title:"Email", reader: x=>x.email.toString().toLowerCase()});
dt.appendColumn({name:'birthday', sortable:true, type:HTMLTextCell, title:"Birthday", reader: x=>x.birthday});
dt.appendColumn({name:'salary', sortable:true, type:HTMLTextCell, title:"Salary", reader: x=>x.salary});
dt.appendColumn({name:'discount', sortable:true, type:HTMLTextCell,	title:"Discount", reader: x=>'???'});


document.body.appendChild(dt);

