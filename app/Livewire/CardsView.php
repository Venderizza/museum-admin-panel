<?php

namespace App\Livewire;

use App\Models\Exhibit;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CardsView extends Component
{
    public array $messages = [];

    public string $searchQuery = '';

    public $cards;

    public function mount(): void
    {
        $this->loadCards();
    }

    public function loadCards(): void
    {
        $this->cards = Exhibit::with('photos')->get();
    }

    public function search(): void
    {
        if (! filled($this->searchQuery)) {
            return;
        }

        $query = $this->searchQuery;

        // сообщение пользователя
        $this->messages[] = [
            'type' => 'user',
            'text' => $query,
        ];

        $this->searchQuery = '';

        // $response = Http::get(
        //     config('services.search.url'),
        //     [
        //         'message' => $query,
        //     ]
        // );

        // if (! $response->successful()) {
        //     $this->messages[] = [
        //         'type' => 'bot',
        //         'text' => 'Ошибка поиска',
        //     ];

        //     return;
        // }

        // $data = $response->json();

        // тестовое
        $exhibits = Exhibit::query()
            ->where('description', 'like', '%' . $query . '%')
            ->get();

        $ids = $exhibits->pluck('id')->values()->all();

        $response = [
            'text' => $this->buildResponseText($query, $exhibits),
            'id_list' => $ids,
        ];

        $this->messages[] = [
            'type' => 'bot',
            'text' => $response['text'],
        ];

        // ответ бота
        // $this->messages[] = [
        //     'type' => 'bot',
        //     'text' => $data['text'] ?? '',
        // ];

        // $ids = $data['id_list'] ?? [];

        if (empty($ids)) {
            $this->cards = collect();
            return;
        }

        $this->cards = Exhibit::query()
            ->with('photos')
            ->whereIn('id', $ids)
            ->orderByRaw('FIELD(id, ' . implode(',', $ids) . ')')
            ->get();

        // $this->cards = Exhibit::query()
        //     ->with('photos')
        //     ->whereIn('id', $ids)
        //     ->orderByRaw('FIELD(id, ' . implode(',', $ids) . ')')
        //     ->get();
    }

    private function buildResponseText(string $query, $exhibits): string
    {
        if ($exhibits->isEmpty()) {
            return "По запросу '{$query}' ничего не найдено.";
        }

        return "Найдено экспонатов: " . $exhibits->count();
    }

    public function render()
    {
        return view('livewire.cards-view');
    }
}