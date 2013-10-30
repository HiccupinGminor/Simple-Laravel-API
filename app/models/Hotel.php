<?php

/**
 * In this case, the model looks unnaturally thin
 * Given the mantra "Skinny Controllers, Fat Models" this may be a bit 
 * worrying. However, most of the data logic of this application is 
 * already available to this model as an extension of the Eloquent class.
 *
 * In addition, both data validation and custom methods have been abstracted away.
 */
class Hotel extends Eloquent {
	protected $guarded = array();
}
