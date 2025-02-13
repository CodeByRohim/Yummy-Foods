<?php
include "../inc/BackendHeader.php";
include_once "../database/env.php";

// ACTIVITY SAVE LOG FUNCTION
function saveActivityLog($conn, $action, $details) {
    $stmt = $conn->prepare("INSERT INTO activities (action, details) VALUES (?, ?)");
    $stmt->bind_param("ss", $action, $details);
    $stmt->execute();
    $stmt->close();
}

// DATA UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE items SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $id);
    if ($stmt->execute()) {
        saveActivityLog($conn, "Update", "Data uploaded: $name (ID: $id)");
        echo "Data uploaded successfully!";
    }
    $stmt->close();
}

// DATA DELETE
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        saveActivityLog($conn, "Delete", "Data deleted successfully!(ID: $id)");
        echo "Data deleted successfully!";
    }
    $stmt->close();
}

// ALL DATA FETCH/SHOW
$result = $conn->query("SELECT * FROM items");
?>
    <!-- data update delete form -->
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <form method="POST">
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
                    <td><textarea name="description"><?php echo $row['description']; ?></textarea></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="update">Update</button>
                        <button type="submit" name="delete">Delete</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>

    <h3>Activity Log:</h3>
    <table class="table table-primary">
        <tr>
            <th>ID</th>
            <th>Action</th>
            <th>Details</th>
            <th>Date</th>
        </tr>
        
        <?php
        $logResult = $conn->query("SELECT * FROM activities ORDER BY id DESC");
        while ($log = $logResult->fetch_assoc()) {
         echo" <tr>
          <td>{$log['id']}</td>
          <td>{$log['action']  }</td>
          <td>{$log['details'] }</td>
                  
        </tr> "
        ;}
        ?>
    </table>
<?php include_once "../inc/BackendFooter.php"; ?>
<!-- <td>{$log['created_at']}</td> -->