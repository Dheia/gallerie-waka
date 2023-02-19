<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metas = [
            'resume' => 'Gallerie de test, sous inertia / laravel',
            'author' => 'Charles Saint Olive',
            'title' => 'Gallerie de test',
            'keyWord' => 'Laravel, Inertia, Tableau',
        ];
        $options = [
            'redirect' => '/',
            'image' => true,
            'contentMode' => "simple",
        ];
        $page = Page::create([
            'name' => 'Accueil',
            'slug' => 'accueil',
            'title' => 'Bienvenue<br>sur ma gallerie',
            'content' => 'Lorem ipsum dolor sit amet. Et inventore sint eos ullam animi aut quia labore vel voluptate dolorem est minus animi qui consequatur molestiae non fugit molestiae. Sed porro illo et internos nihil rem natus commodi in provident beatae est optio rerum. Ut quia tempore sit omnis illo et alias accusantium id exercitationem distinctio At nemo dicta sed voluptas consequatur. </p><p>In veniam animi in similique officia eum nihil placeat ut repudiandae totam et voluptatem internos id nihil porro? Est dicta harum ea corporis consequatur qui sint natus ad amet sunt ut illum Quis ut ducimus sunt est dolorem repellat. 33 quidem nobis sed beatae quas ut perspiciatis quidem aut quod recusandae et vero voluptatem eum veniam sapiente! Est alias consectetur ea praesentium assumenda ut animi facere. </p><p>Eos voluptatibus consequatur rem illo quis et similique amet est eaque enim! Sed doloribus odit qui adipisci facilis et accusantium ratione quo facere voluptatem et quos nihil aut voluptates laborum eum provident sunt. In dolores sint ab omnis sint in magni architecto',
            'metas' => $metas,
            'staticOptions' => $options,

        ]);
        $path = database_path('seeders/files/pages/portrait_v2.png');
        $page->addMedia($path)->preservingOriginal()->toMediaCollection('image');
        //
        $options = [
            'image' => false,
            'contentMode' => "advanced",
        ];

        $metas = [
            'resume' => 'Mentions légales du site gallerie',
            'author' => 'Charles Saint Olive',
            'title' => 'Mentions légales',
            'keyWord' => 'Mentions légales',
        ];
        Page::create([
            'name' => 'Mentions légales',
            'slug' => 'mentions',
            'title' => null,
            'content' => "<p><strong>Ce site est une démo sous Larval / Inertia.js / Vue.js3.</strong></p><p>Il a été crée dans un but <strong>demonstratif</strong>, les tableaux et images proviennent de midjourney et il n' y a pas de tableau ou d'image en vente sur ce site.</p><p>Ce site dispose d'un B.O securisé qui permet de piloter l'ensemble du contenu du site. </p><p>Contactez moi, si vous voulez avoir un identifiant et un mot de passe pour aller sur le B.O</p><p></p>",
            'metas' => $metas,
            'staticOptions' => $options,
        ]);
    }
}
