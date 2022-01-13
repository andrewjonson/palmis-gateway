<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrSignatoryTallyInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_signatory_tally_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tally_in_id')
                ->constrained('tr_tally_ins')
                ->onDelete('cascade');
            
            $table->foreignId('signatory_id')
                ->constrained('rf_signatories')
                ->onDelete('cascade');

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
        Schema::dropIfExists('tr_signatory_tally_ins');
    }
}
