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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagihan_id')->constrained('tagihans')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('rekening_id')->constrained('rekenings')->onDelete('cascade');
            $table->decimal('jumlah_dibayar', 10, 2);
            $table->date('tanggal_bayar');
            $table->string('nama_rekening_pengirim')->nullable();
            $table->string('no_rekening_pengirim')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
