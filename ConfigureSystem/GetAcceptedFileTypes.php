<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $fileTypeQuery = "SELECT * FROM accepted_file_types";
    $fileTypeResult = mysqli_query($connection,$fileTypeQuery);
?>

<table>
    <tr>
        <?php while($fileTypeRow = mysqli_fetch_assoc($fileTypeResult)) { ?>
            <td>
                <?= $fileTypeRow['File_Type'] ?>
                <button type="button" onclick="DeleteFile('<?= $fileTypeRow['File_Type'] ?>')">x</button>
            </td>
        <?php } ?>
    </tr>
</table>