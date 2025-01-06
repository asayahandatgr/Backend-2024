// import database
const db = require("../config/database");

// membuat class Model Student
class Student {
  /**
   * Membuat method static all untuk mendapatkan semua data students.
   */
  static all() {
    const query = "SELECT * FROM students";
    return new Promise((resolve, reject) => {
      db.query(query, (err, results) => {
        if (err) {
          return reject(err);
        }
        resolve(results);
      });
    });
  }

  static create(student) {
    const query = "INSERT INTO students (nama, nim, email, jurusan) VALUES (?, ?, ?, ?)";
    return new Promise((resolve, reject) => {
      db.query(query, [student.nama, student.nim, student.email, student.jurusan], (err, result) => {
        if (err) {
          return reject(err);
        }
        resolve({ id: result.insertId, ...student });
      });
    });
  }


}

// export class Student
module.exports = Student;
