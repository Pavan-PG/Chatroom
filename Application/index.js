var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
var mysql = require('mysql');
var crypto = require('crypto');
// console.log(dict);

var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'users',
})

var con2 = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password : '',
    database: 'phpfile',
})
connection.connect(function (err) {
    if (err) throw err
    console.log('You are now connected to database...')
})

con2.connect(function(err){
    if(err) throw err
    console.log('Connected to db2!');
})


users = [];
connections = [];
MAXUSERS = 3;

server.listen(3300, function () {
    console.log('Server listening on 3300...')
});

app.use(express.static('public'));

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});


io.on('connection', doAction);

function doAction(socket) {
    // connection 

    connections.push(socket);
    console.log('Connected %s sockets', connections.length);

    // sockets.emit('add user',{data: name});

    //disconnection

    socket.on('disconnect', function () {
        users.splice(users.indexOf(socket.username), 1);
        updateuser();
        connections.splice(connections.indexOf(socket), 1);
        console.log('1 Socket Disconnected. Total connections %s', connections.length);


    });
    socket.on('send message', function (data, username, avatar, num, fn) {
        // dict.forEach(ele => {
        //     if(ele==data)
        //     {
        //         console.log(ele);
        //         console.log(data[ele]);
        //         data=dict[ele];

        //     }
        // });
        // console.log(dict);
        num = users.length;
        fn(num);
        io.sockets.emit('server message', {
            msg: data,
            sender: username,
            avatar: avatar
        });
    });
    socket.on('SendImage', function (data, username, avatar, num, fn) {
        num = users.length;
        fn(num);
        io.sockets.emit('server_image_send', {
            msg: data,
            sender: username,
            avatar: avatar
        });
    });
    socket.on('URLy', function (data, username, avatar, num, fn) {
        num = users.length;
        fn(num);
        io.sockets.emit('server_url_send', {
            msg: data,
            sender: username,
            avatar: avatar
        });
    });


    socket.on('user_login', function (name, pass, fn) {
        var login = false;
        console.log(users.length);
        console.log(users);
        if (users.length >= MAXUSERS) {
            console.log('max ');
            restrict('Our bandwidth is currently full, please wait until users log out!!');
        }
        else {
            for (var i = 0; i < users.length; i++) {
                if (name === users[i]) {
                    console.log('jeygfkiygfiygffffffff');
                    fn(false);
                    login = true;
                    restrict('Already in session');
                }
            }
            if(!login){
            var key = crypto.createCipher('aes-128-cbc', name);
            var encryptedpassword = key.update(pass, 'utf8', 'hex') + key.final('hex');
            var flag = 1;
            connection.query('SELECT * FROM userinfo', function (err, results) {
                if (err) {
                    fn(false);
                }
                console.log('Data received from Db:\n');
                // console.log(rows);
                // for(var i=0;i<users.length;i++){
                //     if(name === users[i])
                //         flag=1;
                // }
                // if (flag) {
                //     fn(false);
                // }
                for (var i = 0; i < results.length; i++) {
                    if ((name == results[i].name) && (encryptedpassword == results[i].password)) {
                        flag = 0;
                        console.log("Record found!");
                        socket.username = name;
                        users.push(socket.username);
                        updateuser();
                        fn(true);
                        break;
                    }
                }
                if (flag) {
                    fn(false);
                }
            });
        }
        }

    });

    socket.on('newdb user', function (name, pass,email, fn) {
        //fn(true);
        var pattern = /[A-Za-z]/;
        var test = pattern.test(name);
        console.log(test);
        if (!test) {
            restrictreg();
        }
        else {
            var key = crypto.createCipher('aes-128-cbc', name);
            var encryptedpassword = key.update(pass, 'utf8', 'hex') + key.final('hex');
            var flag = 1;
            var dkey = crypto.createDecipher('aes-128-cbc',name);
            var decryptedpassword = dkey.update(encryptedpassword, 'hex', 'utf8') + dkey.final('utf8');
            connection.query('SELECT * FROM userinfo', function (err, results) {
                if (err) {
                    fn(false);
                };
                console.log('Data received from Db:\n');
                // console.log(rows);
                for (var i = 0; i < results.length; i++) {
                    if ((name == results[i].name) & (encryptedpassword == results[i].pass)) {
                        console.log("Duplicate entry found");
                        flag = 0;
                        fn(false);
                    }
                }
                if (flag) {
                    console.log(encryptedpassword);
                    connection.query('Insert into userinfo values(?,?,?)', [name, encryptedpassword,email], function (err, results) {
                        if (err) {
                            fn(false);
                        } else
                            fn(true);
                    });
                    con2.query('Insert into info values(?,?,?)',[decryptedpassword,email,name],function(err,results){
                        if(err) throw err
                    });
                }

            });
        }
    });

    function updateuser() {
        io.sockets.emit('get users', users);
        // console.log(users)
    }
    function restrict(msg) {
        io.sockets.emit('restrict', data = msg);
    }

    function restrictreg() {
        io.sockets.emit('restrictReg', data = 'Please give a proper username');
    }
}
