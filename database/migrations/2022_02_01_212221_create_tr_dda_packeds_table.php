<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrDdaPackedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_dda_packeds', function (Blueprint $table) {
            $table->id();
            $table->string('condition_ammunition_item')->nullable();
            $table->enum('packed_type', [
                'Outer Packed',
                'Inner Packed',
                'Complete Packed'
            ])->nullable();
            $table->foreignId('dda_id')->nullable()->constrained('tr_ddas');
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
        Schema::dropIfExists('tr_dda_packeds');
    }
}
