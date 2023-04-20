<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    public function index(){
		return view('supperAdmin.serviceProvider.index');
	}
}
