const Student = require("../models/Student");

class StudentController {
  // Mendapatkan seluruh resource
  async index(req, res) {
    const students = await Student.all();

    const data = {
      message: "Menampilkan data student",
      data: students,
    };

    res.json(data);
  }

  store(req, res) {
    const { nama, nim, email, jurusan: studentClass } = req.body;
    const newStudent = { nama, nim, email, jurusan: studentClass };

    Student.create(newStudent)
      .then((student) => {
        const data = {
          message: "Menambahkan data student",
          data: student,
        };
        res.status(201).json(data);
      })
      .catch((error) => {
        res.status(500).json({ message: "Gagal menambahkan data student", error });
      });
  }
}

// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
