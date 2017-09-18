<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Annonces;
use Auth;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonces = Annonces::all()->toArray();
        return view('annonce.index', compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('annonce.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $this->validate(request(), [
          'title' => 'required',
          'descriptions' => 'required',
        ]);

        $annonce = array_merge($data, ['user_id' => $user = $user->id]);
        
        Annonces::create($annonce);

        return back()->with('success', 'Annonce has been added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_annonce
     * @return \Illuminate\Http\Response
     */
    public function show($id_annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_annonce
     * @return \Illuminate\Http\Response
     */
    public function edit($id_annonce)
    {
        $annonce = Annonces::find($id_annonce);
        //\Log::info(dd($annonce ));
        return view('annonce.edit',compact('annonce','id_annonce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_annonce)
    {
        $annonce = Annonces::find($id_annonce);
       // \Log::infos(Annonces::where('id_annonce', $id_annonce));
        $this->validate(request(), [
          'title' => 'required',
          'descriptions' => 'required'
        ]);
        $annonce->title = $request->get('title');
        $annonce->descriptions = $request->get('descriptions');

        $annonce->save();
        //dd($annonce);
        return redirect('annonce')->with('success','annonce has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_annonce)
    {
        $annonce = Annonces::find($id_annonce);
        $annonce->delete();
        return redirect('annonces')->with('success','Product has been  deleted');
    }
}
