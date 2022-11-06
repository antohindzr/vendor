<?php

namespace App\Http\Controllers;
use App\Models\Models\equipmentModel;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class equipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $equipment = equipmentModel::all();
        return view('indexE', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('createE');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $req): Application|RedirectResponse|Redirector
    {
        $input = $req->validate([
            'vendorID' => 'required|integer|gt:0',
            'serial' => 'required|string|min:10|max:10',
        ]);
        $vendorID = $input['vendorID'];
        $serialRaw = $input['serial'];
        
        switch ($vendorID) {
            case 1:
                $maskPattern = '/(^[A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2}$)/';
                break;
            case 2:
                $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{1}[a-z]{2}$)/';
                break;
            case 3:
                $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{3}$)/';
                break;
        }
        
        preg_match($maskPattern, $serialRaw, $matches);

        if (empty($matches)) {
            return redirect('/equipment')->withFail('No match in pattern. Entry has not been saved');
        } else {
            $serial = $serialRaw;
            
            $entry=equipmentModel::where("serial",$serial)->first();
            
            if ( is_null($entry)) {
                equipmentModel::create($input);
                return redirect('/equipment')->withSuccess('Entry has been saved');
            } else {
                return redirect('/equipment')->withFail('Houston, we have a duplicate. Entry has not been saved');
                    }
        }    
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
  /*  public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): Application|Factory|View
    {
        $equipment = equipmentModel::findOrFail($id);
        return view('editE', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $req
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $req, int $id): Application|RedirectResponse|Redirector
    {
        $input = $req->validate([
            'vendorID' => 'required|integer|gt:0',
            'serial' => 'required|string|min:10|max:10',
        ]);
        $vendorID = $input['vendorID'];
        $serialRaw = $input['serial'];
        switch ($vendorID) {
            case 1:
                $maskPattern = '/(^[A-Z0-9]{2}[A-Z]{5}[A-Z0-9]{1}[A-Z]{2}$)/';
                break;
            case 2:
                $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{1}[a-z]{2}$)/';
                break;
            case 3:
                $maskPattern = '/(^[0-9]{1}[A-Z0-9]{2}[A-Z]{2}[A-Z0-9]{1}[(-|_|@)]{1}[A-Z0-9]{3}$)/';
                break;
        }
        
        preg_match($maskPattern, $serialRaw, $matches);

        if (empty($matches)) {

            return redirect('/equipment')->withFail('No match in pattern. Entry has not been updated');

        } else {
            $serial = $serialRaw;
            
            $entry=equipmentModel::where("serial",$serial)->first();
            
            if ( is_null($entry)) {
                equipmentModel::whereId($id)->update($input);
                
                return redirect('/equipment')->withSuccess('Entry has been updated');
            } else {
                
                return redirect('/equipment')->withFail('Houston, we have a duplicate. Entry has not been updated');
                
                    }
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        $equipment = equipmentModel::findOrFail($id);
        $equipment->delete();
        return redirect('/equipment')->withSuccess('Entry has been deleted');
    }
}
