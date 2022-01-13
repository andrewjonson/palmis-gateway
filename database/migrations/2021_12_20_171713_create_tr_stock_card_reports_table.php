<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrStockCardReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_stock_card_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_card_id')
                    ->constrained('tr_stock_cards')
                    ->onDelete('cascade');

            $table->foreignId('received_from_id')
                    ->constrained('rf_signatories')
                    ->onDelete('cascade');

            $table->foreignId('received_by_id')
                    ->constrained('rf_signatories')
                    ->onDelete('cascade');

            $table->foreignId('doc_setting_id')
                    ->constrained('rf_doc_settings')
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
        Schema::dropIfExists('tr_stock_card_reports');
    }
}
