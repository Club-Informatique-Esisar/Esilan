<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Esilan;

class EsilanController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $esilans = Esilan::orderBy('beginDate', 'desc')->get();
        return view('esilan.display',array('esilans' => $esilans));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $esilan = new Esilan;
        $esilan->name = $request->name;
        $esilan->desc = $request->desc;
        $esilan->img = $request->img;
        $esilan->begin = $request->begin;
        $esilan->end = $request->end;
        $esilan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $esilan = Esilan::find($id);
        if ($esilan == null){
            return redirect('/esilan');
        }
        return view('esilan.show',array('esilan' => $esilan));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $esilan = Esilan::find($id);
        $esilan->name = $request->name;
        $esilan->desc = $request->desc;
        $esilan->img = $request->img;
        $esilan->begin = $request->begin;
        $esilan->end = $request->end;
        $esilan->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
