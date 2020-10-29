<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Island;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetch characters */
		
		$characters = Character::query()
			->with('island')
			->orderBy('name')
			->get();
			
		/* Show view */
		
		return view('Pages/Characters/Index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/* Instantiate empty model */
		
        $character = new Character();
		
		/* Fetch available islands */
		
		$islands = Island::query()
			->orderBy('name')
			->get();
			
		/* Show view */
		
		return view('Pages/Characters/Create', compact('character', 'islands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/* Sanitize data */
		
        $data = $request->all();
		$name = $data['name'] ?? '';
		$islandId = $data['island_id'] ?? 0;
		
		/* Create Character */
		
		$character = Character::create([
			'name' => $name,
			'island_id' => $islandId,
		]);
		
		/* Redirect */
		
		return redirect(route('characters.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
		/* Fetch available islands */
		
		$islands = Island::query()
			->orderBy('name')
			->get();
			
		/* Show view */
		
		return view('Pages/Characters/Edit', compact('character', 'islands'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
		/* Sanitize data */
		
        $data = $request->all();
		$name = $data['name'] ?? $character->name;
		$islandId = $data['island_id'] ?? $character->island_id;
		
        /* Update character */
		
		$character->name = $name;
		$character->island_id = $islandId;
		$character->save();
		
		/* Redirect */
		
		return redirect(route('characters.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        //
    }
}
