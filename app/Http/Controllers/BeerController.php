<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerRequest;
use App\Models\Beer;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beers = Beer::paginate(20);
        $direction = 'desc';
        return view('beers.index', compact('beers','direction'));
    }

    public function orderby($column, $direction){
        $direction = $direction === 'desc' ? 'asc' : 'desc';

        $beers = Beer::orderBy($column,$direction)->paginate(20);

        return view('beers.index', compact('beers','direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = route('beers.store');
        $method = 'POST';
        $beer = null;
        $title = 'Nuova birra';
        return view('beers.create-edit',compact('route', 'method', 'beer','title'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeerRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Beer::generateSlug($form_data['name']);
        $new_beer = new Beer();
        $new_beer->fill($form_data);
        $new_beer->save();

        return redirect()->route('beers.show', $new_beer->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $beer = Beer::where('slug',$slug)->first();
        return view('beers.show',compact('beer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function edit(Beer $beer)
    {
        $route = route('beers.update', $beer);
        $method = 'PUT';
        $title = $beer->name;
        return view('beers.create-edit',compact('beer','route', 'method','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function update(BeerRequest $request, Beer $beer)
    {
        $form_data = $request->all();
        if($form_data['name'] != $beer->name){
            $form_data['slug'] = Beer::generateSlug($form_data['name']);
        }else{
            $form_data['slug'] = $beer->slug;
        }

        $beer->update($form_data);

        return redirect()->route('beers.show', $beer->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beer $beer)
    {
        $beer->delete();

        return redirect()->route('beers.index')->with('deleted', 'Eliminazione correta!');
    }
}
