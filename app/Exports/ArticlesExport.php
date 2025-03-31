<?php

namespace App\Exports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticlesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Article::select('id', 'title', 'content', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Título', 'Contenido', 'Fecha de Creación'];
    }
}
