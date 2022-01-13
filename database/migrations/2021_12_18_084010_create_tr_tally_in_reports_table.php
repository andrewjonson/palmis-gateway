<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTallyInReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_tally_in_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tally_in_id')
                ->nullable()
                ->constrained('tr_tally_ins')
                ->onDelete('cascade');

            $table->foreignId('received_by_signatory_id')
                ->nullable()
                ->constrained('rf_signatories')
                ->onDelete('cascade');
            
            $table->foreignId('noted_by_signatory_id')
                ->nullable()
                ->constrained('rf_signatories')
                ->onDelete('cascade');

            $table->foreignId('doc_settings_id')
                ->nullable()
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
        Schema::dropIfExists('tr_tally_in_reports');
    }
}
