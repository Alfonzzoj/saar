<?php

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
               
        \DB::table('cargos')->insert(array (
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Supervisor General',
                'departamento_id' => 2,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Supervisor General',
                'departamento_id' => 31,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Administrador',
                'departamento_id' => 31,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Inspector de Seguridad Aeroportuaria',
                'departamento_id' => 5,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Director',
                'departamento_id' => 13,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Sub-Director',
                'departamento_id' => 13,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'Jefe de Oficina',
                'departamento_id' => 22,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'Analista Legal',
                'departamento_id' => 22,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'Jefe de Oficina',
                'departamento_id' => 26,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'Analista Programador de Sistemas',
                'departamento_id' => 26,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'Operador de Soporte Técnico',
                'departamento_id' => 26,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'Administrador de Redes',
                'departamento_id' => 26,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'Jefe de Oficina',
                'departamento_id' => 24,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'Analista Comunicacional',
                'departamento_id' => 24,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'Técnico en Multimedia',
                'departamento_id' => 24,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'Jefe de Oficina',
                'departamento_id' => 23,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'Analista de Organización y Método',
                'departamento_id' => 23,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            18 => 
            array (
                'id' => 20,
                'nombre' => 'Jefe de Oficina',
                'departamento_id' => 21,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            19 => 
            array (
                'id' => 21,
                'nombre' => 'Analista de Recursos Humanos',
                'departamento_id' => 21,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            20 => 
            array (
                'id' => 22,
                'nombre' => 'Asistente de Recursos Humanos',
                'departamento_id' => 21,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            21 => 
            array (
                'id' => 23,
                'nombre' => 'Supervisor de Seguridad',
                'departamento_id' => 29,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            22 => 
            array (
                'id' => 24,
                'nombre' => 'Asistente de Servicios Generales',
                'departamento_id' => 29,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            23 => 
            array (
                'id' => 25,
                'nombre' => 'Auxiliar de Servicios Generales',
                'departamento_id' => 29,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            24 => 
            array (
                'id' => 26,
                'nombre' => 'Jefe de Departamento',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            25 => 
            array (
                'id' => 27,
                'nombre' => 'Comprador',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            26 => 
            array (
                'id' => 28,
                'nombre' => 'Analista Contable',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            27 => 
            array (
                'id' => 29,
                'nombre' => 'Analista Administrativo',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            28 => 
            array (
                'id' => 30,
                'nombre' => 'Asistente de Servicios Generales',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            29 => 
            array (
                'id' => 31,
                'nombre' => 'Recaudador',
                'departamento_id' => 10,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            30 => 
            array (
                'id' => 32,
                'nombre' => 'Supervisor de Recaudación',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            31 => 
            array (
                'id' => 33,
                'nombre' => 'Jefe de Departamento',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            32 => 
            array (
                'id' => 34,
                'nombre' => 'Analista Administrativo',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            33 => 
            array (
                'id' => 35,
                'nombre' => 'Asistente Administrativo',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            34 => 
            array (
                'id' => 36,
                'nombre' => 'Recaudador',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            35 => 
            array (
                'id' => 40,
                'nombre' => 'Administrador',
                'departamento_id' => 11,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            36 => 
            array (
                'id' => 41,
                'nombre' => 'Asistente de Servicios Generales',
                'departamento_id' => 14,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            37 => 
            array (
                'id' => 42,
                'nombre' => 'Gerente de Administración',
                'departamento_id' => 14,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            38 => 
            array (
                'id' => 43,
                'nombre' => 'Asistente Administrativo',
                'departamento_id' => 14,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            39 => 
            array (
                'id' => 44,
                'nombre' => 'Coordinador de Área',
                'departamento_id' => 3,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            40 => 
            array (
                'id' => 45,
                'nombre' => 'Ingeniero en Mantenimiento Industrial',
                'departamento_id' => 3,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            41 => 
            array (
                'id' => 46,
                'nombre' => 'Gerente de Aeródromo',
                'departamento_id' => 15,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            42 => 
            array (
                'id' => 47,
                'nombre' => 'Gerente de Aeródromo',
                'departamento_id' => 16,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            43 => 
            array (
                'id' => 48,
                'nombre' => 'Gerente de Aeródromo',
                'departamento_id' => 17,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            44 => 
            array (
                'id' => 49,
                'nombre' => 'Jefe de Unidad de Proyecto',
                'departamento_id' => 35,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            45 => 
            array (
                'id' => 50,
                'nombre' => 'Supervisor de Seguridad Aeroportuaria',
                'departamento_id' => 5,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            46 => 
            array (
                'id' => 51,
                'nombre' => 'Servicios Generales',
                'departamento_id' => 18,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            47 => 
            array (
                'id' => 52,
                'nombre' => 'Supervisor de Operaciones',
                'departamento_id' => 30,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            48 => 
            array (
                'id' => 53,
                'nombre' => 'TOA',
                'departamento_id' => 30,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            49 => 
            array (
                'id' => 54,
                'nombre' => 'Supervisor de Operaciones',
                'departamento_id' => 27,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            50 => 
            array (
                'id' => 55,
                'nombre' => 'TOA',
                'departamento_id' => 27,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            51 => 
            array (
                'id' => 56,
                'nombre' => 'Técnico de Atención Prehospitalaria',
                'departamento_id' => 34,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            52 => 
            array (
                'id' => 57,
                'nombre' => 'Paramédico',
                'departamento_id' => 34,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            53 => 
            array (
                'id' => 58,
                'nombre' => 'Supervisor General',
                'departamento_id' => 28,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            54 => 
            array (
                'id' => 59,
                'nombre' => 'Asistente Administrativo',
                'departamento_id' => 28,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            55 => 
            array (
                'id' => 60,
                'nombre' => 'Asistente Relaciones Públicas',
                'departamento_id' => 28,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            56 => 
            array (
                'id' => 61,
                'nombre' => 'Gerente de Aeropuerto',
                'departamento_id' => 20,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            57 => 
            array (
                'id' => 62,
                'nombre' => 'Asistente Administrativo',
                'departamento_id' => 20,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            58 => 
            array (
                'id' => 63,
                'nombre' => 'Analista de Operaciones Aeronáuticas',
                'departamento_id' => 20,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            59 => 
            array (
                'id' => 64,
                'nombre' => 'Inspector PREVAC',
                'departamento_id' => 31,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            60 => 
            array (
                'id' => 65,
                'nombre' => 'Bombero Aeronáutico',
                'departamento_id' => 32,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            61 => 
            array (
                'id' => 66,
                'nombre' => 'Jefe de Departamento',
                'departamento_id' => 12,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            62 => 
            array (
                'id' => 67,
                'nombre' => 'Analista Administrativo',
                'departamento_id' => 12,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            63 => 
            array (
                'id' => 68,
                'nombre' => 'Analista Contable',
                'departamento_id' => 12,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            64 => 
            array (
                'id' => 69,
                'nombre' => 'Analista Administrativo',
                'departamento_id' => 12,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            65 => 
            array (
                'id' => 70,
                'nombre' => 'Gerente de Aeropuerto',
                'departamento_id' => 18,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            66 => 
            array (
                'id' => 71,
                'nombre' => 'Gerente de Aeropuerto',
                'departamento_id' => 19,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            67 => 
            array (
                'id' => 73,
                'nombre' => 'Coordinador de Área',
                'departamento_id' => 5,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            68 => 
            array (
                'id' => 74,
                'nombre' => 'Supervidor General',
                'departamento_id' => 33,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            69 => 
            array (
                'id' => 75,
                'nombre' => 'Inspector de Seguridad Aeroportuaria',
                'departamento_id' => 33,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}
