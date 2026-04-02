<?php

namespace App\Http\Controllers;

use App\Services\CotacaoService;
use Illuminate\Http\Request;

class CotacaoController extends Controller
{
    private array $ativos = [
        "IVVB11", "BIVB39", "HASH11", "IBIT39", "BBAS3",
        "MXRF11", "CPTS11", "XPML11", "HGLG11", "JURO11",
        "CRAA11", "KNCR11", "BTLG11"
    ];

    public function index(Request $request, CotacaoService $service)
    {
        $cotacoes = $service->buscarCotacoes($this->ativos);
        $resultado = null;

        if ($request->filled('ticker')) {
            $ticker = strtoupper(trim($request->ticker));
            $resultado = $service->buscarAtivo($ticker);
        }

        return view('cotacoes.index', compact('cotacoes', 'resultado', ));
    }
}
