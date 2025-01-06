// import database
const db = require("../config/database");

// membuat class Model Student
class Student {
  /**
   * Membuat method static all.
   */
  static all() {
    // return Promise sebagai solusi Asynchronous
    return new Promise((resolve, reject) => {
      const sql = "SELECT * from students";
      db.query(sql, (err, results) => {
        if (err) {
          reject(err);asqw
        }
        resolve(results);
      });
    });
  }

  /**
   * TODO 1: Buat fungsi untuk insert data.
   * Method menerima parameter data yang akan diinsert.
   * Method mengembalikan data student yang baru diinsert.
   */
  static create(student) {
    return new Promise((resolve, reject) => {
    const query = "INSERT INTO students (nama, nim, email, jurusan) VALUES (?, ?, ?, ?)";
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
