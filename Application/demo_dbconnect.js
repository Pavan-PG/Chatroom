var mysql = require('mysql')
var connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'users',
})
var name = 'dummy';
var pass = '2121';
connection.connect(function (err) {
  if (err) throw err
  console.log('You are now connected to database...')
})
connection.query('SELECT * FROM userinfo', function (err, results) {
  console.log(results.length);
  for (var i = 0; i < results.length; i++) {
    if (("Pavan" == results[i].name) & ("1234" == results[i].pass)) {
      console.log("Record found")
      break;
    }
  }
})//   to check record existence.

// connection.query('Insert into userinfo values(?,?)',[name,pass],function(err,results){
//       if (err) throw err
//       console.log("value added");
//   });// to add values into database