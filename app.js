var mysql = require("mysql");

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "2sjCu4EJGh4XWapp",
  database: "linktech"
});

con.query('SELECT * FROM users where status ="active" ',function(err,rows){
  if(err) throw err;

  for (var i = 0; i < rows.length; i++) {
    console.log(rows[i].username);
  };

});

