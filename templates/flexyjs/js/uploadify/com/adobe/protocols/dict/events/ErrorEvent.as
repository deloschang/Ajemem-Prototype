<<<<<<< HEAD
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;
	
	public class ErrorEvent
		extends Event
	{
		private var _code:uint;
		private var _message:String;
		
		public function ErrorEvent()
		{
			super(Dict.ERROR);
		}

		public function set code(code:uint):void
		{
			this._code = code;
		}

		public function set message(message:String):void
		{
			this._message = message;
		}

		public function get code():uint
		{
			return this._code;
		}

		public function get message():String
		{
			return this._message;
		}
	}
=======
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;
	
	public class ErrorEvent
		extends Event
	{
		private var _code:uint;
		private var _message:String;
		
		public function ErrorEvent()
		{
			super(Dict.ERROR);
		}

		public function set code(code:uint):void
		{
			this._code = code;
		}

		public function set message(message:String):void
		{
			this._message = message;
		}

		public function get code():uint
		{
			return this._code;
		}

		public function get message():String
		{
			return this._message;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}