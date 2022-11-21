<?php
namespace Modules\Street\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Street\Entities\Street;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    private $Street;
	public function __construct(Street $Street)
    {
        $this->Street = $Street;
    }


    public function index()
    {
        $data['street'] = $this->Street->getAllStreet();
		return view('street::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['towns'] = $this->Street->getAllTown();
        return view('street::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //save data
		$streetDatails =['name' => $request->input('name'), 'town_id' => $request->input('town_id'),'status'=>1];
        $street_id = $this->Street->saveStreet($streetDatails);
        if ($street_id) {
            session()->flash('success', trans('admin.street_add_success_msg'));
            return redirect()->route('street');
        }
        return redirect()->back()->withErrors([trans('admin.street_add_error_msg')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('street::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $street = $this->Street->findStreetByID($id);
        if (empty($street)) {
            return redirect()->route('street')
                ->withErrors([trans('admin.category_not_found')]);
        }
		$data['street']=$street;
		$data['towns'] = $this->Street->getAllTown();

		return view('street::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,$id)
    {
        $streetDatails =['name' => $request->input('name'), 'town_id' => $request->input('town_id')];
		$updateStreet = $this->Street->updateStreet($id, $streetDatails);
        if ($updateStreet) {
            return redirect()->route('street')
                ->with(['success' => trans('admin.category_updated_success_msg')]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->Street->deleteStreet($id);
        //redirect to list
        return redirect()->route('street')
            ->with(['success' => trans('admin.street_delete_success_msg')]);
    }

    public function getStreet(Request $req){
        $streetByTown = Street::getStreetByTownId($req['townId']);
        $options = "<option value=''>Filter By Street</option>";
        foreach ($streetByTown as $street) {
            $options .= "<option value='".$street->id."'>".$street->name."</option>";
        }
        return $options;
    }
}
?>
