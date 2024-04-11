use etas;
go

DECLARE @path nVARCHAR(500)
DECLARE @dbname nvarchar(1000);
set @dbname='backup_etas';

set @path='C:\xampp\htdocs\eTAS\backDb\db\'+ @dbname + '.bak';
backup database etas to disk = @path;
