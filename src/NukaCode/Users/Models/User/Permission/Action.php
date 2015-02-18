<?php namespace NukaCode\Users\Models\User\Permission;

use NukaCode\Users\Models\Relationships\User\Permission\Action as ActionRelationshipsTrait;

class Action extends \BaseModel {
    /********************************************************************
     * Traits
     *******************************************************************/
    use ActionRelationshipsTrait;

    /********************************************************************
     * Declarations
     *******************************************************************/
    protected $table     = 'actions';

    protected $presenter = 'NukaCode\Users\Presenters\User\Permission\ActionPresenter';

    protected $fillable  = ['name', 'keyName', 'description'];

    /********************************************************************
     * Validation rules
     *******************************************************************/

    /********************************************************************
     * Scopes
     *******************************************************************/

    /********************************************************************
     * Model Events
     *******************************************************************/

    /********************************************************************
     * Getter and Setter methods
     *******************************************************************/

    /********************************************************************
     * Extra Methods
     *******************************************************************/
    public function setRoles($roleIds)
    {
        $this->roles()->detach();

        if (count($roleIds) > 0) {
            $this->roles()->attach($roleIds);
        }

        $this->save();
    }
}