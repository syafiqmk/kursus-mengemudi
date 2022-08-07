<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->ondelete('cascade')->onUpdate('cascade');
            $table->foreignId('car_id')->constrained('cars')->ondelete('cascade')->onUpdate('cascade');
            $table->foreignId('package_id')->constrained('packages')->ondelete('cascade')->onUpdate('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->ondelete('cascade')->onUpdate('cascade');
            $table->string('payment_image')->nullable();
            $table->enum('status', ['enroll', 'wait', 'grant', 'finish']);
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
        Schema::dropIfExists('courses');
    }
};
