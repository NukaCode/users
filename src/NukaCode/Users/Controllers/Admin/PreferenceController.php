<?php namespace NukaCode\Users\Controllers\Admin;

use NukaCode\Core\Controllers\AdminController;
use NukaCode\Users\Http\Requests\Admin\Edit\Preference as EditPreference;
use NukaCode\Users\Models\User\Preference;

class PreferenceController extends AdminController {

    /**
     * @var Preference
     */
    private $preference;

    /**
     * @param Preference $preference
     *
     */
    public function __construct(Preference $preference)
    {
        parent::__construct();

        $this->preference = $preference;
    }

    public function index()
    {
        $preferences = $this->preference->paginate(10);

        $this->setViewData(compact('preferences'));
    }

    public function getEdit($id)
    {
        $preference = $this->preference->find($id);

        $this->setViewData(compact('preference'));
    }

    public function postEdit(EditPreference $request, $id)
    {
        // Update the user
        $preference = $this->preference->find($request->only('id'));
        $preference->update($request->all());

        // Send the response
        return \Redirect::route('admin.user.preference.index')->with('message', 'Preference updated.');
    }

    public function getCreate()
    {
    }

    public function postCreate(EditPreference $request)
    {
        // Create the Preference
        $this->preference->create($request->all());

        // Send the response
        return \Redirect::route('admin.user.preference.index')->with('message', 'Preference created.');
    }

    public function getDelete($id)
    {
        $preference = $this->preference->find($id);
        $preference->delete();

        return \Redirect::route('admin.user.preference.index')->with('message', 'Preference deleted.');
    }
}
