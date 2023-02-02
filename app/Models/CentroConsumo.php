<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroConsumo extends Model
{
    protected $table    = 'centros_consumo';
    protected $guarded  = [
        'created_at',
        'updated_at'
    ];
    

    public static function get($params = [])
    {
        $id             = isset($params['id'])              ? $params['id']             : null;
        $dia            = isset($params['dia'])             ? $params['dia']            : null;
        $categoria      = isset($params['categoria'])       ? $params['categoria']      : null;
        $hotel_id       = isset($params['hotel_id'])        ? $params['hotel_id']       : null;
        $orderBy        = isset($params['order_by'])        ? $params['order_by']       : ['column' => 'id', 'direction' => 'asc'];

       
            $centroConsumo = CentroConsumo::select(
                'centros_consumo.*',
                'categorias.categoria AS categoria_name',
                'centros_consumo_horarios.id as consumo_horario_id',
                'centros_consumo_horarios.dia',
                'centros_consumo_horarios.hora_inicio',
                'centros_consumo_horarios.hora_final',
                'hoteles.clave'
            )
            ->join('categorias', 'centros_consumo.categoria_id', '=', 'categorias.id')
            ->leftjoin('centros_consumo_horarios', 'centros_consumo.id', '=', 'centros_consumo_horarios.centro_consumo_id')
            ->leftjoin('centros_consumo_detalles', 'centros_consumo.id', '=', 'centros_consumo_detalles.centro_consumo_id')
            ->leftjoin('hoteles', 'centros_consumo_detalles.hotel_id', '=', 'hoteles.id');
        

       

        if (!is_null($id))
            $centroConsumo->where('centros_consumo.id', $id);
        if (!is_null($categoria))
            $centroConsumo->where('centros_consumo.categoria_id', $categoria);
        if (!is_null($dia))
            $centroConsumo->where('centros_consumo_horarios.dia', $dia);
        if (!is_null($hotel_id))
            $centroConsumo->where('centros_consumo_detalles.hotel_id', $hotel_id);
        
        if (!is_null($orderBy))
            $centroConsumo->orderBy($orderBy['column'], $orderBy['direction']);

        
        return $centroConsumo->get();
    }

}
