<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data dari form
$name = $_POST['name'];
$email = $_POST['email'];

// Menyimpan data ke database
if (isset($name) && isset($email)) {
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.<br><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mengambil data dari database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Menampilkan data dalam tabel HTML
if ($result->num_rows > 0) {
    echo "<h2>Data yang Disimpan:</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data yang disimpan.";
}

// Menutup koneksi
$conn->close();
?>
