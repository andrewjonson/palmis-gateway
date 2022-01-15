<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfAmmunitionNomenclaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rf_ammunition_nomenclatures', function (Blueprint $table) {
            $table->id();
            $table->string('ammunition_name')->nullable();
            
            $table->foreignId('ammunition_category_id')
                ->nullable()
                ->constrained('rf_ammunition_categories')
                ->onDelete('cascade');

            $table->foreignId('ammunition_size_caliber_id')
                ->nullable()
                ->constrained('rf_ammunition_size_calibers')
                ->onDelete('cascade');

            $table->foreignId('ammunition_type_id')
                ->nullable()
                ->constrained('rf_ammunition_types')
                ->onDelete('cascade');

            $table->foreignId('ammunition_uom_id')
                ->nullable()
                ->constrained('rf_ammunition_uoms')
                ->onDelete('cascade');

            $table->foreignId('ammunition_classification_id')
                ->nullable()
                ->constrained('rf_ammunition_classifications')
                ->onDelete('cascade');

            $table->foreignId('ammunition_supply_id')
                ->nullable()
                ->constrained('rf_ammunition_supplies')
                ->onDelete('cascade');

            $table->foreignId('ammunition_detail_id')
                ->nullable()
                ->constrained('rf_ammunition_details')
                ->onDelete('cascade');

            $table->foreignId('ammunition_head_stump_marking_id')
                ->nullable()
                ->constrained('rf_ammunition_head_stump_markings')
                ->onDelete('cascade');

            $table->foreignId('ammunition_article_id')
                ->nullable()
                ->constrained('rf_ammunition_articles')
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
        Schema::dropIfExists('rf_ammunition_nomenclatures');
    }
}
