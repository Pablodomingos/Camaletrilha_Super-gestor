<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $site_contato = new SiteContato();
        $site_contato->nome = "Sistema SG";
        $site_contato->telefone = "(27) 99722-9377";
        $site_contato->email = "contato@sg.com.br";
        $site_contato->motivo_contato = 1;
        $site_contato->mensagem = "Seja bem-vindo ao sistema Super Gestão";
        $site_contato->save();
        */

        \App\Models\SiteContato::factory(100)->create();
    }
}
