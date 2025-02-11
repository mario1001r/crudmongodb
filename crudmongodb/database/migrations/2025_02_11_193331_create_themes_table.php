<?php

use App\Models\Theme;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('description',150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Bootswatch Themes
        date_default_timezone_set('America/Mexico_City');
        $registration_date = now()->toDateTimeString();
        Theme::insert([
            ['id' => 1,'name' => 'cerulean','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 2,'name' =>  'cosmo','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 3,'name' =>  'cyborg','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 4,'name' =>  'darkly','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 5,'name' =>  'flatly','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 6,'name' =>  'journal','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 7,'name' =>  'litera','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 8,'name' =>  'lumen','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 9,'name' =>  'lux','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 10,'name' =>  'materia','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 11,'name' =>  'minty','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 12,'name' =>  'morph','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 13,'name' =>  'pulse','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 14,'name' =>  'quartz','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 15,'name' =>  'sandstone','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 16,'name' =>   'simplex','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 17,'name' =>  'sketchy','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 18,'name' =>   'slate','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 19,'name' =>  'solar','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 20,'name' =>  'spacelab','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 21,'name' =>  'superhero','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 22,'name' =>  'united','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 23,'name' =>  'vapor','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 24,'name' =>  'yeti','created_at' => $registration_date, 'updated_at' => $registration_date],
            ['id' => 25,'name' =>  'zephyr','created_at' => $registration_date, 'updated_at' => $registration_date],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
