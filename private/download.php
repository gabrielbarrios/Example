<?php
    header ("Content-type: application / vnd.ms-excel");
	header ("Content-Disposition: attachment; filename = report.csv");
	readfile ('report.csv');
	