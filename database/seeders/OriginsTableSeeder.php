<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $origins = [
            ['id' => 1, 'title' => 'ACIDENTE DE TRABALHO', 'active' => true],
            ['id' => 2, 'title' => 'CASA', 'active' => true],
            ['id' => 3, 'title' => 'CASAI - CASA DE APOIO À SAÚDE INDÍGENA', 'active' => true],
            ['id' => 4, 'title' => 'CIOSPE', 'active' => true],
            ['id' => 5, 'title' => 'CREAP - CENTRO DE REABILITAÇÃO DO AMAPÁ', 'active' => true],
            ['id' => 6, 'title' => 'ESCOLA', 'active' => true],
            ['id' => 7, 'title' => 'HCA - HOSPITAL DA CRIANÇA E DO ADOLESCENTE', 'active' => true],
            ['id' => 8, 'title' => 'HCAL - HOSPITAL DE CLINICAS DR. ALBERTO LIMA', 'active' => true],
            ['id' => 9, 'title' => 'HE - HOSPITAL DE EMERGÊNCIA', 'active' => true],
            ['id' => 10, 'title' =>  'HEAP - HOSPITAL DO AMAPÁ', 'active' => true],
            ['id' => 11, 'title' =>  'HEC - HOSPITAL DE CALÇOENE', 'active' => true],
            ['id' => 12, 'title' =>  'HELJ - HOSPITAL DE LARANJAL DO JARI', 'active' => true],
            ['id' => 13, 'title' =>  'HEMD - HOSPITAL DE MONTE DOURADO', 'active' => true],
            ['id' => 14, 'title' =>  'HEO - HOSPITAL DE OIAPOQUE', 'active' => true],
            ['id' => 15, 'title' =>  'HES - HOSPITAL DE SANTANA', 'active' => true],
            ['id' => 16, 'title' =>  'HEVJ - HOSPITAL DE VITÓRIA DO JARÍ', 'active' => true],
            ['id' => 17, 'title' =>  'HMML - HOSPITAL DA MULHER MÃE LUZIA', 'active' => true],
            ['id' => 18, 'title' =>  'HOSPITAL SÃO CAMILO E SÃO LUIZ', 'active' => true],
            ['id' => 19, 'title' =>  'HOSPITAL UNIMED', 'active' => true],
            ['id' => 20, 'title' =>  'IAPEN', 'active' => true],
            ['id' => 21, 'title' =>  'NÃO INFORMADO', 'active' => true],
            ['id' => 22, 'title' =>  'PAI - PRONTO ATENDIMENTO INFANTIL', 'active' => true],
            ['id' => 23, 'title' =>  'TRABALHO', 'active' => true],
            ['id' => 24, 'title' =>  'UBS ALVARO CORRÊA', 'active' => true],
            ['id' => 25, 'title' =>  'UBS CONGÓS', 'active' => true],
            ['id' => 26, 'title' =>  'UBS DO MUNICIPIO DO AMAPÁ', 'active' => true],
            ['id' => 27, 'title' =>  'UBS DO MUNICIPIO DE CALÇOENE', 'active' => true],
            ['id' => 28, 'title' =>  'UBS DO MUNICIPIO DE CUTIAS', 'active' => true],
            ['id' => 29, 'title' =>  'UBS DO MUNICIPIO DE FERREIRA GOMES', 'active' => true],
            ['id' => 30, 'title' =>  'UBS DO MUNICIPIO DE ITAUBAL', 'active' => true],
            ['id' => 31, 'title' =>  'UBS DO MUNICIPIO DE LARANJAL DO JARI', 'active' => true],
            ['id' => 32, 'title' =>  'UBS DO MUNICIPIO DE MACAPÁ', 'active' => true],
            ['id' => 33, 'title' =>  'UBS DO MUNICIPIO DE MAZAGÃO', 'active' => true],
            ['id' => 34, 'title' =>  'UBS DO MUNICIPIO DE OIAPOQUE', 'active' => true],
            ['id' => 35, 'title' =>  'UBS DO MUNICIPIO DE PEDRA BRANCA DO AMAPARÍ', 'active' => true],
            ['id' => 36, 'title' =>  'UBS DO MUNICIPIO DE PORTO GRANDE', 'active' => true],
            ['id' => 37, 'title' =>  'UBS DO MUNICIPIO DE PRACUÚBA', 'active' => true],
            ['id' => 38, 'title' =>  'UBS DO MUNICIPIO DE SANTANA', 'active' => true],
            ['id' => 39, 'title' =>  'UBS DO MUNICIPIO DE SERRA DO NAVIO', 'active' => true],
            ['id' => 40, 'title' =>  'UBS DO MUNICIPIO DE TARTARUGALZINHO', 'active' => true],
            ['id' => 41, 'title' =>  'UBS DO MUNICÍPIO DE VITÓRIA DO JARI', 'active' => true],
            ['id' => 42, 'title' =>  'UBS LÉLIO SILVA', 'active' => true],
            ['id' => 43, 'title' =>  'UBS PERPETUO SOCORRO', 'active' => true],
            ['id' => 44, 'title' =>  'UBS RUBEN ARONOVITCH', 'active' => true],
            ['id' => 45, 'title' =>  'UBS/UPA MARCELO CÂNDIA', 'active' => true],
            ['id' => 46, 'title' =>  'UPA DE LARANJAL DO JARI', 'active' => true],
            ['id' => 47, 'title' =>  'UPA ZONA NORTE', 'active' => true],
            ['id' => 48, 'title' =>  'UPA ZONA SUL', 'active' => true],
            ['id' => 49, 'title' =>  'VIA PÚBLICA', 'active' => true]
        ];

        DB::table('origins')->insert($origins);
    }
}
