<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 255);
            $table->text('query_request')->nullable();
            $table->string('query_type', 255)->default('general');
            $table->string('transaction_id')->nullable();
            $table->string('url', 255);
            $table->string('method', 255);
            $table->string('ip', 255);
            $table->string('agent', 255)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('audit_trails');
    }
}
