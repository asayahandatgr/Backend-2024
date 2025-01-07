// import database
const db = require("../config/database");

// membuat class Model Student
class Student {
  static all() {
    return new Promise((resolve, reject) => {
      const query = "SELECT * FROM students";
  
      db.query(query, (err, results) => {
        if (err) {
          reject(err); 
        } else {
          resolve(results);
        }
      });
    });
  }
  

  static async create(data) {
    const id = await new Promise((resolve, reject) => {
      const sql = "INSERT INTO students SET ?";
      db.query(sql, data, (err, results) => {
        if (err) {
          reject(err); 
        } else {
          resolve(results.insertId); 
        }
      });
    });
  
    const student = await this.find(id);
    return student;
  }
  

  static find(id) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM students WHERE id = ?";
      db.query(sql, id, (err, results) => {
        if (err) {
          reject(err); // Tangani error
        } else {
          const [student] = results;
          resolve(student); // Kembalikan data student
        }
      });
    });
  }
  

  static async update(id, data) {
    await new Promise((resolve, reject) => {
      const sql = "UPDATE students SET ? WHERE id = ?";
      db.query(sql, [data, id], (err, results) => {
        if (err) {
          reject(err);
        } else {
          resolve(results);
        }
      });
    });
  
    const student = await this.find(id);
    return student;
  }
  

  static delete(id) {
    return new Promise((resolve, reject) => {
      const sql = "DELETE FROM students WHERE id = ?";
      db.query(sql, id, (err, results) => {
        if (err) {
          reject(err);
        } else {
          resolve(results);
        }
      });
    });
  }
  
}

// export class Student
module.exports = Student;
