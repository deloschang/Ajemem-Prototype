<<<<<<< HEAD
﻿/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * FCKNamedCommand Class: represents an internal browser command.
 */

var FCKNamedCommand = function( commandName )
{
	this.Name = commandName ;
}

FCKNamedCommand.prototype.Execute = function()
{
	FCK.ExecuteNamedCommand( this.Name ) ;
}

FCKNamedCommand.prototype.GetState = function()
{
	return FCK.GetNamedCommandState( this.Name ) ;
}
=======
﻿/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * FCKNamedCommand Class: represents an internal browser command.
 */

var FCKNamedCommand = function( commandName )
{
	this.Name = commandName ;
}

FCKNamedCommand.prototype.Execute = function()
{
	FCK.ExecuteNamedCommand( this.Name ) ;
}

FCKNamedCommand.prototype.GetState = function()
{
	return FCK.GetNamedCommandState( this.Name ) ;
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
