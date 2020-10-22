//https://hackernoon.com/how-to-build-a-multiplayer-browser-game-4a793818c29b by @omgimanerd consulted

const express = require('express');
const http = require('http');
const path = require ('path');
const socketIO = require('socket.io');

const app = express();
const server = http.Server(app);
const io = socketIO(server);

app.set('port', 5000);
app.use('/static', express.static(__dirname + '/static'));

app.get('/', function (request, reponse){
    reponse.sendFile(path.join(__dirname, 'game.php'));
})

server.listen(5000, function(){
    console.log('Starting server on port 5000');
});

let players = {};
io.on('connection', function(socket){
    socket.on('new player', function(data){
        players[socket.id] = {
            name: data[0],
            deck: data[1],
            hand: {},
            discard: {},
            enchantments: {boons: {}, afflictions: {}}
        };
    });
});

setInterval(function(){
    io.sockets.emit('state', 'players');
}, 1000 / 10);