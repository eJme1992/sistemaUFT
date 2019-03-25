<?php

namespace App\Imports;

use App\Cuenta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CuentasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cuenta([
                   'nombre'=> $row['nombre'],
                   'tipo'=> $row['tipo'],
                   'industria'=> $row['industria'],
                   'tema'=> $row['tema'],
                   'referido'=> $row['referido'],
                   'crm'=> $row['crm'],
                   'descripcion'=> $row['descripcion'],
                   'calle'=> $row['calle'],
                   'ciudad'=> $row['ciudad'],
                   'provincia'=> $row['provincia'],
                   'pais'=> $row['pais'],
                   'codigo_postal'=> $row['codigo_postal'],
                   'correo'=> $row['correo'],
                   'telefono'=> $row['telefono'],
                   'logo' => '/',
                   'estado' => 'activo',
                   'slug' => uniqid($row['nombre'])
        ]);
    }
}
