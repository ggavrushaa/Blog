<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
   public function __invoke()
   {
    $query = Character::query();
    $character = $query
   ->inRandomOrder()
   ->first();
 
    return view('home.character', compact('character'));
   }
}
