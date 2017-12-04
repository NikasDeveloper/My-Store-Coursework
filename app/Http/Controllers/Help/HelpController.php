<?php

namespace App\Http\Controllers\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function showHelpView()
    {
        return view("help");
    }
}
