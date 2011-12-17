<<<<<<< HEAD
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class DatabaseEvent
		extends Event
	{
		private var _databases:Array;
		
		public function DatabaseEvent()
		{
			super(Dict.DATABASES);
		}
		
		public function set databases(databases:Array):void
		{
			this._databases = databases;
		}
		
		public function get databases():Array
		{
			return this._databases;
		}
	}
=======
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class DatabaseEvent
		extends Event
	{
		private var _databases:Array;
		
		public function DatabaseEvent()
		{
			super(Dict.DATABASES);
		}
		
		public function set databases(databases:Array):void
		{
			this._databases = databases;
		}
		
		public function get databases():Array
		{
			return this._databases;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}