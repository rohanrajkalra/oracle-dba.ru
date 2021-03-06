﻿<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
	<div align="left">


<a href="http://<?php echo $_SERVER['HTTP_HOST'];?>"><img src="remote_oracle_dba.jpeg" border="0" alt="Remote Oracle DataBase Administrator"></a><br/></div>




<br/>
<br/><br/>

<div align="center">
<h3>Недостаточно свободного места в Fast Recovery Area</h3><br/>

<br/><br/>
<div align="left">


<pre>

База данных переставала работать т.к. не могла записать файл архивлога в 
специально отведенное для этого место.

Основная причина: бекап с удалением устаревших файлов архивных журналов не выполнялся несколько дней. 



Посмотреть данные Fast Recovery:


select ROUND((SPACE_USED)/1024/1024/1024) as "Used GB", 
ROUND((SPACE_LIMIT)/1024/1024/1024) as "MAX GB", 
ROUND(((SPACE_LIMIT)-(SPACE_USED))/1024/1024/1024) as "FREE GB"  
from V$recovery_File_Dest;


Процент использования FRA:


SELECT
    TO_CHAR(SPACE_USED, '999,999,999,999') AS "Used",
    TO_CHAR(SPACE_LIMIT - SPACE_USED + SPACE_RECLAIMABLE, '999,999,999,999')
       AS "Free",
    ROUND((SPACE_USED - SPACE_RECLAIMABLE)/SPACE_LIMIT * 100, 1)
       AS "Persent Used"
    FROM V$RECOVERY_FILE_DEST;



Алгоритм:

Подключиться к RMAN
1) CMD> rman target /

Убедиться, что база работает в режиме Archivelog

2) RMAN> 'select log_mode from v$database';

Увеличить размер flash recovery area
2) RMAN> sql 'alter system set db_recovery_file_dest_size = 25G';

Создать backup
3) backup database

Установить 1 день для хранения
4) RMAN> CONFIGURE RETENTION POLICY TO REDUNDANCY 1;

5) RMAN> delete noprompt obsolete;

Вернуть прежнее значении flash recovery area
6) RMAN> sql 'alter system set db_recovery_file_dest_size = 20G';



</pre>

</div>
</div>
<br/><br/><br/>




</div>	
</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
