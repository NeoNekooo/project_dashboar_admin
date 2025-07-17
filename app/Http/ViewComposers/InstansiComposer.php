<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Instansi;

class InstansiComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $instansi = Instansi::first();


        if (!$instansi) {
            $instansi = new Instansi([
                'nama_instansi' => 'Aplikasi Default',
                'singkatan' => 'APP',
                'logo' => null,
                'icon' => null, 
            ]);
        }

        $view->with('instansiData', $instansi);
    }
}