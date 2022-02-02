<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrDdasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_ddas', function (Blueprint $table) {
            $table->id();
            $table->string('depot');
            $table->date('date');
            $table->string('lot_nr');
            $table->string('packed')->nullable();
            $table->string('fsn')->nullable();
            $table->string('past_storage')->nullable();
            $table->string('current_storage')->nullable();
            $table->string('lot_received_from')->nullable();
            $table->date('date_last_inspected')->nullable();
            $table->date('date_inspected')->nullable();
            $table->string('sample_size')->nullable();
            $table->string('quantity_storage')->nullable();
            $table->string('box')->nullable();
            $table->string('straping')->nullable();
            $table->string('marking')->nullable();
            $table->string('carton')->nullable();
            $table->string('others')->nullable();
            $table->bigInteger('team_id')
                    ->nullable();
            $table->bigInteger('created_by')
                    ->nullable()
                    ->default(1);
            $table->bigInteger('updated_by')
                    ->nullable();
            $table->bigInteger('deleted_by')
                    ->nullable();
            $table->SoftDeletes();
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
        Schema::dropIfExists('tr_ddas');
    }
}
