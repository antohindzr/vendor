<?php

namespace App\Http\Controllers;
use App\Models\Models\vendorModel;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class vendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $vendor = vendorModel::all();
        
        return view('indexV', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('createV');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $req): Application|RedirectResponse|Redirector
    {
        $data = $req->validate([
            'vendorType' => 'required|max:255',
            'maskSN' => 'required|min:10|max:10',
        ]);
        $vendor = vendorModel::create($data);
        return redirect('/vendor')->withSuccess('Entry has been saved');
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
        $vendor = vendorModel::findOrFail($id);
        return view('editV', compact('vendor'));
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
        $updateData = $req->validate([
            'vendorType' => 'required|max:255',
            'maskSN' => 'required|min:10|max:10',
        ]);
        vendorModel::whereId($id)->update($updateData);
        return redirect('/vendor')->withSuccess('Entry has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        $vendor = vendorModel::findOrFail($id);
        $vendor->delete();
        return redirect('/vendor')->withSuccess('Entry has been deleted');
    }
}
