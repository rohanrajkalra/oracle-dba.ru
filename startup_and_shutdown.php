﻿<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h1>Режимы запуска и останова базы данных Oracle</h1><br/>


<h2>Запуск базы данных Oracle</h2>
<br/><br/>
STARTUP [FORCE] [RESTRICT] [MOUNT | OPEN | NOMOUNT]
<br/><br/>

<h3>STARTUP NOMOUNT</h3>
<br/><br/>
Запуск экземпляра базы данных: состояние NOMOUNT<br/>
Во время запуска экземпляра базы данных, необходимо выбрать состояние, в которое в результате прейдет экземпляр.<br/>
<br/><br/>
Обычно экземпляр запускается в режиме NOMOUNT только во время создания базы данных или для пересоздания управляющих файлов, а также при выполнении определенных сценариев резервирования и восстановления.
<br/><br/>
------------------------------------------------------------
<br/>
<br/>
Запуск экземпляра подразумевает выполнение следующих задач:
<br/><br/>
1) Поиск в директории $ORACLE_HOME/dbs файла параметров, осуществляемый в следующем порядке.
<br/><br/>
• Ищется файл spfileSID.ora<br/>
• Если он не найдет, тогда производится поиск файла spfile.ora;<br/>
• Если он не найден, тогда поиск файла SID.ora.<br/>
Искомый файл содержит параметры экземпляра базы данных;
<br/>
2) Задание параметра PFILE в команде STARTUP переопределяет установленный по умолчанию порядок выбора файла параметров.<br/>
3) Выделение SGA;<br/>
4) Запуск фоновых процессов.<br/>
5) Открытие сигнального файла alertSID.log и файлов трассировки. <br/>


<br/><br/>

<h3>STARTUP MOUNT</h3>

Монтирование базы данных включает следующие задачи:<br/>
Ассоциация базы данных с предварительно запущенным экземпляром:<br/>
Определение местоположения управляющих файлов, которые указаны в файле параметров:<br/>
Чтение управляющих файлов с целью получения имен и статуса файлов данных и журнальных файлов. Однако на данный момент не проверяется фактическое существование файлов данных и журнальных файлов. 
	


<br/><br/>

<h3>STARTUP OPEN</h3>
		
<br/><br/>

Открытие базы данных подразумевает выполнение следующих задач:

<br/><br/>

• Открытие оперативных файлов данных;<br/>
• Открытие оперативных журнальных файлов.<br/>
<br/><br/>
Если какие-либо из файлов данных или журнальных файлов недоступны в момент открытия базы данных, сервер Oracle возвращает ошибку.
<br/><br/>
При выполнении окончательного этапа открытия базы данных, Oracle проверяет доступность всех файлов данных и журнальных файлов, а также проверяет целостность базы данных. Если необходимо, фоновый процесс системный монитор (SMON) инициирует восстановление экземпляра. 	

<br/><br/>
<br/><br/>

<h2>Останов базы данных Oracle</h2>

<br/><br/>
SHUTDOWN [NORMAL | TRANSACTIONAL | IMMEDIATE | ABORT] 
<br/><br/>

<div align="center">

<img src="http://oracle-dba.ru/images/shutdown.jpg" border="0" alt="Oracle Instance"><br/>
</div>

<br/><br/>

ABORT – Перед остановкой производится наименьшее число действий. После этого при запуске система должна выполнить восстановление. Поэтому используйте этот режим только, когда это необходимо. Обычно он применяется, когда другие варианты остановки не отрабатывают, когда это вызвано проблемами, возникающими при запуске или когда требуется немедленно остановить экземпляр перед проблемной ситуаций, например, при получении сообщения о том, что через несколько секунд будет выключение питания.<br/>
IMMEDIATE – обычно используемая опция. При этом незафиксированные транзакции откатываются.<br/>
TRANSACTIONAL – представляется возможность завершить транзакции.<br/>
NORMAL – Экземпляр не останавливается, пока не отсоединятся сеансы. <br/>

<br/><br/>


<br/><br/>

<h3>SHUTDOWN NORMAL</h3>
		
<br/><br/>

Нормальный режим остановки базы данных, используется по умолчанию.

<br/><br/>
• Новые соединения не разрешаются.<br/>
• Сервер Oracle ожидает отсоединения всех пользователей и только после этого продолжает остановку базы данных.<br/>
• Буферы из КЭШа базы данных и журнала записываются на диск.<br/>
• Фоновые процессы завершаются и SGA удаляется из памяти.<br/>
• Перед остановкой экземпляра, Oracle закрывает и демонтирует базу данных.<br/>
• При следующем запуске не потребуется восстановление экземпляра. <br/>


<br/><br/>

<h3>SHUTDOWN TRANSACTIONAL</h3>
		
<br/><br/>

Транзакционная остановка обеспечивает сохранность данных клиентов, включая результаты текущих действий. Остановка базы данных в транзакционном режиме происходит следующим образом:

<br/><br/>
• Ни один клиент не может запустить новую транзакцию в этом экземпляре.<br/>
• Клиент принудительно отсоединяется, как только завершается текущая транзакция.<br/>
• Как только все транзакции завершены, немедленно выполняется остановка.<br/>
• При следующем запуске не потребуется восстановление экземпляра. <br/>

<br/><br/>

<h3>SHUTDOWN IMMEDIATE</h3>
		
<br/><br/>

Немедленная остановка базы данных выполняется следующим образом:

<br/><br/>

• Обработка команд SQL, выполняемых Oracle в данный момент, не завершается.<br/>
• Сервер Oracle не ожидает отсоединения пользователей, работающих с базой данных в текущий момент.<br/>
• Oracle выполняет откат всех активных транзакций и принудительно отсоединяет всех пользователей.<br/>
• Oracle закрывает и демонтирует базу данных перед остановкой экземпляра.<br/>
• При следующем запуске не потребуется восстановление экземпляра. <br/>


<br/><br/>

<h3>SHUTDOWN ABORT</h3>
		
<br/><br/>

Если режимы нормальной и немедленной остановки не срабатывают, может быть выполнена аварийная остановка базы данных. Аварийное завершение работы экземпляра выполняется следующим образом:
<br/><br/>
Немедленно отменяются все команды SQL, обрабатываемые сервером Oracle.<br/>
Сервер Oracle не ожидает отсоединения пользователей, работающих с базой данных в текущий момент.<br/>
Буферы из КЭШа базы данных и журнала не записываются на диск.<br/>
Не выполняется откат незафиксированных транзакций.<br/>
База данных не закрывается и не демонтируется.<br/>
Экземпляр удаляется без закрытия файлов.<br/>
При следующем запуске потребуется восстановление экземпляра, которое произойдет автоматически. <br/>
<br/><br/>
<br/><br/>










</div>	
<?php include_once "_footer.php"?>

</body>

</html>