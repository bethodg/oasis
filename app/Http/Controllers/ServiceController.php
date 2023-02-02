<?php

namespace App\Http\Controllers;

use Auth, Exception, View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\CentroConsumo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends BaseController
{
   
    public function index()
    {
        $today                 = getdate();
        $bares                 = CentroConsumo::get(['dia' => strval($today['wday']) , 'categoria' => 3 , 'hotel_id' => 1]);
        $data['bares']         = $this->checkExtraHours($bares);
        $restaurantes          = CentroConsumo::get(['dia' => strval($today['wday']), 'categoria' => 2, 'hotel_id' => 1]);
        $data['restaurantes']  = $this->checkExtraHours($restaurantes);
        return view('index', $data);
    }

    public function checkExtraHours($collectionServices)
    {

        $collectionServices2 = collect($collectionServices);
        $removeItems = [];
        $tempItems   = [];
        $extraHoras  = [];
        foreach($collectionServices as $key => $service){
            $elem = 0;
            
            foreach($collectionServices2 as $key2 => $service2){
                
                if( ($service->id == $service2->id ) ){
                    if($service->consumo_horario_id != $service2->consumo_horario_id){
                       
                        $extraHoras = [
                            'hora_inicio'  => $service2->hora_inicio,
                            'hora_final'   => $service2->hora_final
                        ];
                        $tempItems[]   = $extraHoras;
                        $removeItems[] =  $service2->consumo_horario_id;
                        $collectionServices2->forget($key2);
                        $elem++;
                    }else{
                        $collectionServices2->forget($key2);
                    }
                }
                $service->extra_horas =  $tempItems;
               
                
            }
            $tempItems = [];
        }
        foreach($removeItems as $item ){
            foreach($collectionServices as $key3 => $service3){
                if($service3->consumo_horario_id == $item){
                    $collectionServices->forget($key3);
                }
                    
            }
        }
        return $collectionServices;
    }

    public function getCard(Request $request)
    {
        try {
           
            $today            = getdate();
            $servicio         = CentroConsumo::get(['id' => $request->id , 'dia' => strval($today['wday']), 'categoria' => $request->categoria, 'hotel_id' => 1]);
            
            $data['servicio'] = $this->checkExtraHours($servicio);

            $card = view('partials.card', $data)->render();
            return response()->json([
                'status'  => 'ok',
                'message' => '',
                'data'    => $card,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
                'data'    => ''
            ]);
        }
        
    }
}
