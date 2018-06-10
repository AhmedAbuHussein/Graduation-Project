<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Covenant;
use App\Models\Datastore;
use App\Models\Additem;
use App\Models\Store;

class ChartController extends Controller
{
    public function chart(){
        $covcount = count(Covenant::all());
        $avgcov = round((Covenant::sum('quantity') / Datastore::sum('quantity')) * 100,3);
        $datastore = \App\Models\Datastore::all();
        $dateAdd = Additem::where('date','>',(date('Y')-5).'-06-30')
                                            ->orderBy('date','DESC')
                                            ->get();
        
        $date = array();
        foreach($dateAdd as $d){
            array_push($date,$d->date);
        }
        $stores = \App\Models\Store::all();
        $countadd = array();
        $countcov = array();
        for($i=1;$i<=count($stores);$i++){
            array_push($countadd,Additem::join('datastores','datastores.id','=','additems.datastore_id')
                                                ->where('datastores.store_id','=',$i)
                                                ->sum('additems.quantity'));
            array_push($countcov,Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                                                ->where('datastores.store_id','=',$i)
                                                ->sum('covenants.quantity'));
        }
       $count = array();
        array_push($count,$countadd,$countcov);
        $arr = Array(
            'title'=>'الاحصائيات',
            'ava'=>count($datastore),
            'date'=> array_unique($date,SORT_REGULAR),
            'stores'=>$stores,
            'count'=>$count,
            'covcount'=>$covcount,
            'avgcov' => $avgcov,
        );
        return view('chart',$arr);
    }


    public function getprogress(Request $req){
        $prog = array();
        for($i=1;$i<=count(Store::all());$i++){
            $avg =round((Covenant::join('datastores','datastores.id','=','covenants.datastore_id')
                        ->where('datastores.store_id','=',$i)
                        ->sum('covenants.quantity') / Datastore::where('store_id','=',$i)->sum('quantity'))*100,3); 
            array_push($prog,$avg);
        }
        return $prog;
    }
}
