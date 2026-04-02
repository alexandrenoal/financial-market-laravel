<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cotações
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Formulário de busca --}}
            <form method="GET" action="{{ route('cotacoes.index') }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="ticker" placeholder="Ex: HASH11"
                        value="{{ request('ticker') }}"
                        class="border rounded px-3 py-2 w-48" required>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Consultar
                    </button>
                </div>
            </form>

            {{-- Resultado da busca --}}
            @if (request('ticker'))
                @if ($resultado)
                    <div class="bg-white rounded shadow p-4 mb-6">
                        <h5 class="font-bold text-lg mb-2">{{ $resultado['symbol'] }}</h5>
                        <p>Preço Atual: <strong>R$ {{ number_format($resultado['regularMarketPrice'], 2, ',', '.') }}</strong></p>
                        <p>Variação:
                            <strong style="color: {{ $resultado['regularMarketChangePercent'] >= 0 ? 'green' : 'red' }}">
                                {{ number_format($resultado['regularMarketChangePercent'], 2, ',', '.') }}%
                            </strong>
                        </p>

                        {{-- Gráfico TradingView --}}
                        <div id="tradingview_chart" style="height: 400px; margin-top: 20px;"></div>
                        <script src="https://s3.tradingview.com/tv.js"></script>
                        <script>
                            new TradingView.widget({
                                autosize: true,
                                symbol: "BMFBOVESPA:{{ strtoupper(request('ticker')) }}",
                                interval: "D",
                                timezone: "America/Sao_Paulo",
                                theme: "light",
                                style: "1",
                                locale: "br",
                                enable_publishing: false,
                                allow_symbol_change: true,
                                container_id: "tradingview_chart"
                            });
                        </script>
                    </div>
                @else
                    <p class="text-red-500 mb-4">Ativo não encontrado. Verifique o código e tente novamente.</p>
                @endif
            @endif

            {{-- Tabela de cotações --}}
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Ticker</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Preço</th>
                            <th class="px-4 py-2 text-left">Variação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotacoes as $ativo)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $ativo['symbol'] }}</td>
                            <td class="px-4 py-2">{{ $ativo['shortName'] }}</td>
                            <td class="px-4 py-2">R$ {{ number_format($ativo['regularMarketPrice'], 2, ',', '.') }}</td>
                            <td class="px-4 py-2"
                                style="color: {{ $ativo['regularMarketChangePercent'] >= 0 ? 'green' : 'red' }}">
                                {{ number_format($ativo['regularMarketChangePercent'], 2, ',', '.') }}%
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
