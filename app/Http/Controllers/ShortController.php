<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Short;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        $code = Str::random(6);
        $l = url()->to('/').'/'.$code;
        Short::create([
            'link'=>$request->link,
            'code'=>$code,
            'ShortLink'=>$l,
            'num'=>0]);
        return response($l,200);
    }
    public function Shortlink($code)
    {
        $find = Short::where('code', $code)->first();
        $link = 'http://'.$find['link'];
        $num = $find->num+1;
        DB::table('link')
            ->where('id',$find->id)
            ->update(['num'=>$num]);
        return Redirect::to($link);
    }
    public function all()
    {
        $all = DB::table('link')
            ->select('link', 'ShortLink', 'num')
            ->get();
        return $all;
    }
}
