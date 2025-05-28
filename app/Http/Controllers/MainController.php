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

        $params =[
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['multi' => 'ozzal']],
                        ['range' => [
                            'site_reg_date' => [
                                'gte' => '2025/05/18 00:00:00',
                                'lte' => '2025/05/28 23:59:59',
                                'format' => 'yyyy/MM/dd HH:mm:ss'
                            ]
                        ]]
                    ]
                ]
            ]
        ];
        
        $response = Ozzal::rawSearch($params, $optionsParams = []);
        dd($response);


        $fromdate = now()->subDays(10)->format('Y/m/d'); // 예: 2025/05/21 00:00:00
        $nowdate   = now()->format('Y/m/d');  
        $hot = Ozzal::where("multi","ozzal")
                    //->where("site_reg_date", ">", $fromdate)
                    //->whereDate("site_reg_date", "<", $nowdate)
                    ->whereBetween('site_reg_date', [$fromdate, $nowdate])
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        //dd($fromdate, $nowdate);
        //dd($hot->toArray());
        return view("index",['boards' => $hot]);
    }

}
