<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfUserWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rf_user_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('pmcode')->unique();
            
            $table->foreignId('warehouse_id')
                ->nullable()
                ->constrained('rf_warehouses')
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
        Schema::dropIfExists('rf_user_warehouses');
    }
}
