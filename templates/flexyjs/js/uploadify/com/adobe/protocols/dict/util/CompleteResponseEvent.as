<<<<<<< HEAD
package com.adobe.protocols.dict.util
{
	import flash.events.Event;

	public class CompleteResponseEvent
		extends Event
	{
		private var _response:String;

		public function CompleteResponseEvent()
		{
			super(SocketHelper.COMPLETE_RESPONSE);
		}

		public function set response(response:String):void
		{
			this._response = response;
		}
		
		public function get response():String
		{
			return this._response;
		}
	}
=======
package com.adobe.protocols.dict.util
{
	import flash.events.Event;

	public class CompleteResponseEvent
		extends Event
	{
		private var _response:String;

		public function CompleteResponseEvent()
		{
			super(SocketHelper.COMPLETE_RESPONSE);
		}

		public function set response(response:String):void
		{
			this._response = response;
		}
		
		public function get response():String
		{
			return this._response;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}