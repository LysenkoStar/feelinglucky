@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">Welcome!</h1>

        <div class="space-y-4">
            <form method="POST" action="{{ route('link.regenerate', $link->uuid) }}">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Generate New Link
                </button>
            </form>

            <form method="POST" action="{{ route('link.deactivate', $link->uuid) }}">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Deactivate Link
                </button>
            </form>

            <button id="luckyBtn" class="w-full py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                I'm Feeling Lucky
            </button>

            <button id="historyBtn" class="w-full py-2 px-4 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                History
            </button>

            <div id="result" class="mt-4 p-4 bg-gray-100 text-center rounded-lg shadow-md hidden">
                <h3 class="text-xl font-semibold">Your Lucky Result:</h3>
                <table class="min-w-full mt-4 table-auto text-center">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Number</th>
                        <th class="py-2 px-4 border-b">Result</th>
                        <th class="py-2 px-4 border-b">Win Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b" id="resultNumber"></td>
                        <td class="py-2 px-4 border-b" id="resultResult"></td>
                        <td class="py-2 px-4 border-b" id="resultWinAmount"></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div id="history" class="mt-4 p-4 bg-gray-100 text-center rounded-lg shadow-md hidden">
                <h3 class="text-xl font-semibold">Lucky History:</h3>
                <table class="min-w-full mt-4 table-auto">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b">Number</th>
                        <th class="py-2 px-4 border-b">Win</th>
                        <th class="py-2 px-4 border-b">Amount</th>
                    </tr>
                    </thead>
                    <tbody id="historyList"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('luckyBtn').onclick = function() {
            fetch('{{ route('link.lucky', $link->uuid) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('result').classList.remove('hidden');
                    document.getElementById('resultNumber').innerText = data.number;
                    document.getElementById('resultResult').innerText = data.result;
                    document.getElementById('resultWinAmount').innerText = parseFloat(data.win_amount).toFixed(2);
                });
        };

        document.getElementById('historyBtn').onclick = function() {
            fetch('{{ route('link.history', $link->uuid) }}')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('history').classList.remove('hidden');
                    const historyList = document.getElementById('historyList');
                    historyList.innerHTML = data.map(h =>
                        `<tr class="bg-white">
                            <td class="py-2 px-4 border-b">${h.number}</td>
                            <td class="py-2 px-4 border-b">${h.is_win ? 'Yes' : 'No'}</td>
                            <td class="py-2 px-4 border-b">${parseFloat(h.win_amount).toFixed(2)}</td>
                        </tr>`
                    ).join('');
                });
        };
    </script>
@endsection
