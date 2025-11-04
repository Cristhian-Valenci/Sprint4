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
       Schema::create('cocktails', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 100);
    $table->longText('descripcion');
    $table->longText('metodo_elaboracion');
    $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // se conecta a la tabla users y si se borra el ususario se borran sus cocteles
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocktails');
    }
};
