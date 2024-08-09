<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Validation\ValidationException;

class StuffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        try {
            // ambil data yang mau ditampilkan 
            $data = Stuff::all()->toArray();

            return ApiFormatter::sendResponse(200, 'succes', $data);
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            // Validasi input
            $this->validate($request, [
                'name' => 'required',
                'category' => 'required',
            ]);
    
            // Buat data baru
            $data = Stuff::create([
                'name' => $request->name,
                'category' => $request->category,
            ]);
    
            // Berikan respons sukses
            return ApiFormatter::sendResponse(200, 'success', $data);
        }  catch (\Exception $err) {
            // Tangkap kesalahan lainnya dan berikan respons yang jelas
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Stuff::where('id', $id)->first();

            if (is_null($data)) {
                return ApiFormatter::sendResponse(400, 'bad request', 'Data not found!');
            } else {
                return ApiFormatter::sendResponse(200, 'succes', $data);
            }
        } catch(\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'category' => 'required'
            ]);

            $checkProsess = Stuff::where('id', $id)->update([
                'name' => $request->name,
                'category' => $request->category
            ]);

            if ($checkProsess) {
                $data = Stuff::find($id);
                return ApiFormatter::sendResponse(200, 'succes', $data);
            } else {
                return ApiFormatter::sendResponse(400, 'bad request', 'Gagal mengubah data!');
            }
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $checkProsess = Stuff::where('id', $id)->delete();

            return ApiFormatter::sendResponse(200, 'succes', 'Data stuff berhasil dihapus!');
        } catch(\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }


    public function trash() {
        try {
            // onlyTrashed : mencari data yang deletes_at nya BUKAN null
            $data = Stuff::onlyTrashed()->get();

            return ApiFormatter::sendResponse(200, 'succes', $data);
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }


    public function restore($id) {
        try {
            $checkProsess = Stuff::onlyTrashed()->where('id', $id)->restore();

            if ($checkProsess) {
                $data = Stuff::find($id);
                return ApiFormatter::sendResponse(200, 'succes', $data);
            } else {
                return ApiFormatter::sendResponse(400, 'bad request', 'Gagal mengembalikan data!');
            }
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

    public function permanent($id) {
        try {
            $checkProsess = Stuff::onlyTrashed()->where('id', $id)->forceDelete();

            return ApiFormatter::sendResponse(200, 'succes', 'Berhasil menghapus permanen data Stuff!');
        } catch(\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }
}
