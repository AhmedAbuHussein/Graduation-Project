<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {

        $datastore = \App\Models\Datastore::all();
        $dateAdd = \App\Models\Userhistory::where('date','>',(date('Y')-5).'-06-30')
                                            ->orderBy('date','DESC')
                                            ->get();
        
        $date = array();
        foreach($dateAdd as $d){
            array_push($date,$d->date);
        }
        $stores = \App\Models\Store::all();
        $count = array();
        for($i=1;$i<=count($stores);$i++){
            array_push($count,\App\Models\Additem::join('datastores','datastores.id','=','additems.datastore_id')
                                                ->where('datastores.store_id','=',$i)
                                                ->sum('additems.quantity'));
        }
       

        $arr = Array(
            'title'=>'الاحصائيات',
            'ava'=>count($datastore),
            'date'=> array_unique($date,SORT_REGULAR),
            'stores'=>$stores,
            'count'=>$count,
        );
        return view('chart',$arr);
    }
}
