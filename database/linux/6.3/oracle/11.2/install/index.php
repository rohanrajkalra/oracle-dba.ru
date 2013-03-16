﻿<html>

<?php include_once "../../../../../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../../../../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Инсталляция Oracle DataBase Server 11.2.0.3.2]: 
Инсталляция Oracle DataBase 11G R2 x86 64 bit в операционной системе Oracle Linux 6.3 x86 64 bit</h2>

<br/><br/>


<h3>Oracle® Database Quick Installation Guide 11g Release 2 (11.2) for Linux x86-64</h3>
http://docs.oracle.com/cd/E11882_01/install.112/e24326/toc.htm


<br/><br/>
<br/><br/>


В документе описывается один из способов инсталляции базы данных Oracle в операционной системе Oracle Linux.

<br/><br/>

Использовать его следует, если вы только приступаете к изучению основ администрирования баз данных Oracle. В случае необходимости использования в промышленной среде, необходимо обязательно обеспечить резервное копирование, мультиплексирование критичных для работы базы данных файлов и правильно настроить системные параметры. 

<br/><br/>

В случае обнаружения ошибок, неточностей, опечаток или Вам известны лучшие способы, пишите мне адрес эл. почты:

<br/><br/>

<div>
	<img src="http://fotografii.org/a3333333mail.gif" border="0">
</div>

<br/><br/>




<strong>Самые последние версии (на момент написания):</strong>

<br/><br/>

<ul>
	<li>Oracle Linux - 6.3</li>
	<li>Oracle DataBase - 11.2.0.3</li>
</ul>





<br/><br/>

Инсталляция происходит на удаленный сервер без GUI.
<br/><br/>

Управление процессом установки и настройки происходит с рабочей станции под управлением Windows, на которой устанавлены putty и xming.

<br/><br/>
При помощью консоли putty на сервере выполняются команды. Xming нужен для получения графических изображений.



<br/><br/>
<br/><br/>
<h2>Дистрибутивы:</h2>


<ul>
	<li><a href="oracle_distrib.php">Дистрибутивы баз данных и дополнительное программное обеспечение</a><br/></li>
	<li><a href="oracle_virtual_mashine.php">Виртуальная машина Virtual Box с установленной Oracle Database (11.2.0.3) в операционной системе Oracle Linux 6.2 (x86_64)</a><br/></li>
</ul>

<br/><br/>

<h2>Подготовка операционной системы Linux к инсталляции базы данных Oracle:</h2>


<ul>
<li><a href="oracle_before.php">Настройка некоторых параметров операционной системы</a></li>
	<li><a href="oracle_network.php">Настройка сетевых интерфейсов</a></li>
	<li><a href="oracle_install_packages.php">Инсталляция обязательных пакетов</a></li>
	<li><a href="oracle_time.php">Настройка актуального времени</a></li>
	<li><a href="oracle_disks.php">Подготовка дисков к инсталляции базы данных</a></li>
	<li><a href="oracle_kernel_parameters.php">Конфигурурование системных пользователей, настройка параметров системы</a></li>
	<li><a href="oracle_autostart_packages.php">Автозапуск только выбранных программ</a></li>
	<li><a href="oracle_catalogs.php">Создание структуры каталогов и назначение необходимых прав</a></li>
	<li><a href="oracle_copy_distrib_on_server.php">Копирование дистрибутивов базы данных на сервер</a></li>
</ul>


<br/><br/>

<h2>Инсталляция базы данных:</h2>
<ul>
	<li><a href="oracle_database_software_installation.php">Инсталляция СУБД Oracle (DataBase SoftWare)</a></li>
	<li><a href="oracle_listener_creation.php">Создание службы удаленного подключения к серверу (Listener)</a></li>
	<li><a href="oracle_instance_creation.php">Создание экземпляра базы данных (Instance)</a></li>
</ul>

<br/><br/>

<h2>После инсталляции:</h2>

<ul>
	<li><a href="oracle_autostart.php">Настройка автозапуска Oracle после перезагрузки</a></li>
	<li><a href="oracle_cold_backup.php">Создание резервной копии созданной базы данных (холодный backup):</a></li>
	<li><a href="oracle_PSU_upd.php">Обновление базы патчами, рекомендованными Oracle</a></li>
	<li><a href="oracle_disable_root_access.php">Запретить удаленное подключение к сереверу баз данных пользователем root:</a></li>
</ul>

<br/><br/>

<h2>Обеспечение дополнительной отказоустойчивости и надежности:</h2>
<ul>

	<li><a href="oracle_multiplex_controlfiles.php">Мультиплексирование controlfiles</a></li>
	<li><a href="oracle_multiplex_redologs.php">Мультиплексирование redologs</a></li>
	<li><a href="oracle_archivelog_on.php">Включить режим работы ARCHIVELOG</a></li>
	<li><a href="oracle_multiplex_archivelogs.php">Мультиплексирование archivelog</a></li>
	<li><a href="oracle_add_datafiles.php">Расширение табличных пространств (создание дополнительных файлов для табличных пространств)</a></li>
	<li><a href="oracle_flashback_on.php">Включить режим работы FLASH BACK</a></li>
	<li><a href="oracle_final_hot_backup.php">Контрольный backup (горячий backup)</a></li>
</ul>




<br/><br/>
<br/><br/>


        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'oracle-dba'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        


<br/><br/>
<br/><br/>




</div>		
		
	

<?php include_once "../../../../../../_footer.php"?>

</body>

</html>
