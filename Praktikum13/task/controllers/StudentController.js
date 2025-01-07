// import Model Student
const Student = require("../models/Student");

class StudentController {
  // menambahkan keyword async
  async index(req, res) {
    const students = await Student.all();

    if (students.length > 0) {
      const data = {
        message: "Menampilkan data student",
        data: students,
      };

      res.status(200).json(data);
    } else {
      const data = {
        message: "Data student kosong",
      };

      res.status(200).json(data);
    }
  }

  async store(req, res) {
    const { nama, nim, email, jurusan } = req.body;
    if (!nama || !nim || !email || !jurusan) {
      const data = {
        message: "Semua data harus dikirim",
      };

      return res.status(422).json(data);
    }

    const student = await Student.create(req.body);
    const data = {
      message: "Menambahkan data student",
      data: student,
    };

    res.json(data);
  }

  async update(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);

    if (student) {
      const student = await Student.update(id, req.body);
      const data = {
        message: "Mengedit data student",
        data: student,
      };

      res.status(200).json(data);
    } else {
      const data = {
        message: "Data student tidak ditemukan",
      };

      res.status(404).json(data);
    }
  }

  async destroy(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);

    if (student) {
      await Student.delete(id);
      const data = {
        message: "Menghapus data student",
      };

      res.status(200).json(data);
    } else {
      const data = {
        message: "Data student tidak ditemukan",
      };

      res.status(404).json(data);
    }
  }

  async show(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);

    if (student) {
      const data = {
        message: "Menampilkan detail student",
        data: student,
      };

      res.status(200).json(data);
    } else {
      const data = {
        message: "Data student tidak ditemukan",
      };

      res.status(404).json(data);
    }
  }


}

// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
