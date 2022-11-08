<?php

namespace App\API;

use App\Exceptions\DbException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\vendorModel;
use App\Models\Models\equipmentModel;
use Illuminate\Support\Facades\Validator;


class vendorApiController extends Controller
{   
    public function saveVendor(Request $req)
    {
        vendorModel::create($req->all());
        echo 'New vendor successfully saved';
    }
    public function saveEquipment(Request $req)
    {
        $input = $req->all();

        $validatorFirst = Validator::make(
            $input,
            [
                'vendorID' => 'required|integer|gt:0',
                'serial' => 'required|string|min:10|max:10',
            ]
        );
        if ($validatorFirst->fails()) {
            return response()->json($validatorFirst->errors(), 400);
        }
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
            echo 'No match in pattern';
        } else {
            $serial = $serialRaw;
            
            $entry=equipmentModel::where("serial",$serial)->first();
            
            if ( is_null($entry)) {
                equipmentModel::create($input);
                echo 'Serial number successfully saved';
            } else {
                echo 'Houston, we have a duplicate';
                    }
        }
    }        
    
    public function requestVendor()
    {
        return response()->json(vendorModel::get(), 200);
    }
    public function requestEquipment()
    {
        return response()->json(equipmentModel::get(), 200);
    }

}