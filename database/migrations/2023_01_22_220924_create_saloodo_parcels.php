<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaloodoParcels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saloodo_parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('saloodo_users')->onDelete('set null');
            $table->foreignId('biker_id')->nullable()->constrained('saloodo_users')->onDelete('set null');
            $table->text('address_from');
            $table->text('address_to');
            $table->tinyInteger('status')->comment('0=pending, 1=picked, 2=delivered')->default(0);
            $table->timestamp('picked_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
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
        Schema::dropIfExists('saloodo_parcels');
    }
}
