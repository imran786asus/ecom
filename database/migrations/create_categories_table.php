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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->unsignedTinyInteger('status')->comment("1: Enabled, 2: Disabled");
            $table->unsignedBigInteger('parent_id')->nullable()->default(null)->comment("ID of parent category");
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate("CASCADE")->onDelete("NO ACTION");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
