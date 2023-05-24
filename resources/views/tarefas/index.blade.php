<!DOCTYPE html>
<html>
<head>
    <title>Colation - Gerenciamento de Tarefas</title>
</head>
<body>
    <h1>Tarefas</h1>
    <form method="POST" action="{{ route('tarefas.store') }}">
        @csrf
        <input type="text" name="nome" placeholder="Nome da tarefa" required>
        <button type="submit">Adicionar</button>
    </form>

    <ul id="tarefas">
        @foreach($tarefas as $tarefa)
            <li draggable="true" data-tarefa-id="{{ $tarefa->id }}">
                {{ $tarefa->nome }}
                <a href="{{ route('tarefas.edit', $tarefa) }}">Editar</a>
                <form method="POST" action="{{ route('tarefas.destroy', $tarefa) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        const tarefas = document.getElementById('tarefas');
        let draggedItem = null;

        function handleDragStart(e) {
            draggedItem = e.target;
            e.dataTransfer.effectAllowed = 'move';
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function handleDrop(e) {
            e.preventDefault();
            const target = e.target.closest('li');
            if (target && draggedItem !== target) {
                const tarefaId = draggedItem.dataset.tarefaId;
                const targetId = target.dataset.tarefaId;
                const formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('tarefa', tarefaId);
                formData.append('target', targetId);

                fetch('{{ route('tarefas.update', '') }}/' + tarefaId, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const clone = draggedItem.cloneNode(true);
                        target.parentNode.replaceChild(clone, target);
                        draggedItem.parentNode.replaceChild(target, draggedItem);
                    }
                });
            }
        }

        const items = document.querySelectorAll('li');
        items.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragover', handleDragOver);
            item.addEventListener('drop', handleDrop);
        });
    </script>
</body>
</html>
