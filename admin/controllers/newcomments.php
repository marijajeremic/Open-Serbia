<?php
$comm = new Comments();
$comment= $comm->getNoApprovedComm();
include __DIR__ . '../../views/newcomments.php';