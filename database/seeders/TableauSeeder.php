<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tableau;
use App\Models\TableauTag;

class TableauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->make("Chien", "dog.jpg", ['animaux', 'o-portrait']);
        $this->make("Oiseau", "bird.jpg", ['animaux', 'o-portrait']);
        $this->make("Femme punk", "woman.jpg", ['portraits', 'o-portrait']);
        $this->make("Lapin", "rabbit.jpg", ['animaux', 'o-portrait']);
        $this->make("Immeuble", "immeuble.jpg", ['urban', 'o-portrait']);
        $this->make("Dieu JV", "god.jpg", ['fantasys', 'o-portrait', 'tosales']);
        $this->make("Femme Chat", "womancat.jpg", ['fantasys', 'animaux', 'portraits', 'o-portrait']);
        $this->make("Cabane Cerise", "tree.jpg", ['natures', 'paysages', 'o-portrait', 'tosales']);
        $this->make("Armure", "armure.jpg", ['fantasys', 'o-carre']);
        $this->make("Paysage de campagne", "paysage_rose.jpg", ['natures','paysages', 'o-paysage']);
        $this->make("Paysage Jaune", "paysage_jaune.jpg", ['paysages', 'o-paysage']);
        $this->make("Paysage Rouge", "paysage_rouge_bird.jpg", ['paysages', 'o-paysage']);
        $this->make("Le labo d'alchimie", "alchimie.jpg", ['fantasys', 'o-paysage']);
        $this->make("4 portraits", "4_portraits.jpg", ['fantasys', 'o-paysage']);
        $this->make("Carte tarot", "cardtarot.jpg", ['fantasys', 'o-carre', 'tosales']);
        $this->make("Paysage de SF", "scifi.jpg", ['fantasys', 'paysages', 'o-carre']);
        $this->make("Immeubles", "immeubles_2.jpg", ['modernes',  'o-paysage']);
        $this->make("Arbre SF", "scifi_tree.jpg", ['fantasys',  'o-carre', 'tosales']);
        $this->make("Egypte OSIRIS", "egypte.jpg", ['fantasys',  'o-portrait']);
        $this->make("Vue sur Mer", "paysage_3.jpg", ['natures','paysages',  'o-paysage']);
        $this->make("Les cercles", "paysage_4.jpg", ['natures','modernes', 'paysages', 'tosales', 'o-paysage']);
        $this->make("Volcan de couleurs", "volcan.jpg", ['modernes',  'o-carre']);
        $this->make("Paysahe Onirique", "paysage.jpg", ['natures',  'o-carre']);
        $this->make("Dame au violon", "personnage.jpg", ['modernes',  'o-paysage']);
        $this->make("Portrait Moderne", "portrait_ai.jpg", ['modernes',  'o-portrait']);
        $this->make("Vélasquez", "velasquez.jpg", ['portraits',  'o-carre']);
        $this->make("Chaplin style Vélasquez", "cc_velasquez.jpg", ['portraits',  'o-carre']);
        $this->make("Chaplin style Dali", "cc_dali.jpg", ['modernes', 'portraits',  'o-carre']);
        $this->make("Gallerie d'art", "art_gallery.jpg", ['modernes',  'o-paysage']);
        $this->make("Chaplin style Impressionisme", "cc_portrait_impressioninste.jpg", ['modernes', 'portraits',  'o-carre']);
        $this->make("Chaplin pense", "cc_impressioniste.jpg", ['impressionnisme', 'paysages',  'o-paysage']);
        $this->make("Chaplin le Fabuleux destin de Charlie", "cc_fdap.jpg", ['portraits',  'o-portrait']);
        $this->make("Chaplin Blade Runner", "cc_blade_runner_3.jpg", ['o-paysage']);
        $this->make("Chaplin Seigneur des anneaux", "c_lotr.jpg", ['portraits', 'paysages', 'o-paysage']);
        $this->make("Planets", "planet.jpg", ['fantasys', 'modernes', 'o-paysage']);
        $this->make("Enfant triste", "sad_child.jpg", ['portraits', 'o-paysage']);
        $this->make("La dame et la lune", "woman_w.jpg", ['modernes', 'o-paysage']);
        //
        $this->make("Foret 1", "cso_foret_1.jpg", ['modernes','natures', 'tosales', 'o-paysage']);
        $this->make("Foret 2", "cso_foret_2.jpg", ['modernes','natures', 'o-paysage']);
        $this->make("Foret 3", "cso_foret_3.jpg", ['modernes','natures', 'o-paysage']);
        //
        $this->make("Forêt enchanté 1", "julz_forrest_1.jpg", ['modernes','natures', 'o-paysage']);
        $this->make("Forêt enchanté 2", "julz_forrest_2.jpg", ['modernes','natures', 'o-paysage']);
        $this->make("Forêt enchanté 3", "julz_forrest_3.jpg", ['modernes','natures', 'tosales', 'o-paysage']);
        $this->make("Forêt enchanté 4", "julz_forrest_4.jpg", ['modernes','natures', 'o-paysage']);
        $this->make("Forêt enchanté 5", "julz_forrest_5.jpg", ['modernes','natures', 'o-paysage']);
        //
        $this->make("Dragon & girl", "penta_1.jpg", ['modernes', 'tosales', 'o-portrait']);
        $this->make("Dragon & girl", "penta_2.jpg", ['modernes', 'o-portrait']);
        $this->make("Dragon & girl", "penta_3.jpg", ['modernes', 'o-portrait']);
        //
        $this->make("Dans le sable 1", "sand_1.jpg", ['modernes', 'o-paysage']);
        $this->make("Dans le sable 2", "sand_2.jpg", ['modernes', 'o-paysage']);
        $this->make("Dans le sable 3", "sand_3.jpg", ['modernes','tosales', 'o-paysage']);
        $this->make("Dans le sable 4", "sand_4.jpg", ['modernes', 'o-paysage']);
        //
        $this->make("BD 1", "shishimecx_bd_1.jpg", ['o-paysage']);
        $this->make("BD 2", "shishimecx_bd_2.jpg", ['o-paysage']);
        $this->make("BD 3", "shishimecx_bd_3.jpg", ['o-paysage']);
        $this->make("BD 4", "shishimecx_bd_4.jpg", ['o-paysage' , 'tosales']);
        $this->make("BD 5", "shishimecx_bd_5.jpg", ['o-paysage']);
        $this->make("BD 6", "shishimecx_bd_6.jpg", ['o-paysage']);
        //
        $this->make("Vice city 1", "viglomir_vc_1.jpg", ['modernes', 'tosales','o-paysage']);
        $this->make("Vice city 2", "viglomir_vc_2.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 3", "viglomir_vc_3.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 4", "viglomir_vc_4.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 5", "viglomir_vc_5.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 6", "viglomir_vc_6.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 7", "viglomir_vc_7.jpg", ['modernes','o-paysage']);
        $this->make("Vice city 8", "viglomir_vc_8.jpg", ['modernes','o-paysage']);
        //
        $this->make("BD blanche 1", "white_1.jpg", ['modernes','o-paysage']);
        $this->make("BD blanche 2", "white_2.jpg", ['modernes', 'tosales','o-paysage']);
        $this->make("BD blanche 3", "white_3.jpg", ['modernes','o-paysage']);
        $this->make("BD blanche 4", "white_4.jpg", ['modernes','o-paysage']);
        $this->make("BD blanche 5", "white_5.jpg", ['modernes','o-paysage']);
        $this->make("BD blanche 6", "white_6.jpg", ['modernes', 'tosales','o-paysage']);
        $this->make("BD blanche 7", "white_7.jpg", ['modernes','o-paysage']);
        $this->make("BD blanche 8", "white_8.jpg", ['modernes','o-paysage']);
    }

    private function make($name, $path, $tags) {
        $faker = \Faker\Factory::create();
        //
        $tableau = Tableau::create([
            'name' => $name,
            'slug' => \Str::slug($name),
            'description' => $faker->paragraph(),
            'painted_at' => $faker->dateTimeBetween('-12 months'),
        ]);
        $path = database_path('seeders/files/tableaux/'.$path);
        $tableau->addMedia($path)->preservingOriginal()->toMediaCollection('images');
        $addTags = TableauTag::whereIn('slug', $tags )->pluck('id');
        $tableau->tableauTags()->sync($addTags);

    }
}
