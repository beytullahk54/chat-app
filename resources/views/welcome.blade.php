<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div id="app">
        <chat-messages :messages="messages"></chat-messages>
        <chat-form @send="addMessage"></chat-form>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
