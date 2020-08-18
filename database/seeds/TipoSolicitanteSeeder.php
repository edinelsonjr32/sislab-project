<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSolicitanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Docente',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Discente',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Técnico Administrativo',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Monitor',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Externo',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Coordenação Campus Santarém',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('tipo_solicitante')->insert([
            'nome' => 'Outros',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
