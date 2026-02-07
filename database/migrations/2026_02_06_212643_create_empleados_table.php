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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->string('departamento', 100);
            $table->string('email', 255);
            $table->string('telefono', 20);
            $table->boolean('estado')->default(1)->comment('1: Activo, 0: Inactivo');

            // Auditoría
            $table->timestamp('fe_creacion')->useCurrent();
            $table->string('usr_creacion', 100);
            $table->timestamp('fe_ult_mod')->nullable()->useCurrentOnUpdate();
            $table->string('usr_ult_mod', 100)->nullable();

        });

        Schema::create('qr_empleados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('empleado_id')->constrained('empleados');
            $table->string('qr_imagen', 500)->comment('Ruta o URL de la imagen QR');
            $table->boolean('estado')->default(1)->comment('1: Activo, 0: Inactivo');

            // Auditoría
            $table->timestamp('fe_creacion')->useCurrent();
            $table->string('usr_creacion', 100);
            $table->timestamp('fe_ult_mod')->nullable()->useCurrentOnUpdate();
            $table->string('usr_ult_mod', 100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr_empleados');
        Schema::dropIfExists('empleados');
    }
};
