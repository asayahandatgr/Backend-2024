// TODO 3: Import data students dari folder data/students.js
const studentsData = require('../data/students');

// code here

// Membuat Class StudentController
class StudentController {
  index(req, res) {
    const students = {
      message : "Menampilkan semua Student",
      students : studentsData,
    };

    res.json(students);
  }

  store(req, res) {
    const { nama } = req.body;

    if (!nama) {
      return res.status(400).json({ message: "Nama tidak boleh kosong." });
    }

    const newStudent = {
      id: studentsData.length + 1,
      nama,
    };

    studentsData.push(newStudent);

    const response = {
      message: `Menambahkan data Student: ${nama}`,
      students: studentsData,
    };

    res.json(response);
  }

  update(req, res) {
    const { id } = req.params;
    const { nama } = req.body;

    if (!nama) {
      return res.status(400).json({ message: "Nama tidak boleh kosong." });
    }

    const student = studentsData.find((s) => s.id === parseInt(id));

    if (!student) {
      return res.status(404).json({ message: `Student dengan ID ${id} tidak ditemukan.` });
    }

    student.nama = nama;

    const response = {
      message: `Mengedit data Student dengan ID ${id} menjadi: ${nama}`,
      students: studentsData,
    };

    res.json(response);
  }

  destroy(req, res) {
    const { id } = req.params;

    const studentIndex = studentsData.findIndex((s) => s.id === parseInt(id));

    if (studentIndex === -1) {
      return res.status(404).json({ message: `Student dengan ID ${id} tidak ditemukan.` });
    }

    studentsData.splice(studentIndex, 1);

    const response = {
      message: `Menghapus data Student dengan ID ${id}`,
      students: studentsData,
    };

    res.json(response);
  }
}

// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
