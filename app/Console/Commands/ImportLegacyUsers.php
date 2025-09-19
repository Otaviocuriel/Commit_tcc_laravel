<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ImportLegacyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'legacy:import-users {--dry : Simula sem inserir}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa dados das tabelas cadastro e cadastro_empresa para users';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dry = $this->option('dry');
        $this->info('Iniciando importação'.($dry ? ' (MODO DRY RUN)' : ''));

        $usersImported = 0;
        $companiesImported = 0;

        if (!DB::getSchemaBuilder()->hasTable('cadastro') || !DB::getSchemaBuilder()->hasTable('cadastro_empresa')) {
            $this->error('Tabelas legacy não encontradas. Abortando.');
            return self::FAILURE;
        }

        // Import usuários (pessoa)
        $legacyUsers = DB::table('cadastro')->get();
        foreach ($legacyUsers as $lu) {
            $email = $lu->email;
            if (User::where('email',$email)->exists()) {
                $this->line("[SKIP] Email já existe (user): $email");
                continue;
            }
            $data = [
                'role' => 'user',
                'name' => $lu->nome,
                'email' => $email,
                'password' => $lu->senha ?? Hash::make('SenhaTemp123!'), // já vem hash
                'cpf' => $lu->cpf,
                'data_nascimento' => $lu->data_nascimento ?: null,
                'telefone' => $lu->telefone ? (string)$lu->telefone : null,
                'cep' => $lu->cep,
            ];
            if (!$dry) {
                User::create($data);
            }
            $usersImported++;
        }

        // Import empresas
        $legacyCompanies = DB::table('cadastro_empresa')->get();
        foreach ($legacyCompanies as $lc) {
            $email = $lc->email_empresarial;
            if (User::where('email',$email)->exists()) {
                $this->line("[SKIP] Email já existe (company): $email");
                continue;
            }
            $data = [
                'role' => 'company',
                'name' => $lc->nome_empresa,
                'email' => $email,
                'password' => $lc->senha ?? Hash::make('SenhaTemp123!'),
                'cnpj' => preg_replace('/\D/','',$lc->cnpj),
                'cargo' => $lc->cargo,
                'telefone' => preg_replace('/\D/','',$lc->telefone),
                'cep' => preg_replace('/\D/','',$lc->cep),
            ];
            if (!$dry) {
                User::create($data);
            }
            $companiesImported++;
        }

        $this->info("Importação concluída: users={$usersImported}, companies={$companiesImported}".($dry ? ' (simulado)' : ''));
        return self::SUCCESS;
    }
}
