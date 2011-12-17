<<<<<<< HEAD
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class DefinitionHeaderEvent
		extends Event
	{
		private var _definitionCount:uint;
		
		public function DefinitionHeaderEvent()
		{
			super(Dict.DEFINITION_HEADER);
		}
		
		public function set definitionCount(definitionCount:uint):void
		{
			this._definitionCount = definitionCount;
		}
		
		public function get definitionCount():uint
		{
			return this._definitionCount;
		}
	}
=======
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class DefinitionHeaderEvent
		extends Event
	{
		private var _definitionCount:uint;
		
		public function DefinitionHeaderEvent()
		{
			super(Dict.DEFINITION_HEADER);
		}
		
		public function set definitionCount(definitionCount:uint):void
		{
			this._definitionCount = definitionCount;
		}
		
		public function get definitionCount():uint
		{
			return this._definitionCount;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}