<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTallyInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_tally_ins', function (Blueprint $table) {
            $table->id();
            $table->string('tally_in_nr')->unique();
            $table->date('tally_in_date');

            $table->foreignId('supplier_id')
                ->constrained('rf_suppliers')
                ->onDelete('cascade');
            
            $table->string('supplier_name');
            $table->string('supplier_designation');
            

            $table->boolean('is_iar')->default(false);
            
            $table->enum('stock_disposition',[
                'PA',
                'CMI',
                'PAF',
                'PN'
            ])->default('PA');
            
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
        Schema::dropIfExists('tr_tally_ins');
    }
}
