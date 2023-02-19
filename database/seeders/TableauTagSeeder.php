<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TableauTag;

class TableauTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->make('Format paysage', 'o-paysage');
        $this->make('Format portrait','o-portrait' );
        $this->make('Format carré', 'o-carre' );
        $this->make('En ventes', 'tosales');
        $this->make('Paysages');
        $this->make('Portraits');
        $this->make('Animaux');
        $this->make('Natures');
        $this->make('Modernes');
        $this->make('Fantasy', 'fantasys');

    }

    public function make($name, $slug = null) {
        if(!$slug) $slug = \Str::slug($name);
        $tag = TableauTag::create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }
}
