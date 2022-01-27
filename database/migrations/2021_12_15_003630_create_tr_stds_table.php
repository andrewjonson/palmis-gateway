<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrStdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_stds', function (Blueprint $table) {
            $table->id();
            $table->string('std_number');
            $table->string('authority');
            $table->foreignId('issuance_directive_purpose_id')->constrained('rf_issuance_directive_purposes');
            $table->date('date');
            $table->foreignId('iar_id')
                ->constrained('tr_iars')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tr_stds');
    }
}
