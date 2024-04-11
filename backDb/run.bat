@ECHO off 
sqlcmd -S LAPTOP-085B2EGC -U essl -P essl -d etas -i C:\xampp\htdocs\eTAS\backDb\sql_backup.sql
