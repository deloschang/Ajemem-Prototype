<<<<<<< HEAD
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class MatchStrategiesEvent
		extends Event
	{
		private var _strategies:Array;
		
		public function MatchStrategiesEvent()
		{
			super(Dict.MATCH_STRATEGIES);
		}
		
		public function set strategies(strategies:Array):void
		{
			this._strategies = strategies;
		}
		
		public function get strategies():Array
		{
			return this._strategies;
		}
	}
=======
package com.adobe.protocols.dict.events
{
	import flash.events.Event;
	import com.adobe.protocols.dict.Dict;

	public class MatchStrategiesEvent
		extends Event
	{
		private var _strategies:Array;
		
		public function MatchStrategiesEvent()
		{
			super(Dict.MATCH_STRATEGIES);
		}
		
		public function set strategies(strategies:Array):void
		{
			this._strategies = strategies;
		}
		
		public function get strategies():Array
		{
			return this._strategies;
		}
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}