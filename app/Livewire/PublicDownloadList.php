<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Download;

class PublicDownloadList extends Component
{
    public $search = '';

    public function render()
    {
        $downloads = Download::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->whereRaw('LOWER(materi_download) LIKE ?', ['%' . strtolower($this->search) . '%'])
            )
            ->orderBy('materi_download')
            ->get();

        return view('livewire.public-download-list', [
            'downloads' => $downloads,
        ])->layout('components.layouts.app'); // same layout you used
    }
}
