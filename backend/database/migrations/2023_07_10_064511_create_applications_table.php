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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained('records')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('record_type'); // enum: 0 = 出勤 (WORK_IN), 1 = 退勤 (WORK_OUT), 2 = 休憩開始 (BREAK_IN), 3 = 休憩終了 (BREAK_OUT)
            $table->date('date');
            $table->time('time');
            $table->text('comment');
            $table->integer('is_accepted'); // enum: 0 = 差戻し, 1 = 承認, 2 = 申請中
            $table->foreignId('staff_id')->constrained('staff'); // 申請を確認した運営
            $table->timestamps();
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
        Schema::dropIfExists('requests');
    }
};
