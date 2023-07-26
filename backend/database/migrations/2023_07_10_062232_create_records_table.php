<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('mentors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('record_type'); // enum: 0 = 出勤 (WORK_IN), 1 = 退勤 (WORK_OUT), 2 = 休憩開始 (BREAK_IN), 3 = 休憩終了 (BREAK_OUT)
            $table->boolean('is_remote');
            $table->date('date');
            $table->time('time');
            $table->boolean('error');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};
