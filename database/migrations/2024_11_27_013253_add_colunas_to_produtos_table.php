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
        Schema::table('produtos', function (Blueprint $table) {
            $table->longText('informacoes_produto')->nullable()->after('imagem_capa');
            $table->boolean('cores')->default(false)->after('informacoes_produto');
            $table->boolean('tamanhos')->default(false)->after('cores');
            $table->boolean('numeracao')->default(false)->after('tamanhos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('informacoes_produto');
            $table->dropColumn('cores');
            $table->dropColumn('tamanhos');
            $table->dropColumn('numeracao');
        });
    }
};
