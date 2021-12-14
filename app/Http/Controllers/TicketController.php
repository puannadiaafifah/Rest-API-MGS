<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller{
    public function create (request $request){
        $validateData = Validator::make($request->all(),[
            'tgl_laporan' => 'required|date',
            'jenis' => 'required',
            'sub_jenis' => 'required',
        ]);

        if($validateData->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validateData->errors(),
                    ]);

        }else{
            $no_laporan="TS/".time();
            $ticket=new Ticket();
            $ticket->tgl_laporan=$request->tgl_laporan;
            $ticket->no_laporan=$no_laporan;
            $ticket->jenis=$request->jenis;
            $ticket->sub_jenis=$request->sub_jenis;
            $ticket->save();

            return response()->json([
                'success' => true,
                'message' => 'Ticket berhasil ditambahkan',
            ]);
        }
    }

    public function GetData(){
        $ticket=Ticket::all();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil',
            'data' => $ticket,
        ]);
    }

}
