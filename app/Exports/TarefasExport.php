<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{

    public function collection()
    {
        return auth()->user()->tarefas()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tarefa',
            'Data limite conclusão',
        ];
    }

    public function map($linha): array
    {
        //dd($linha);
        return [
            $linha->id,
            $linha->tarefa,
            date('d/m/Y', strtotime($linha->data_limite_conclusao)),
        ];
    }

}
