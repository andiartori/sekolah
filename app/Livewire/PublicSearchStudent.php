<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;


class PublicSearchStudent extends Component
{
    public $nama_murid;
    public $tanggal_lahir;
    public $student = null;

    public function search()
    {
        $this->student = Student::query()
            ->when($this->nama_murid, function ($q) {
                $q->whereRaw('LOWER(nama_murid) LIKE ?', ['%' . strtolower($this->nama_murid) . '%']);
            })
            ->when($this->tanggal_lahir, fn($q) => $q->where('tanggal_lahir', $this->tanggal_lahir))
            ->first();
    }


    public function render()
    {
        return view('livewire.public-search-student')
            ->layout('components.layouts.app');
    }

}