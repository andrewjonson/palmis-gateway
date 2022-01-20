<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrStdItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_std_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('std_id')->constrained('tr_stds');
            $table->foreignId('cognizant_fpao_id')->constrained('rf_fpaos');
            $table->foreignId('receiving_fpao_id')->constrained('rf_fpaos');
            $table->foreignId('cognizant_fssu_id')->constrained('rf_fssus');
            $table->foreignId('receiving_fssu_id')->constrained('rf_fssus');
            $table->foreignId('inventory_id')->constrained('tr_inventories');
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
        Schema::dropIfExists('tr_std_items');
    }
}
