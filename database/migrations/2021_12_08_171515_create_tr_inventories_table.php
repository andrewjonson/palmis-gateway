<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_inventories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ammunition_nomenclature_id')
                ->constrained('rf_ammunition_nomenclatures')
                ->nullable()
                ->onDelete('cascade');

            $table->foreignId('tally_in_id')
                ->constrained('tr_tally_ins')
                ->nullable()
                ->onDelete('cascade');

            $table->string('lot_number');
            $table->integer('receipt_qty');
            $table->integer('quantity');
            $table->date('date_manufactured');
            $table->date('date_accepted');
            $table->double('temp_balance_qty');

            $table->foreignId('manufacturer_id')
                ->constrained('rf_manufacturers')
                ->nullable()
                ->onDelete('cascade');

            $table->foreignId('made_id') 
                ->constrained('rf_countries')
                ->nullable()
                ->onDelete('cascade');

            $table->decimal('unit_price', 9, 2)->nullable();
            $table->decimal('total_amount', 9, 2)->nullable();

            $table->foreignId('condition_id')
                ->constrained('rf_conditions')
                ->nullable()
                ->onDelete('cascade');
               
            $table->foreignId('warehouse_id')
                ->constrained('rf_warehouses')
                ->nullable()
                ->onDelete('cascade');
            
            $table->boolean('is_accepted')->default(false);

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
        Schema::dropIfExists('tr_inventories');
    }
}
