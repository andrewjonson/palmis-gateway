<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrRisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_ris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issuance_directive_id')
                ->nullable()
                ->constrained('tr_issuance_directives')
                ->onDelete('cascade');
            $table->foreignId('std_id')
                ->nullable()
                ->constrained('tr_stds')
                ->onDelete('cascade');
            $table->string('ris_nr');
            $table->boolean('status')->default(false);                                                                                                                 
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
        Schema::dropIfExists('tr_ris');
    }
}
