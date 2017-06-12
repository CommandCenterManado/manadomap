var app = require("express")();
var server = require("http").Server(app);
var io = require("socket.io")(server);
var bodyParser = require("body-parser");

const PORT = 7001;

var clients = [];
var ticketUntukInspeksi = [];

server.listen(PORT);

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended: true,
    limit: "100mb"
}));

app.use(function (req, res, next) {

    res.setHeader('Access-Control-Allow-Origin', 'http://localhost');

    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

    res.setHeader('Access-Control-Allow-Credentials', true);

    next();
});

app.get("/", function (req, res) {

    res.send("Jalan...");

});


app.get("/debug", function (req, res) {
    io.emit("debug", { msg: "Peler alelll" });
    res.send("OK");
});


io.on("connection", function (socket) {
    var clientId = socket.id;

    console.log("Array socket[] dari socket.io : ", Object.keys(io.sockets.connected));

    socket.on("join", function (userdata, callback) {


        if (userdata.idpengguna != undefined) {

            if (userdata.clientId == undefined) {
                userdata.socketId = clientId;
                callback(userdata);
                delete (userdata.sess_publik);
                join(userdata);
                console.log("Client terhubung dengan nama : " + userdata.nama_lengkap);
                console.log("Jumlah client : " + clients.length);
                console.log(clientId);
            } else {
                callback(userdata);
            }

        }
        console.log("Console pas - Join : Array socket[] dari socket.io : ", Object.keys(io.sockets.connected));
        console.log("Console pas - Join : Array clients[] dari frontend : ", clients);


    });

    socket.on("leave", function (userdata) {

        console.log("Console pas - leave : Putus : ", clientId);
        console.log("Console pas - leave : Array socket[] dari socket.io : ", Object.keys(io.sockets.connected));
        console.log("Console pas - leave : Array clients[] dari frontend : ", clients);
        kick(clientId);


    });


    app.post("/trigger_laporan", function (req, res) {

        var bodyPost = req.body;

        clients.forEach(function (client, index) {

            if (client.super != 1 && client.bagian != 'walikota' && client.bagian != 'ccenter') {

                if (client.idkecamatan == bodyPost.idkecamatan || client.idkelurahan == bodyPost.idkelurahan || client.idkategori_laporan == bodyPost.idkategori_laporan)
                    if (io.sockets.connected[client.socketId])
                        io.sockets.connected[client.socketId].emit("laporan", bodyPost);

            } else {
                if (io.sockets.connected[client.socketId])
                    io.sockets.connected[client.socketId].emit("laporan", bodyPost);
            }

            console.log("Ternotifikasi : " + client.nama_lengkap);

        });

        res.send("OK");

    });

    socket.on("disconnect", function () {
        clients.forEach(function (item, index) {

            if (clientId == item.socketId)
                clients.splice(index, 1);

        });

        socket.disconnect();

    })

});

io.on("disconnect", function () {
    console.log("Ta disconnect");
});


function join(userdata) {
    clients.push(userdata);
}

function kick(clientId) {
    clients.forEach(function (item, index) {

        if (clientId == item.socketId)
            clients.splice(index, 1);

    });
}


console.log("\n\n" +
    "===================================================\n" +
    "Lapor Manado Node.js server v1\n" +
    "===================================================\n" +
    "Running port : " + PORT + "\n" +
    "Waktu sekarang : " + new Date().getHours() + ":" + new Date().getMinutes() + "\n" +
    "Github page : https://github.com/ilomon10/laporan/\n" +
    "===================================================");