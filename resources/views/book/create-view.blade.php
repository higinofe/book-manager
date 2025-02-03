<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Livro') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Biografia</label>
                <textarea name="descricao" class="form-control" disabled></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estoque</label>
                <input type="number" name="quantidade_estoque" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</x-app-layout>
