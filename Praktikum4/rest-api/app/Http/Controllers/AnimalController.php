<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animal = ['Kucing', 'Ayam', 'Ikan'];

    public function index()
    {
        return $this->animal;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->animal[] = $request->animal;
        return $this->animal;  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (isset($this->animal[$id])) {
            $this->animal[$id] = $request->animal;
            return $this->animal;
        }
        
        return 'Hewan tidak ditemukan';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (isset($this->animal[$id])) {
            unset($this->animal[$id]);
            return array_values($this->animal);
        }
        
        return 'Hewan tidak ditemukan';
    }
}
