<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Stat extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function log(Request $request)
    {
        $url = str_replace(config('app.url'), "", $request->url());
        if($url == "") {
            $url = "/";
        }

        Stat::create([
            'url' => $url,
            'ip_address' => $request->ip()
        ]);
    }
}
