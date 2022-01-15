<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrIarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_iars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tally_in_id')
                ->nullable()
                ->constrained('tr_tally_ins')
                ->onDelete('cascade');

            $table->string('iar_nr')->unique();
            $table->string('entity_name');
            $table->date('date');
            $table->string('po_nr');
            
            $table->foreignId('fund_cluster_id')
                ->nullable()
                ->constrained('rf_fund_clusters')
                ->onDelete('cascade');

            $table->string('invoice_nr');
            $table->date('invoice_date');
            
            $table->foreignId('requisitioning_office_id')
                ->nullable()
                ->constrained('rf_offices')
                ->onDelete('cascade');
            
            $table->foreignId('responsibility_center_code_id')
                ->nullable()
                ->constrained('rf_responsibility_codes')
                ->onDelete('cascade');

            $table->string('accountable_officer');
            $table->string('officer_designation');

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
        Schema::dropIfExists('tr_iars');
    }
}
