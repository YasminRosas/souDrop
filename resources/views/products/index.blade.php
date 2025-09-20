@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Meus Produtos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-success">Adicionar Produto</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Cor: {{ $product->color }}</h6>
                    <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                    <p class="card-text"><strong>Valor: R$ {{ number_format($product->price, 2, ',', '.') }}</strong></p>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">Detalhes</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<hr class="my-5">

<div class="card">
    <div class="card-header">
        Assistente Virtual (Groq)
    </div>
    <div class="card-body">
        <div id="chat-box" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            </div>
        <div class="input-group">
            <input type="text" id="chat-input" class="form-control" placeholder="Pergunte sobre seus produtos...">
            <button class="btn btn-primary" type="button" id="chat-send">Enviar</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
    document.getElementById('chat-send').addEventListener('click', async () => {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        if (!message) return;

        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML += `<p><strong>Você:</strong> ${message}</p>`;
        input.value = '';
        
        try {
            const response = await fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message: message })
            });
            const data = await response.json();
            chatBox.innerHTML += `<p><strong>Assistente:</strong> ${data.response}</p>`;
        } catch (error) {
            chatBox.innerHTML += `<p class="text-danger">Erro ao se comunicar com o assistente.</p>`;
            console.error('Erro:', error);
        }
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>
@endpush