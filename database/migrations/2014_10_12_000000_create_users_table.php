<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('sms_code')->nullable();
            $table->decimal('balance', 12, 2)->default('0.00');
            $table->tinyInteger('role')->unsigned()->default(2);           // 1-admin, 2-klient, ...
            $table->string('image')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('role')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
