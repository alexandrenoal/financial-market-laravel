<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CotacaoService
{
    private string $token = "ik2fd2kcoDtJ3an4mVTWNy";

    public function buscarCotacoes(array $ativos): array
    {
        $resultados = [];
        foreach ($ativos as $ticker) {
            $response = Http::get("https://brapi.dev/api/quote/{$ticker}", [
                'token' => $this->token
            ]);
            if ($response->ok()) {
                $dados = $response->json();
                if (isset($dados['results'][0])) {
                    $resultados[] = $dados['results'][0];
                }
            }
        }
        return $resultados;
    }

    public function buscarAtivo(string $ticker): ?array
    {
        $response = Http::get("https://brapi.dev/api/quote/{$ticker}", [
            'token' => $this->token
        ]);
        if ($response->ok()) {
            $dados = $response->json();
            return $dados['results'][0] ?? null;
        }
        return null;
    }
}
