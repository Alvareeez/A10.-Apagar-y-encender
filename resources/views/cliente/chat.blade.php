<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con el Técnico</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .chat-container {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.user {
            background-color: #87CEEB;
            color: #fff;
            align-self: flex-end;
        }
        .message.tecnico {
            background-color: #ccc;
            color: #000;
            align-self: flex-start;
        }
        .input-container {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
        }
        .input-container input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        .input-container button {
            padding: 10px;
            background-color: #87CEEB;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .input-container button:hover {
            background-color: #00BFFF;
        }
    </style>
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