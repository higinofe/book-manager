<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Livro') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $book->titulo) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Biografia</label>
                <textarea name="descricao" class="form-control" disabled>{{ old('descricao', $book->descricao) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" value="{{ old('autor', $book->autor) }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco', $book->preco) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantidade em Estoque</label>
                <input type="number" name="quantidade_estoque" class="form-control" value="{{ old('quantidade_estoque', $book->quantidade_estoque) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>
    </div>
</x-app-layout>
