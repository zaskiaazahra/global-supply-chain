<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('shipments', function (Blueprint $table) {

        $table->id();

        $table->string('shipment_code')->unique();

        $table->string('cargo_name');

        $table->string('origin_country');

        $table->string('destination_country');

        $table->string('transport_type');

        $table->decimal('weight',8,2);

        $table->string('status');

        $table->date('departure_date');

        $table->date('estimated_arrival');

        $table->decimal('latitude',10,7)->nullable();

        $table->decimal('longitude',10,7)->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
