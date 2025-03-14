<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con el Técnico</title>
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">

</head>
<body>
    <div class="chat-container">
        @foreach($chats as $chat)
            <div class="message {{ $chat->user_id == Auth::id() ? 'user' : 'tecnico' }}">
                {{ $chat->message }}
            </div>
        @endforeach
    </div>
    <div class="input-container">
        <form action="{{ route('incidencias.sendMessage', $incidencia->id) }}" method="POST">
            @csrf
            <input type="text" name="message" placeholder="Escribe tu mensaje..." required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>