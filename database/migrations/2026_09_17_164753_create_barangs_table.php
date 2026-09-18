<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 30)->unique();
            $table->string('nama_barang', 150);
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->integer('stok')->default(0);
            $table->string('satuan', 30)->default('Pcs');
            $table->unsignedBigInteger('harga_satuan')->default(0);
            $table->string('lokasi_penyimpanan', 100)->nullable();
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Perlu Perbaikan'])->default('Baik');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
