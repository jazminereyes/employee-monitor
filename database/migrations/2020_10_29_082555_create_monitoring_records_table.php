<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_records', function (Blueprint $table) {
            $table->id();
            $table->string('image_type');
            $table->timestamp('date_time_taken');
            $table->text('photo_url');
            $table->date('expiration')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->foreignId('user_id')->constrained(); 
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
        Schema::dropIfExists('monitoring_records');
    }
}
