<?php namespace NukaCode\Users\Models\User\Permission\Action;

use NukaCode\Users\Models\Relationships\User\Permission\Action\Role as RoleRelationshipsTrait;

class Role extends \BaseModel {
    /********************************************************************
     * Traits
     *******************************************************************/
    use RoleRelationshipsTrait;

    /********************************************************************
     * Declarations
     *******************************************************************/

    protected $table = 'action_roles';

    /********************************************************************
     *Validation rules
     *******************************************************************/

    protected $rules = array(
        'action_id' => 'required|exists:actions,id',
        'role_id'   => 'required|exists:roles,id',
    );

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
}