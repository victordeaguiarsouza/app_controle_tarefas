<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        
        .titulo {
            border: 1px;
            background-color: #c2c2c2;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .tabela {
            width: 100%;
        }

        table th {
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <h2 class="titulo">Lista de tarefas</h2>
            
    <table class="tabela">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tarefa</th>
                <th scope="col">Data limite conclusão</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($tarefas as $t)
                <tr>
                    <td>{{$t->id}}</td>
                    <td>{{$t->tarefa}}</td>
                    <td>{{date('d/m/Y', strtotime($t->data_limite_conclusao))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>
    <h1>Página 2</h1>
</body>
</html>