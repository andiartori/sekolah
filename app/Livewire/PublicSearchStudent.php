<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;


class PublicSearchStudent extends Component
{
    public $nama;
    public $tanggal_lahir;
    public $student = null;

    public function search()
    {
        $this->student = Student::query()
            ->when($this->nama, function ($q) {
                $q->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($this->nama) . '%']);
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