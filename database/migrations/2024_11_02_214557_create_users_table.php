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
            $table->string('name_vswa');
            $table->string('abbrevation_vswa');
            $table->string('vswa_email')->unique();
            $table->string('vswa_phone');
            $table->string('applicant_name');
            $table->string('applicant_email')->unique();
            $table->string('applicant_mobile_no');
            $table->string('applicant_type');
            $table->string('password');
            $table->foreignId('thematic_id')->constrained('thematic_areas')->onDelete('cascade');
            $table->foreignId('vswa_hq_id')->constrained('vswa_head_quarters')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
