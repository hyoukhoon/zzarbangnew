<?php

namespace App\Http\Controllers;
use App\Models\Ozzal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class MainController extends Controller
{
    public function index(){

        $fromdate = now()->subDays(10)->format('Y/m/d H:i:s'); // 예: 2025/05/21 00:00:00
        $nowdate   = now()->format('Y/m/d H:i:s');  
        $params =[
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['multi' => 'ozzal']],
                        ['range' => [
                            'site_reg_date' => [
                                'gte' => $fromdate,
                                'lte' => $nowdate,
                                'format' => 'yyyy/MM/dd HH:mm:ss'
                            ]
                        ]]
                    ]
                ]
            ],
            'sort' => [
                ['site_cnt' => ['order' => 'desc']]
            ],'from'=>0, 'size'=>5
        ];
        
        $response = Ozzal::rawSearch($params, $optionsParams = []);

        echo "<pre>";
        print_r($response);
        //exit;

        
        // $hot = Ozzal::where("multi","ozzal")
        //             ->where("site_reg_date", ">", $fromdate)
        //             ->whereDate("site_reg_date", "<", $nowdate)
        //             ->whereBetween('site_reg_date', [$fromdate, $nowdate])
        //             ->orderBy("site_cnt","desc")
        //             ->paginate(5);
        //dd($fromdate, $nowdate);
        //dd($hot->toArray());
        return view("index",['boards' => $response]);
    }

}
