<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom is_active
            if (Schema::hasColumn('users', 'is_active')) {
                $table->dropColumn('is_active');
            }

            // Update enum status: tambahkan 'suspend'
            $table->enum('status', ['pending', 'approved', 'rejected', 'suspend'])
                ->default('pending')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            // Kembalikan kolom is_active jika rollback
            $table->string('is_active')->default(true);

            // Balik enum status tanpa 'suspend'
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->change();
        });
    }
};
