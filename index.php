<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.php");
include("includes/Pengurus.class.php");

$pengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$pengurus->open();

$data = null;
$no = 1;

$pengurus->getPengurus();

while ($row = $pengurus->getResult()) {
    $data .= "<article class='explore-item' tabindex='0'>
                <a href='detail.php?id=" . $row['id_pengurus'] . "'>
                  <div class='img-container'>
                    <img
                      class='explore-item__thumbnail lazyload'
                      src='./images/" . $row['foto'] . "'
                      alt='" . $row['nama'] . " photo'
                      tabindex='0'
                    />
                  </div>
                  <div class='explore-item__content'>
                    <div tabindex='0' class='explore-item__content'>
                      <h3 class='explore-item__content-title'>
                        " . $row['nama'] . "
                        -
                        " . $row['nim'] . "
                      </h3>
                      <span class='explore-item__time'>
                        " . $row['jabatan'] . "
                      </span>
                      <div class='action-btn-wrapper'>
                        <a
                          href='delete.php?id=" . $row['id_pengurus'] . "'
                          class='action-btn'
                          >Delete</a>
                      </div>
                    </div>
                  </div>
                </a>
              </article>";
}

$pengurus->close();
$tpl = new Template("templates/index.html");
$tpl->replace("DataPengurus", $data);
$tpl->write();
