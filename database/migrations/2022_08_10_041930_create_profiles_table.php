<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            // user_id it could be the primary key for this model.
            $table->foreignID('user_id')
                    ->primary()
                    ->constrained('users')
                    ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male','female'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->char('country_code', 2); // PS => Palestine
            $table->string('locale', 5)->default(config('app.local')); // AR => Arabic
            $table->string('timezone')->default(config('app.timezone'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
