<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $refillDateQuery = "SELECT * FROM refill_dates";
    $refillDateResuilt = mysqli_query($connection,$refillDateQuery);
?>

<table>
    <tr>
        <?php while($refillDateRow = mysqli_fetch_assoc($refillDateResuilt)) { ?>
            <td>
                <?= $refillDateRow['date'] ?>
                <button type="button" onclick="DeleteDate(<?= $refillDateRow['date_id'] ?>)">x</button>
            </td>
        <?php } ?>
    </tr>
</table>