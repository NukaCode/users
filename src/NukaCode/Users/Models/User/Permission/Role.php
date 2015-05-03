<?php namespace NukaCode\Users\Models\User\Permission;

use NukaCode\Users\Models\Relationships\User\Permission\Role as RoleRelationshipsTrait;

class Role extends \BaseModel {
    /********************************************************************
     * Traits
     *******************************************************************/
    use RoleRelationshipsTrait;

    /********************************************************************
     * Declarations
     *******************************************************************/
    protected $table     = 'roles';

    protected $presenter = 'NukaCode\Users\Presenters\User\Permission\RolePresenter';

    protected $fillable  = ['group', 'name', 'keyName', 'priority'];

    /********************************************************************
     * Validation rules
     *******************************************************************/

    /********************************************************************
     * Scopes
     *******************************************************************/
    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('group', 'asc')->orderBy('priority', 'asc');
    }

    /********************************************************************
     * Model Events
     *******************************************************************/

    /********************************************************************
     * Getter and Setter methods
     *******************************************************************/
	public function getFullNameAttribute()
	{
		return $this->group .' '. $this->name;
	}

    /********************************************************************
     * Extra Methods
     *******************************************************************/
    public function setActions($actionIds)
    {
        $this->actions()->detach();

        if (count($actionIds) > 0) {
            $this->actions()->attach($actionIds);
        }

        $this->save();
    }
}