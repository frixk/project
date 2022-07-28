<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index(){        
        $task  = DB::connection('mysql')->table('Tasks')->get();   
        return view('welcome', compact('task'));
    }
    
    public function submitTask(Request $request){
        $sql =DB::connection('mysql')->table('Tasks')->insert([  
            'task'              => $request->task,
            'schedule'          => $request->schedule,
            'created_at'        => date('Y-m-d H:i:s'),
        ]); 
        
        return redirect('/');
    }

    public function completeTask(Request $request){
     
        $query =DB::connection('mysql')->table('Tasks')->where('id', $request->id)
        ->update([                
            'updated_at'  => date('Y-m-d H:i:s')
        ]);

        $task  = DB::connection('mysql')->table('Tasks')->get(); 

        return response()->json([
            
        ]);
    }

    public function privacyPolicy(){
        return view('privacypolicy');
    }

    public function tos(){
        return view('tos');
    }
}
