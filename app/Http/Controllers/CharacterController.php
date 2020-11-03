<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Island;
use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

        return Inertia::render('Characters/Index', compact('characters'));
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

        return Inertia::render('Characters/Create', compact('character', 'islands'));
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

		/* Fetch available items */

        $items = Item::query()
            ->orderBy('name')
            ->get();

        /* Fetch already assigned items */

        $assignedItems = $character->items;

        /* Show view */

        return Inertia::render('Characters/Edit', compact('character', 'islands', 'items', 'assignedItems'));
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
		$assignedItems = collect($data['assigned_items'] ?? []);

        /* Update character */

		$character->name = $name;
		$character->island_id = $islandId;
		$character->save();

		/* Update items */

        $character->items()->detach();

        $assignedItems
            ->each(function($item) use ($character) {
                $character->items()->attach($item['id'], $item['pivot']);
            });

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
