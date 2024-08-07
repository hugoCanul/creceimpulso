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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->default(now());
            $table->integer('city_id');
            $table->integer('ncliente')->nullable();
            $table->integer('nCredito')->nullable();
            $table->integer('team_id');
            $table->integer('promoter_id');
            // Datos del Solicitante
            $table->string('pNombre');
            $table->string('sNombre')->nullable()->nullable();
            $table->string('aPaterno');
            $table->string('aMaterno');
            $table->string('genero');
            $table->date('fNacimiento');
            $table->string('lNacimiento');
            $table->string('pais');
            $table->string('nacionalidad');
            $table->string('tidentificaion');
            $table->string('rfc');
            $table->string('curp');
            $table->string('nIdentificacion');
            $table->string('ecivil');
            $table->string('regimen');
            $table->string('nescolar');
            $table->string('oficio');
            // Datos de ubicacion
            $table->string('dudcalle');
            $table->string('dudne');
            $table->string('dudni');
            $table->string('dudcolonia');
            $table->string('dudelegacion');
            $table->string('dudciudad');
            $table->string('dudcp');
            $table->string('dudreferencia');
            $table->string('dudusotelefono');
            $table->string('dudtelefono');
            $table->string('dudrecidencia');
            // Datos de la familia y conyugue
            $table->string('dfnombre')->nullable();
            $table->boolean('dftrtabaja')->nullable();
            $table->string('dfcocupacion')->nullable();
            $table->integer('dfchijos');
            $table->integer('dfcdeconomicos');
            // Datos situacion economica del Solicitante
            $table->string('dseactividad');
            $table->string('dseofinggresos');
            $table->integer('dseihogar');
            $table->integer('dsenphabitan');
            $table->integer('dseccvivienda');
            $table->string('desmaterial');
            // referencia familiar
            $table->string('rfNombre');
            $table->string('rfParentesco');
            $table->string('rfTelefono');
            $table->string('rfDomicilio');
            $table->string('rfcp');
            $table->string('rfOcupacion');
            $table->string('rfLTrabajo');
            // referencia Personal
            $table->string('rpNombre');
            $table->string('rpParentesco');
            $table->string('rpTelefono');
            $table->string('rpDomicilio');
            $table->string('rpcp');
            $table->string('rpOcupacion');
            $table->string('rpLTrabajo');
            // Actualmente tiene un credito vigente
            $table->string('nempresa')->nullable();
            $table->date('fechaini')->nullable();
            $table->date('fechafin')->nullable();
            $table->float('total')->nullable();
            $table->string('nempresa2')->nullable();
            $table->date('fechaini2')->nullable();
            $table->date('fechafin2')->nullable();
            $table->float('total2')->nullable();
            // informacion importante al solicitante
            $table->boolean('tfdirectivos')->nullable();
            $table->string('dNombre')->nullable();
            $table->boolean('ocupuesto')->nullable();
            $table->string('dNombre2')->nullable();
            // Observaciones
            $table->text('Observaciones')->nullable();
            $table->enum('activo',["Activo", "Inactivo"])->default("Activo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
