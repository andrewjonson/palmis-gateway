<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrIssuanceDirectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_issuance_directives', function (Blueprint $table) {
            $table->id();
            $table->string('issuance_directive_nr');
            $table->string('authority');
            $table->bigInteger('pamu_id');

            $table->foreignId('cognizant_fpao_id')
                ->constrained('rf_fpaos')
                ->onDelete('cascade');

            $table->foreignId('cognizant_fssu_id')
                ->constrained('rf_fssus')
                ->onDelete('cascade');

            $table->foreignId('servicing_fpao_id')
                ->constrained('rf_fpaos')
                ->onDelete('cascade');

            $table->date('date');

            $table->foreignId('issuance_directive_purpose_id')
                ->nullable()
                ->constrained('rf_issuance_directive_purposes')
                ->onDelete('cascade');

            $table->foreignId('issuance_directive_condition_id')
                ->nullable()
                ->constrained('rf_issuance_directive_conditions')
                ->onDelete('cascade');

            $table->foreignId('iar_id')
                ->constrained('tr_iars')
                ->onDelete('cascade');
            
            $table->string('remarks');
            $table->boolean('is_released')->default(false);
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
        Schema::dropIfExists('tr_issuance_directives');
    }
}
