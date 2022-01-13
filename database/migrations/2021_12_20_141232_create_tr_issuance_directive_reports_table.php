<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrIssuanceDirectiveReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_issuance_directive_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issuance_directive_id')
                ->nullable()
                ->constrained('tr_issuance_directives')
                ->onDelete('cascade');

            $table->foreignId('prepared_by_id')
                ->nullable()
                ->constrained('rf_signatories')
                ->onDelete('cascade');

            $table->foreignId('approved_by_id')
                ->nullable()
                ->constrained('rf_signatories')
                ->onDelete('cascade');

            $table->foreignId('doc_setting_id')
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
        Schema::dropIfExists('tr_issuance_directive_reports');
    }
}
