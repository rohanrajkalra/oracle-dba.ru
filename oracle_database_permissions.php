﻿<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Управление доступом к базе данных: </h2>
<br/><br/>
Полномочия – это право на выполнение конкретного типа SQL-оператора или на доступ к объекту базы данных, принадлежащему другому пользователю. В базе данных Oracle необходимо явно предоставить пользователю полномочия для выполнения любых действий, включая подключение к базе данных или выборку, изменение и обновление данных в любой таблице, кроме собственной.
<br/><br/>
Существуют два основных типа полномочий Oracle: системные полномочия и объектные полномочия. Для предоставления пользователям как системных, так и объектынх полномочий служит оператор GRANT. 
<br/><br/>
<h3> Системные полномочия: </h3>
<br/><br/>
Системные полномочия позволяют пользователю выполнить конкретное действие в базе данных либо действие с любым объектом схемы, конкретного типа. Хороший пример первого типа системных полномочий – полномочия, которые позволяют подключаться к базе данных, носящие название полномочий CONNECT. Другими полномочиями этого типа являются полномоичия CREATE TABLESPACE, CREATE USER, DROP USER и ALTER USER.
<br/><br/>
Второй класс системных полномоичий предоставляет пользователям право на выполненение операций, которыевлияют на объекты в любой схеме. Примерами этого типа системных полномочий служат ANALYZE ANY TABLE, GRANT ANY PRIVILEGE, INSERT ANY TABLE, DELETE ANY TABLE и т.п. Системные полномочия являются очень мощным средством и выдача их не тому пользователю может оказать разруши тельное влияние на базу данных. 
<br/><br/>
Ниже перечислены некоторые наиболее часто используемые полномочия базы данных Oracle:
<br/><br/>
<ul>
<li> ADVISOR</li>
<li> ALTER DATABASE</li>
<li> ALTER SYSTEM</li>
<li> AUDIT SYSTEM</li>
<li> CREATE DATABASE LINK</li>
<li> CREATE TABLE</li>
<li> CREATE ANY INDEX</li>
<li> CREATE SESSION</li>
<li> CREATE TABLESPACE</li>
<li> CREATE USER</li>
<li> DROP USER</li>
<li> INSERT ANY TABLE</li>
</ul>
<br/><br/>
<strong>Пример: </strong><br/>
GRANT CREATE SESSION TO scott;
<br/><br/>
<h3> Объектыные полномочия: </h3>
<br/><br/>
Объектыне полномочия – это полномочия по отношению к различным типам объектов базы данных. Объектыные полномочия дают пользователю возможность выполнять действия с конкретной таблицей, представлением, материализованным представлением, последовательностью, процедурой, функцией или пакетом. Следовательно, всем пользователям базы данных нужны объектные полномочия. 
<br/><br/>

Для выдачи объектных полномочий можно использовать следующие SQL-операторы.
<br/><br/>
<ul>
<li> ALTER </li>
<li> SELECT </li>
<li> DELETE</li>
<li> EXECUTE</li>
<li> INSERT</li>
<li> REFERENCES</li>
<li> INDEX</li>
</ul>
<br/><br/>

<strong>Пример: </strong><br/>

GRANT SELECT, UPDATE <br/>
ON table_name TO scott;

<br/><br/>

<h3>Основные представления привелегий пользователей:</h3>

<br/><br/>
<pre>
ROLE_SYS_PRIVS - Системные привилегии, предоатавленные ролям.
ROLE_TAB_PRIVS - Привилегии на таблицы, предоставленные ролям.
USER_ROLE_PRIVS - Роли, доступные пользователю.
USER_TAB_PRIVS_MADE - Объектыне привилегии, которые пользователь предоставил на свои объекты.
USER_TAB_PRIVS_RECD - Объектыне привилегии, предоставленные пользователю.
USER_COL_PRIVS_MADE - объектные привилегии, которые пользователь предоставил на столбцы своих объектов.
USER_COL_PRIVS_RECD - Объектыне привилении, предоставленные пользователю на столбцы чужих объектов.
USER_SYS_PRIVS - Перечень системынх привилегий предоставленных пользователю.
</pre>




<h2>Получить список всех ролей, системных и объектных привилегий пользователя. (Запускаетс под учетной записью пользователя)</h2>
<br/><br/>
<h3>Способ 1:</h3>
<br/><br/>

<pre class="brush: sql;">

    SET feedback off
    SET serveroutput ON
     
    BEGIN
      dbms_output.enable(100000);
      dbms_output.put_line('-- Fetching roles');
      FOR i IN (SELECT username, granted_role FROM user_role_privs) LOOP
        dbms_output.put_line('grant '||i.granted_role||' to '||i.username||';');
      END LOOP;
      dbms_output.put_line('-- Fetching system privileges');
      FOR i IN (SELECT username, privilege FROM user_sys_privs) LOOP
        dbms_output.put_line('grant '||i.privilege||' to '||i.username||';');
      END LOOP;
      dbms_output.put_line('-- Fetching object privileges');
      FOR i IN (SELECT grantee, owner, table_name, privilege FROM user_tab_privs) LOOP
        dbms_output.put_line('grant '||i.privilege||' on '||i.owner||'.'||i.table_name||' to '||i.grantee||';');
      END LOOP;
    END;
    /

	</pre>
	
<br/><br/>
<strong>Result:</strong>

<br/><br/>
<pre>
grant UNLIMITED TABLESPACE to PLSQL_PROJECT;
grant CREATE SESSION to PLSQL_PROJECT;
grant CREATE TABLE to PLSQL_PROJECT;
</pre>


<br/><br/>
<h3>Способ 2:</h3>
<br/><br/>



<pre>
Our task is get all privileges granted for user and create report based on this information. As you know privileges gives on user directly or on his role. Privileges divided by 2 part: system and object.

Let see example, create report for user Scott

</pre>

<br/><br/>

<strong>1.Create repository table for store data:</strong>

<br/><br/>



<pre class="brush: sql;">
create table vm_user_privs(privilege varchar2(100),user_name varchar2(100),object_name varchar2(100));

</pre>



<br/><br/>

<strong>2. Main script:</strong>

<br/><br/>

<pre class="brush: sql;">

declare
cursor c_user is
select distinct(a.username) from dba_users a
where a.username='SCOTT';
p_user varchar2(100);

begin
open c_user;
loop
fetch c_user into p_user;
insert into vm_user_privs
select /*+ rule */ a.privilege,p_user,a.table_name from dba_tab_privs a where a.grantee=p_user
union all
select /*+rule */ b.privilege,p_user,b.table_name from dba_tab_privs b where b.grantee in (select b1.granted_role from dba_role_privs b1 where b1.grantee=p_user)
union all
select /*+ rule */ c.privilege,p_user,null from dba_sys_privs c where c.grantee=p_user
union all
select /*+rule */ d.privilege,p_user,null from dba_sys_privs d where d.grantee in (select b2.granted_role from dba_role_privs b2 where b2.grantee=p_user);
commit;
EXIT WHEN c_user%NOTFOUND;
end loop;
close c_user;
end;

</pre>

<br/><br/>

<strong>3. See result:</strong>

<br/><br/>

<pre class="brush: sql;">
select * from vm_user_privs

</pre>



Thank's to<br/>
http://ocp.community.ge/post/Script-generate-all-user-privileges-in-one-report.aspx
<br/><br/>
<br/><br/>



</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
