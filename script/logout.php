<?php
session_start();
unset($_SESSION["userrole"]);
header("Refresh: 0; url=<?= $this->urlArr['baseUrl'] ?>");