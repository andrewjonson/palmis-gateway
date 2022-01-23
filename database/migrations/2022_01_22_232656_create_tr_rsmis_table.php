<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrRsmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_rsmis', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->date('date');
            $table->foreignId('ris_id')->constrained('tr_ris');
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
        Schema::dropIfExists('tr_rsmis');
    }
}
