<?php
foreach ($possibleColumns as $possibleColumn) {
    ?>
    <div>
      <a class=" " id="" href="#" onclick="event.preventDefault();eventIndexColumnsToggle('<?= $possibleColumn ;?>')">
        <i class="fa fa-check <?= in_array($possibleColumn, $columns, true) ? '' : 'invisible' ?>"></i>
        <?= $columnsDescription[$possibleColumn]; ?>
      </a>
    </div>
    <?php
}
?>
