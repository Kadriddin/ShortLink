<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Short;
use Illuminate\Support\Str;

class ShortController extends Controller
{
    public function index()
    {
        return view('link',
            ['links'=>Short::latest()->get()]);
    }
    public function store(Request $request)
    {
//        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $code = Str::random(6);
        $l = url()->to('/').'/'.$code;
        Short::create([
            'link'=>$request->link,
            'code'=>$code]);
        return response()->json(['code'=>$l]);
    }
    public function Shortlink($code)
    {
        $find = Short::where('code', $code)->first();
        return redirect($find->link);
    }
}
