<?php

	// memulai sesi
	session_start();

	// perintah untuk mengakhiri (hapus) ketika sesi dihancurkan semua data di hapus
	session_destroy();

	// setelah dihapus akan diarahkan ke index.php
	header("Location: index.php");

?>