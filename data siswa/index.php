<?php
session_start();

// Inisialisasi data siswa jika belum ada dalam sesi
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Fungsi untuk menambahkan siswa baru
function addStudent($name, $age, $grade) {
    $_SESSION['students'][] = [
        'name' => $name,
        'age' => $age,
        'grade' => $grade
    ];
}

// Fungsi untuk menghapus siswa berdasarkan index
function deleteStudent($index) {
    if (isset($_SESSION['students'][$index])) {
        unset($_SESSION['students'][$index]);
        $_SESSION['students'] = array_values($_SESSION['students']);
    }
}

// Fungsi untuk mengedit data siswa
function editStudent($index, $name, $age, $grade) {
    if (isset($_SESSION['students'][$index])) {
        $_SESSION['students'][$index] = [
            'name' => $name,
            'age' => $age,
            'grade' => $grade
        ];
    }
}

// Fungsi untuk mereset data siswa
function resetStudents() {
    $_SESSION['students'] = [];
}

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                addStudent($_POST['name'], $_POST['age'], $_POST['grade']);
                break;
            case 'delete':
                deleteStudent($_POST['index']);
                break;
            case 'edit':
                editStudent($_POST['index'], $_POST['name'], $_POST['age'], $_POST['grade']);
                break;
            case 'reset':
                resetStudents();
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Siswa</h1>

    <!-- Form untuk menambahkan atau mengedit siswa -->
    <form method="POST" action="">
        <input type="hidden" name="action" value="add" id="formAction">
        <input type="hidden" name="index" id="studentIndex">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        <label for="age">Umur:</label>
        <input type="number" id="age" name="age" required>
        <label for="grade">Kelas:</label>
        <input type="text" id="grade" name="grade" required>
        <button type="submit">Simpan</button>
    </form>

    <!-- Tabel untuk menampilkan data siswa -->
    <h2>Daftar Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['students'])): ?>
                <?php foreach ($_SESSION['students'] as $index => $student): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['age']; ?></td>
                        <td><?php echo $student['grade']; ?></td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit">Hapus</button>
                            </form>
                            <button onclick="editStudent(<?php echo $index; ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data siswa.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tombol untuk mereset data siswa -->
    <form method="POST" action="">
        <input type="hidden" name="action" value="reset">
        <button type="submit">Reset Semua Data Siswa</button>
    </form>

    <script>
        function editStudent(index) {
            var students = <?php echo json_encode($_SESSION['students']); ?>;
            var student = students[index];
            document.getElementById('formAction').value = 'edit';
            document.getElementById('studentIndex').value = index;
            document.getElementById('name').value = student.name;
            document.getElementById('age').value = student.age;
            document.getElementById('grade').value = student.grade;
        }
    </script>
</body>
</html>
