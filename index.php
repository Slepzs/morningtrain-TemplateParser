<?php

/* inkludere template klassen */
include 'Template.php';

/* opretter et nyt template objekt */
$template = new Template;

/* Angiver ønsket værdier.*/
$template->assign('username', 'Tobias');
$template->assign('company', 'Morningtrain');

/* Fortæller render() funktionen hvilken template som er ønsket at vise. */
$template->render('mytemplate');

