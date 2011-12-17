<<<<<<< HEAD
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;
	import com.adobe.protocols.dict.Definition;

	public class DefinitionEvent
		extends Event
	{
		private var _definition:Definition;
		
		public function DefinitionEvent()
		{
			super(Dict.DEFINITION);
		}
		
		public function set definition(definition:Definition):void
		{
			this._definition = definition;
		}
		
		public function get definition():Definition
		{
			return this._definition;
		}
	}
=======
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;
	import com.adobe.protocols.dict.Definition;

	public class DefinitionEvent
		extends Event
	{
		private var _definition:Definition;
		
		public function DefinitionEvent()
		{
			super(Dict.DEFINITION);
		}
		
		public function set definition(definition:Definition):void
		{
			this._definition = definition;
		}
		
		public function get definition():Definition
		{
			return this._definition;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}