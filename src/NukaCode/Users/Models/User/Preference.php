<?php namespace NukaCode\Users\Models\User;

use NukaCode\Users\Models\Relationships\User\Preference as PreferenceRelationshipsTrait;

class Preference extends \BaseModel {
	/********************************************************************
	 * Traits
	 *******************************************************************/
	use PreferenceRelationshipsTrait;

	/********************************************************************
	 * Declarations
	 *******************************************************************/
	protected $presenter = 'NukaCode\Users\Presenters\User\PreferencePresenter';

	protected $table     = 'preferences';

	protected $fillable  = ['name', 'keyName', 'description', 'value', 'default', 'display', 'hiddenFlag'];

	/********************************************************************
	 * Validation rules
	 *******************************************************************/

	protected $rules = [
		'name'    => 'required',
		'value'   => 'required',
		'default' => 'required',
		'display' => 'required',
	];

	/********************************************************************
	 * Scopes
	 *******************************************************************/

	/********************************************************************
	 * Model events
	 *******************************************************************/

	/********************************************************************
	 * Getter and Setter methods
	 *******************************************************************/

	/********************************************************************
	 * Extra Methods
	 *******************************************************************/

	public function getPreferenceOptionsArray()
	{
		$preferenceOptions = explode('|', $this->value);
		$preferenceArray   = [];

		foreach ($preferenceOptions as $preferenceOption) {
			$preferenceArray[$preferenceOption] = ucwords($preferenceOption);
		}

		return $preferenceArray;
	}
}