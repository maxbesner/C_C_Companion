//https://hackernoon.com/how-to-build-a-multiplayer-browser-game-4a793818c29b by @omgimanerd consulted

const socket = io();
socket.on('message', function(data){
    console.log(data);
})

alert(deck[0]);

socket.emit('new player', {name, deck});