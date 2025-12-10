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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->text('deskripsi_singkat');
            $table->string('nama');
            $table->string('no_hp', 15);
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('nama_kelurahan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('no_ktp', 16)->unique();
            $table->string('foto');
            $table->string('foto_ktp');
            $table->string('password');
            $table->enum('role', ['admin', 'seller'])->default('seller');
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspend'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->string('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->index('email');
            $table->index('no_ktp');
            $table->index('status');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
