<!DOCTYPE html>
<html>
<head>
    <title>Colation - Editar Tarefa</title>
</head>
<body>
    <h1>Editar Tarefa</h1>
    <form method="POST" action="{{ route('tarefas.update', $tarefa) }}">
        @csrf
        @method('PUT')
        <input type="text" name="nome" placeholder="Nome da tarefa" value="{{ $tarefa->nome }}" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
