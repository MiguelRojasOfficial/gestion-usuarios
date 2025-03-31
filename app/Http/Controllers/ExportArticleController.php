<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticlesExport;

class ExportArticleController extends Controller
{
    public function exportExcel() 
    {
        return Excel::download(new ArticlesExport, 'articulos.xlsx');
    }

    public function exportPDF() 
    {
        $articles = Article::all();
        $pdf = PDF::loadView('articles.pdf', compact('articles'));
        return $pdf->download('articulos.pdf');
    }
}
