<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Partner;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('language',10)->default('es');
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('theme_id')->unsigned()->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('theme_id')->references('id')
                ->on('themes')->onDelete('set null')->onUpdate('cascade');
        });

        $user = new User();
        $user->username = 'mario1001r';
        $user->email = 'mario1001r@gmail.com';
        $user->password = bcrypt('secret123');
        $user->type = 'admin';
        $user->save();
        /*
        142 = México, 2438 = Guanajuato, 27849 = León
        */
        $partner = new Partner();
        $partner->first_name = 'Mario';
        $partner->last_name = 'Muñoz';
        $partner->phone_number = '4770000000';
        $partner->movil = '4770000000';
        $partner->birthday = '1994-03-23';
        $partner->age = 29;
        $partner->sex = 'male';
        $partner->street = 'Blvd. Campestre';
        $partner->noExt = '2024-A';
        $partner->noInt = '';
        $partner->colony = 'Panorama';
        $partner->postal_code = '37160';
        $partner->user_id = $user->_id;
        $partner->country_id = 142;
        $partner->state_id = 2438;
        $partner->city_id = 27849;
        $partner->save();
        // Tema 2 = cosmo
        $setting = new Setting();
        $setting->language = 'es';
        $setting->user_id = $user->_id;
        $setting->theme_id = 2;
        $setting->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
