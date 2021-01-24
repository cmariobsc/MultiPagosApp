<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code', 255);
            $table->tinyInteger('completed')->default('0');
            $table->timestamp('completed_at')->nullable()->default(NULL);
            $table->timestamps();
        });
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('mensajesId');
            $table->string('nombre', 32);
            $table->string('correo', 64);
            $table->string('asunto', 250);
            $table->text('texto');
            $table->timestamps();
        });
        Schema::create('parametros', function (Blueprint $table) {
            $table->increments('parametrosId');
            $table->string('clave', 45);
            $table->string('valor', 255);
            $table->timestamps();
        });
        Schema::create('persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code', 255);
            $table->timestamps();
        });
        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code', 255);
            $table->tinyInteger('completed')->default('0');
            $table->timestamp('completed_at')->nullable()->default(NULL);
            $table->timestamps();
        });
        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255);
            $table->string('name', 255);
            $table->text('permissions')->nullable()->default(NULL);
            $table->timestamps();
        });
        Schema::table('role_users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action')->onUpdate('no action');
        });
        Schema::create('throttle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(NULL);
            $table->string('type', 255);
            $table->string('ip', 255)->nullable()->default(NULL);
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255);
            $table->string('password', 255);
            $table->text('permissions')->nullable()->default(NULL);
            $table->timestamp('last_login')->nullable()->default(NULL);
            $table->string('first_name', 255)->nullable()->default(NULL);
            $table->string('last_name', 255)->nullable()->default(NULL);
            $table->timestamps();
        });
        Schema::table('activations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('persistences', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('reminders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('role_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('throttle', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::create('vistas', function (Blueprint $table) {
            $table->increments('vistasId');
            $table->string('nombre', 30);
            $table->timestamps();
        });

        foreach ($_SESSION['idiomas'] as $idim) {
            Schema::create('vistas_cont_' . $idim, function (Blueprint $table) {
                $table->mediumInteger('contenidoId');
                $table->integer('vista_id')->unsigned();
                $table->tinyInteger('vistaSubId')->default('1');
                $table->string('titulo', 250);
                $table->text('texto');
                $table->string('imagen', 50);
                $table->string('alt', 255)->nullable()->default(NULL)->comment('Texto alternativo a la imagen');
                $table->string('explicados', 255)->nullable()->default(NULL);
                $table->timestamps();

                $table->foreign('vista_id')->references('vistasId')->on('vistas')->onDelete('cascade')->onUpdate('cascade');
            });
        }
        unset($idim);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('mensajes');
        Schema::drop('parametros');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('role_users');
        Schema::table('role_users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::drop('roles');
        Schema::drop('throttle');
        Schema::table('activations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::drop('users');
        Schema::drop('vistas');

        foreach ($_SESSION['idiomas'] as $idim) {
            Schema::table('vistas_cont_' . $idim, function (Blueprint $table) {
                $table->dropForeign(['vistaId']);
            });
            Schema::drop('vistas_cont_' . $idim);
        }
        unset($idim);
    }
}