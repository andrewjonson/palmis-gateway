<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTallyOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_tally_out', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issuance_directive_item_id')
                ->constrained('tr_issuance_directive_items')
                ->onDelete('cascade');
                
            $table->foreignId('ris_id')
                    ->constrained('tr_ris')
                    ->onDelete('cascade');

            $table->boolean('unservisable');
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
        Schema::dropIfExists('tr_tally_out');
    }
}
