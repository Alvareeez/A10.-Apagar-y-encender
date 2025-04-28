<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\Seu;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Roles
        $adminRole = Rol::where('roles', 'Administrador')->first()->id;
        $clienteRole = Rol::where('roles', 'Cliente')->first()->id;
        $gestorRole = Rol::where('roles', 'Gestor de Equipo')->first()->id;
        $tecnicoRole = Rol::where('roles', 'Técnico de Mantenimiento')->first()->id;

        // Sedes
        $barcelona = Seu::where('seus', 'Barcelona')->first()->id; // Corregido: 'seus' en lugar de 'seu'
        $berlin = Seu::where('seus', 'Berlín')->first()->id;       // Corregido: 'seus' en lugar de 'seu'
        $montreal = Seu::where('seus', 'Montreal')->first()->id;   // Corregido: 'seus' en lugar de 'seu'

        // Usuarios
        $users = [
            // Administrador
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'role' => $adminRole, 'seu' => $barcelona],

            // Gestores de Equipo
            ['name' => 'Gestor Barcelona', 'email' => 'gestor.barcelona@example.com', 'password' => bcrypt('password'), 'role' => $gestorRole, 'seu' => $barcelona],
            ['name' => 'Gestor Berlín', 'email' => 'gestor.berlin@example.com', 'password' => bcrypt('password'), 'role' => $gestorRole, 'seu' => $berlin],
            ['name' => 'Gestor Montreal', 'email' => 'gestor.montreal@example.com', 'password' => bcrypt('password'), 'role' => $gestorRole, 'seu' => $montreal],

            // Clientes
            ['name' => 'Cliente Barcelona', 'email' => 'cliente.barcelona@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $barcelona],
            ['name' => 'Cliente Barcelona 2', 'email' => 'cliente.barcelona2@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $barcelona],
            ['name' => 'Cliente Barcelona 3', 'email' => 'cliente.barcelona3@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $barcelona],
            ['name' => 'Cliente Berlín', 'email' => 'cliente.berlin@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $berlin],
            ['name' => 'Cliente Berlín 2', 'email' => 'cliente.berlin2@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $berlin],
            ['name' => 'Cliente Berlín 3', 'email' => 'cliente.berlin3@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $berlin],
            ['name' => 'Cliente Montreal', 'email' => 'cliente.montreal@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $montreal],
            ['name' => 'Cliente Montreal 2', 'email' => 'cliente.montreal2@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $montreal],
            ['name' => 'Cliente Montreal 3', 'email' => 'cliente.montreal3@example.com', 'password' => bcrypt('password'), 'role' => $clienteRole, 'seu' => $montreal],

            // Técnicos
            ['name' => 'Técnico Barcelona', 'email' => 'tecnico.barcelona@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $barcelona],
            ['name' => 'Técnico Barcelona 2', 'email' => 'tecnico.barcelona2@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $barcelona],
            ['name' => 'Técnico Barcelona 3', 'email' => 'tecnico.barcelona3@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $barcelona],

            ['name' => 'Técnico Berlín', 'email' => 'tecnico.berlin@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $berlin],
            ['name' => 'Técnico Berlín 2', 'email' => 'tecnico.berlin2@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $berlin],
            ['name' => 'Técnico Berlín 3', 'email' => 'tecnico.berlin3@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $berlin],

            ['name' => 'Técnico Montreal', 'email' => 'tecnico.montreal@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $montreal],
            ['name' => 'Técnico Montreal 2', 'email' => 'tecnico.montreal2@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $montreal],
            ['name' => 'Técnico Montreal 3', 'email' => 'tecnico.montreal3@example.com', 'password' => bcrypt('password'), 'role' => $tecnicoRole, 'seu' => $montreal],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}