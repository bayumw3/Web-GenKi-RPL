<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataListriksTable extends Migration
{
    public function up()
    {
        Schema::create('data_listriks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(); // stores the date
            $table->time('time')->nullable(); // stores the time
            $table->string('daya_listrik')->nullable(); // stores the daya listrik (electricity data)
            $table->enum('status', ['Updated', 'Not Updated'])->default('Not Updated'); // stores the status
            $table->timestamps(); // stores created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_listriks');
    }
}
