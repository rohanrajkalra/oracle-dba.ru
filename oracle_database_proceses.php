﻿<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>

<h2>Процессы Oracle</h2>
<br/><br/>
Серверные процессы Oracle запускаются из операционной системы и выполняют все операции с базой данных, такие как вставка и удаление данных. Этот процесс Oracle, вместе со структурами памяти, выделенными Oracle операционной системой, формируют работающий экземпляр Oracle. Это набор обязательных процессов Oracle, которые должны быть запущены, чтобы база данных вообще могла работать. Другие процессы Oracle обязательны, только если вы используете определенные специализированные средства Oracle (наподобие реплицированных баз данных).
<br/><br/>

Процесс – это по существу соединение или поток операционной системы, который выполняет определенную задачу. Процессы Oracle, с которыми вы познакомитесь в настоящем разделе, являются непрерывными, в том смысле, что они запускаются при запуске экземпляра и остаются активными на все время жизни экземпляра. Таким образом, они служат «руками» Oracle, запущенными в ресурсы операционной системы. 
<br/><br/>

<br/><br/>

Процессы Oracle делятся на два основных типа – для эффективности и для отделения клиентский процессов от задач сервера базы данных.

<br/><br/>
<ul>

<li> Пользовательский процесс. Эти процессы отвечают за выполнение приложения, подключающего пользователя к экземпляру базы данных.</li>
<li> Процесс Oracle. Эти процессы выполняют задачи сервера Oracle, и вы можете разделить их на две основные категории: сервере процессы и фоновые процессы. Вместе они выполняют всю действительную работу в базе данных – от управления соединениями для записи журнальных файлов  и файлов данных до мониторинга пользовательских процессов.</li>
</ul>
<br/><br/>

Получить информацию о процессах, можно выполнив команду:<br/><br/>
$ ps -eaf | grep ora112

<br/><br/>

<pre>

oracle11  2722     1  0  2011 ?        01:02:06 ora_pmon_ora112
oracle11  2726     1  0  2011 ?        00:39:42 ora_psp0_ora112
oracle11  2730     1  0  2011 ?        05:12:43 ora_vktm_ora112
oracle11  2736     1  0  2011 ?        00:32:43 ora_gen0_ora112
oracle11  2740     1  0  2011 ?        00:22:40 ora_diag_ora112
oracle11  2744     1  0  2011 ?        00:35:09 ora_dbrm_ora112
oracle11  2748     1  0  2011 ?        01:14:24 ora_dia0_ora112
oracle11  2752     1  0  2011 ?        00:31:44 ora_mman_ora112
oracle11  2756     1  0  2011 ?        00:46:33 ora_dbw0_ora112
oracle11  2760     1  0  2011 ?        00:40:06 ora_lgwr_ora112
oracle11  2764     1  0  2011 ?        01:28:04 ora_ckpt_ora112
oracle11  2768     1  0  2011 ?        00:18:38 ora_smon_ora112
oracle11  2772     1  0  2011 ?        00:15:23 ora_reco_ora112
oracle11  2776     1  0  2011 ?        01:30:37 ora_mmon_ora112
oracle11  2780     1  0  2011 ?        01:15:35 ora_mmnl_ora112
oracle11  2784     1  0  2011 ?        00:15:53 ora_d000_ora112
oracle11  2788     1  0  2011 ?        00:16:04 ora_s000_ora112
oracle11  2838     1  0  2011 ?        00:33:21 ora_rvwr_ora112
oracle11  2845     1  0  2011 ?        00:16:10 ora_arc0_ora112
oracle11  2849     1  0  2011 ?        00:17:40 ora_arc1_ora112
oracle11  2853     1  0  2011 ?        00:15:52 ora_arc2_ora112
oracle11  2857     1  0  2011 ?        00:15:55 ora_arc3_ora112
oracle11  2861     1  0  2011 ?        00:17:30 ora_qmnc_ora112
oracle11  2992     1  0  2011 ?        01:13:39 ora_cjq0_ora112
oracle11  3027     1  0  2011 ?        00:17:59 ora_q000_ora112
oracle11  3031     1  0  2011 ?        00:15:07 ora_q001_ora112
oracle11  3083     1  0  2011 ?        00:32:57 ora_smco_ora112
oracle11  5167     1  0 Jan24 ?        00:00:02 oracleora112 (LOCAL=NO)
oracle11 16833     1  0 14:42 ?        00:00:00 ora_w000_ora112
oracle11 16866  5073  0 14:46 pts/0    00:00:00 grep ora112

</pre>

<br/>
<br/>
Посмотреть все доступные фоновые процессы Oracle можно, выполнив запрос к представлению v$BGPROCESS
<br/><br/>

SELECT name, description  FROM v$BGPROCESS ORDER BY 1;
<br/><br/>
SELECT  pname FROM v$PROCESS;



<br/><br/>

<h3> Взаимодействие между пользователем и процессами Oracle</h3>
<br/><br/>

Пользовательские процессы выполняют прикладные программы и инструменты Oracle вроде SQL*PLUS. Пользовательские процессы взаимодействуют через пользвательский интерфейс и запрашивают от серверных процессов Oracle выполнение опедлеенной работы. Oracle отвечает на запросы пользовательских процессов своими серверными процессами. В обязаннности серверных процессов входит отслеживание пользовательских соединений, прием запросов данных и возвра результатов пользователям. Все запросы SELECT, например, подразумевают чтение данных из базы, а серверный процесс возвращает вывод оператора SELECT обратно пользователю.
<br/><br/>

<h3> Серверный процесс</h3>
<br/><br/>

Когда вы запускаете инструмент Oracle, такой как DataBase Control, или интерфейс SQL*Plus, то делаете это через пользовательский процесс. Сеанс Oracle – это специфическое соединение пользователя с экземпляром Oracle через пользовательский процесс Oracle. Длительность сеанса простирается от момента подлкючения к базе данных с указанием комбинации имени и пароля пользователя до момента выхода (log out).
<br/><br/>

Серверный процесс – это процесс, который обслуживает индивидуальный пользовательский процесс. Каждый прользователь, подключенный к базе данных, имет свой отдельный серверный процесс, существующий на протяжении существования сеанса.
<br/><br/>

Серверный процесс создается для обслуживания пользовательского процесса и используется этим пользовательским процессом для взаимодействия с сервером Oracle. Так, например, когда пользователь посылает запрос на выборку данных, серверный процесс, созданный для обслуживания пользовательского приложения, проверяет синтаксис кода и выполняет код SQL. Затем он читает данные из файлов в блоки памяти. (Если другой пользователь захочет прочесть те же данные, то его пользовательский процесс прочтет их не с диска, а из памяти Oracle, где данные обычно находятся некоторое время.) И, наконец, серверный процесс вернет запрошенные данных пользотвельском процессу. 

<br/><br/>

Количество пользовательских процессов на каждый серверный процесс зависит от типа конфигурации сервера. Вы можете использовать три типа конфигурации сервера, как описано ниже:
<br/><br/>

<ul>
<li> Конфигурация с выделенным сервером. Наиболее распространенная конфигурация, когда серверный процесс выделяется для обслуживания каждого пользователя. При таком подходе каждый пользователь подключается к базе данных через выделенный серверный процесс по схеме «один к одному».
</li>
<li> Конфигурация с разделенным сервером. Несколько пользовательских процессов разделяют один серверный процесс. Когда вы применяете архитектуру с разделенным сервером, несколько пользователей подключаются через диспетчер и используют разделяемый серверный процесс. Даже несмотря на то, что обычно применяемый подход с выделенным сервером легче устанавливается и настраивается, и вполне подходит к большинству случаев, все же в некоторых ситуациях лучше использовать разделяемы серверный процесс, который позволяет сэкономить важнейшие системные ресурсы, такие как память. Когда вы используете конфигурацию с разделенным сервером, вы можете настроить пулинг соединений. Пулинг соединений позволяет повторно использовать существующие простаивающие соединения для обслуживания других активных сеансов. Вы можете также сконфигурировать на разделенном сервере мультиплексирование сеанса, когда несколько сеансов работают через одно и то же сетевое соединение.
</li>
 
<li> Резидентный пулиг соединений базы данных (database resident connection pooling – DRCP). Этот метод соединения, представленный в выпуске oracle Database 11g, подходит приложениям, которые должны поддерживать постоянное подключение к базе данных, что повышает требования к серверным ресурсам. DRCP позволяет устанавливать пул выделенных соединений, совместно используемый приложениями и процессами. Когда клиент запрашивает соединение с базо данных, брокер соединений вместо выделенного сервера подключает клиента к базе данных. Брокер соединений отвечает за управление клиентскими соединениями, выделяя сервер из пула выделенных серверов. Брокер соединений связывает клиентское соединение в выделенным сервером, и как только клиентскй запрос выполнен, выделенный сервер возвращается в пул доступных серверов.
</li>
</ul>

<br/><br/>

<h3> Фоновые процессы</h3>
<br/><br/>

Фоновые процессы – это «рабочие лошадки» экземпляра Oracle. Они позволяют большому числу пользователей параллельно и эффективно использовать информацию, хранимую в файлах данных. Oracle создает эти процессы автоматически при запуске экземпляра, и будучи постоянно связанными с операционной системой, они избавляют программное обеспечение Oracle от многократного запуска множества отдельный процессов для выполнения разннообразных задач, которые нужно выполнять на сервере операционной системы. Каждый из фоновых процессов Oracle отвечает за отдельную задачу, тем самым повышая эффективность экземпляра базы данных. Эти процессы автоматически создаются oracle при запуске экземпляра базы данных, и прекращают свою работу при его останове.
<br/><br/>

Ниже перечислены ключевые фоновые процессы Oracle. Есть и другие специализированные фоновые процессы, которые понадобится использовать, только если вы примените некоторые расширенные средства Oracle.
<br/><br/>

<ul>
<li> DBWn (DataBase Writer) (Писатель базы данных) -  Пишет модифицированные данные из буферного кэша на диск (в файлы данных)</li>
<li> LGWR (Log Writer) (Писатель журнала) -  Пишет содержимое буфера журнала повторного выполнения в фалы онлайнового журнала повторного выполенения.</li>
<li> CKPT (checkpoint) (Процесс контрольных точек) – Обновляет заголовки всех файлов данных, фиксируя детали контрольных точек</li>
<li> PMON (Process Monitor) (Монитор процессов) – Выполняет очистку после остановлены и сбойных процессов</li>
<li> SMON (System Monitor) (Системный монитор) – Выполняет восстановление после сбоев и объединение экстентов</li>
<li> ARCn (Archiver) (Архиватор) – Архивирует заполненные файлы журналов повторного выполнения.</li>
<li> MMON (Manageability monitor) Монитор управляемости – выполняет задачи, связанные с управлением базой данных</li>
<li> MMNL (Manageability monitor light) Монитор управляемости облегченный Выполняет такие задачи, как фиксация хронологии и метрик сеанса</li>
<li> MMAN (Memory Manager) – Диспетчер памяти  - координирует размеры компонентов SGA</li>
<li> CJQO (Job queue coordination process) (Процесс координации очереди заданий) – Координирует очереди запланированных заданий.</li>
</ul>



<br/><br/>

<h3> Писатель базы данных</h3>
<br/><br/>

Oracle не модифицирует данные прямо на диске. Все модификации данных происходят в памяти Oracle. Процесс писателя базы данных затем отвечает за запись «грязных» (модифицированных) данных из областей памяти, называемых буферами базы данных, в файлы данных на диске.
<br/><br/>

Работа процесса DBWn состоит в том, чтобы отслеживать использование буферного кэша базы данных, и если свободное место в буфере сокращается, то это процесс освобождает память, записывая некоторые данные из буферов в дисковые файлы. Процесс писателя базы данных применяет алгоритм самого последнего использованного (Least recently used – LRU) (либо его модифицированную версию), который сохраняе данные в буферах памяти в зависимости от периода времени, прошедшего с момента последнего запроса этих данных. Если часть данных запрашивалась недавно, более вероятно, что она будет сохранена в буферах памяти.


<br/><br/>

Процесс писателя базы данных пишет «грязные» буферы на диск при следующих условия:

<br/><br/>

1.	Когда база данных создает контрольную точку. <br/>
2.	Когда серверный процесс не может найти чистый буфер после достижения некоторого порогового значения числа буферов. <br/>
3.	Каждые 3 секунды. <br/>

<br/><br/>

Когда пользователь фиксирует транзакцию, она не сразу записывается процессом писателем в файлы данных. Oracle откладывает момент физического ввода-вывода до того времени, когда это можно будет сделать более эффективно, сбрасывая на диск по нескольку фиксированных транзакций за раз.
<br/><br/>

Для очень больших баз данных или баз, выполняющих интенсивные операции, единственного процесса-писателя может оказаться недостаточно для выполнения всего объема записи в файлы данных. На этот случай в Oracle предусмотрено применение нескольких процессов-писателей, распределяющих между собой нагрузку по модификации данных на диске. Вы можете использовать до 20 процессов-писателей (от DBW0 до DBW9 и jn DBWa до DBWj). Oracle рекомендует использовать  несколько процессов-писателей только в том случае, если на сервере установлено несколько процессоров.

<br/><br/>

Вы можете специфировть дополнительные процесс-писатель азы данных, используя параметр инициализации DB_WRITER_PROCESS в конфигурационном файле Oracle SPFILE. Если вы не указываете этот параметр, Oracle выделяет количество процессов-писателей в зависимости от количества процессоров и процессорных групп на вашем сервере.

<br/><br/>

Oracle также рекомендует, чтобы вы сначала убедились в том, что система использует асинхронный ввод-вывовд,  прежде чем создавать дополнительные прцессы-писатели сверх их числа по умолчанию. В этом случае они вам просто могут не понадоится. (И даже если ваша системе оснащена асинхронны вводом-выводом, это средство может быть не включено). Если ваш писатель базы данных не справляется с объемом работ даже при включенном асинхронном вводе-выводе, стоит рассмотреть возможность увеличения количества процессов-писателей.
<br/><br/>

<h3> Писатель журналов</h3>
<br/><br/>

Задача процесса-писателя журналов заключается в том, чтобы передавать содержимое буфера журналов повторного выполнения на диск. Всякий раз, когда вы проводите изменения в таблице базы данных (будь то вставка обновление или удаление), Oracle пишет зафиксированные и незафиксированные изменения в буфер журнала повторного выполнения (буфер в памяти). Процесс LGWR затем передаст эти изменения из буфера в файлы журналов повторного выполнения на диске. Писатель журналов выполняет запись о фиксации изменений в буфер журнала и немедленно -  в файл журнала на диске, всякий раз, когда пользователь фиксирует транзакцию.
<br/><br/>

Если имеется несколько журналов повторного выполнения (как и должно быть!), то писатель журналов запишет содержимое буфера журнала во все члены группы журналов повторного выполнения. Если один или более членов группы повреждены или недоступны по другой причине, писатель журналов просто выполнит запись в доступные члены группы. Если жен он не сможет писать ни в один из них, то процесс-писатель журнала сообщает экземпляру об ошибке. Всякий раз, когда писатель журнала осуществляет запись в журнал на диске, он  передает все новые элементы журнала, которые появились в буфере с последнего момента копирования его содержимого на диск.



<br/><br/>

Писатель жуналов пишет элементы буфера журнала повторного выполнения при поступлении следующих условий:

<br/><br/>
<ul>
<li> Истечение каждых 3-х секунд</li>
<li> Когда буфер журнала повторного выполнения заполнен на треть</li>
<li> Когда писатель базы данных сигнализирует о необходимости записи журнала повторного выполнения на диск (т.е. в файлы журналов повторного выполнения на диске) перед тем, как файлы данных на диске могут быть модифицированны. В процессе записи «грязных» буферов из буферного кэша на диски, если писатель базы данных обнаружит, что определенная информация повторного выполнения не была записана в файлы журналов повторного выполнения, он сигнализирует писателю журнала, чтобы тот сначала записал эту информацию, чтобы потом он мог записать на диск свою собственную информацию.</li>
<li> В дополнение, как упомяналось ранее, сразу после фиксации транзакции писатель журналов пишет запись о фиксации в журнал повторного выполнения. Файлы журналов повторного выполнения, как вам уже известно, жизненно важны для восстановления баз данных Oracle с потерянных или поврежденных дисков.</li>
</ul>


<br/><br/>

Прежде чем писатель базы данных запишет измененные данные дна диск, он проверяет, что писатель журнала уже завершил запись информации повторного выполнения для измененных данных из буфера журнала на диск, в файлы журналов. Это называется протоколом опережающей записи (write-ahead protocol).

<br/><br/>


При выдаче оператора фиксации (commit), чтобы сделать изменения данных постоянными, писатель журнала сначала помещает запись о фиксации в буфер журнала повторного выполнения и немедленно вносит ее в журнал повторного выполения наряду с информацией, касающейся текущей транзакции. Занесение в журнал записи о фиксации – важнейшее событие, которое отмечает фиксацию транзакции. Всякая зафиксированная транзакция получает номер системного изменения, который вносится писателем журнала в журнал повторного выполнения. База данных использует SCN-номера при восстановлении данных. База данных откладывает изменения блоков данных на диске до более подходящего времени и возвращает код успеха, свидетельствующий об успешной фиксации транзакции, хотя буферы с измененными данными еще не были скопированы в файлы данных на диске. Такая техника подтверждения успеха транзакции с опережением действительной записи измененных блоков данных на диск называется механизмом быстрой фиксации.

<br/><br/>

Файлы журналов повторного выполнения могут содержать записи как о зафиксированных, так и незафиксированных транзакциях – из-за способа, которым писатель журнала вносит записи в журнал повторного выполнения на диске. Если базе данных требуется пространство буфера, писатель журнала может также занести записи из буфера в файл журнала еще до фиксации транзакции. Конечно, база данных заботится о том, чтобы изменения попадали в файлы данных только в случае последующей фиксации транзакции.
<br/><br/>

<h3> Контрольная точка</h3>
<br/><br/>

Процесс контрольной точки (CKPT) отвечает за извещения процесса-писателя базы данных о том, когда ему следует записывать «грязные» данные из буферов памяти на диск. После того, как процесс CKPT известит писатель о необходимост итакой записи, он обновляет заголовки файла данных и управляющий файл, занося туда детали, касающиеся контрольной точки, включая время ее создания. Назначения процесса контрольно точки сототи в синхронизации информации буферного кэша с информацией на диске с базой данных.
<br/><br/>

Каждая запись контрольной точки состоит из списка всех активных транзакций и адреса последней записи журнала для этих транзакций. Процесс создания контрольной точки включает следующие шаги:

<br/><br/>

1)	Сброс содержимого буферов журнала повторного выполнения в файлы журнала повторного выполнения в файлы журнала повторного выполнения. <br/>
2)	Внесение записи контрольной точки в файл журнала повторного выполнения. <br/>
3)	Сброс содержимого буферного кэша базы данных на диск. <br/>
4)	Обновление заголовков файла данных и управляющих файлов после завершения контрольной точки. <br/>

<br/><br/>


Существует тесная связь межу частой выполнения Oracle операций контрольной точки и временем восстановления после краха базы данных. Поскольку процессы-писатеи баз данных пишут все модифицированные блоки на диск в контрольной точке, чем чаще создаются контрольные точки, тем меньше данных придется восстанавливать в случае краха экземпляра. Однако создание контрольных точек влечет за собой накладные расходы. Oracle позволяет конфигурировать базу данных для автоматической настройки контрольных точек, посредством которой сервер базы данных пытается писать грязные буферы наиболее эффективным способом, с минимальным отрицательным влиянием на производительность. Если вы используете автоматическую настройку контрольных точек, не потребуется устанавливать никаких параметров, связанных с этим.
<br/><br/>

<h3> Монитор процессов</h3>
<br/><br/>

Когда пользовательский процесс терпит неудачу, процесс монитора процессов (PMON) убирает за ним, гарантируя освобождение ресурсов базы данных, использовавшихся умершим процессом. Например, когда пользовательский процесс умирает, удерживая определенные блокировки таблиц, процесс PMON освобождает эти блоки, так что другие пользователи могут использовать таблицы без какой-либо зависимости от умершего процесса. В добавок процесс PMON просыпаясь через регулярные интервалы, чтобы проверить, не возникал ли в нем необходимость. Другие процессы также могут разбудить PMON при необходимости.

<br/><br/>


Процесс PMON автоматически выполняет динамическую регистрацию службы. Когда вы создаете новый экземпляр базы данных, процесс PMON регистрирует информацию экземпляра со слушателем, который является входной точкой, управляющей запросами соединений. Динамическая регистрация служб исключает потребность в регистрации информации о новой службе в файле listener.ora, который является конфигурационным файлом слушателя.

<br/><br/>

<h3> Системный монитор</h3>
<br/><br/>

Процесс системного монитора (SMON), как следует из его названия, выполняет задачи мониторинга системы для экземпляра Oracle, например, такие, как перечисленные ниже.

<br/><br/>
<ul>

<li> При перезапуске экземпляра, потерпевшего сбой, SMON определяет целостность базы данных.</li>
<li> SMON объединяет свободные экстенты, если вы используете локально управляемые табличные пространства, что позволяет выделять более крупные непрерывные участки дискового пространства объектам вашей базы данных.</li>
<li> SMON очищает необходимые временные сегменты.</li>
</ul>




<br/><br/>

Подобно PMON, процесс SMON спит большую часть времени, просыпаясь для проверки, не возникла ли в нем необходимость. Другие процессы также могут разбудить процесс SMON, если это им необходимо.
<br/><br/>

<h3> Архиватор</h3>
<br/><br/>

Процесс архиватора (ARCn) используется, когда система работает в архивируемом режиме – т.е., когда изменения, протоколируемые в файлах журналов повторного выполнения, сохраняются и не перезаписываются новыми изменениями. Если вы запускаете вашу базу данных в неархивируемом режиме. Oracle перезаписывает файлы журналов повторного выполнения новыми записями. Если е вы работаете в архивируемом режиме, такая перезапись не происходит – каждый заполненный журнал сохраняется и архивируется в определенном месте.
<br/><br/>

База данных делает доступной для архивации группу журналов повторного выполнения сразу по завершении переключения журналов. Задача процесса ARCn состоит в том, чтобы скопировать один из заполненных членов группы журналов повторного выполнения в архивный файл журнала повторного выполнения, и группа 1 содержит члены a_log1 и b_log1, фоновый процесс архиватора скопирует любой из двух членов. Этот архивный файл журнала повторного выполнения включит в себя записи повторного выполнения  из члена группы журналов.
<br/><br/>

Процесс архиватора поместит файлы журналов в место, которое специфицируется в SPFILE или файле init.ora. Архивированный журнал повторного выполнения включит в себя все копии каждой группы, созданные с момента включения архивирования в базе данных. Обычно вы будете копировать архивированные журнала на магнитную ленту и отправлять их в хранилище, чтобы иметь полный набор резервных копий и архивных журналов, получи возможность при необходимости провести восстановление базы данных. Архивные журналы повторного выполнения также полезны для обновления баз данных в состоянии ожидания и для исследования старых данных с помощью утилиты LogMiner.

<br/><br/>

Если в базе данных проводится огромное число изменений, и журналы заполняются очень быстро, вы можете использовать несколько процессов архиватора – плоть о 30 (от ARC0 до ARCn). Параметр LOG_ARCHVE_MAX_PROCESS в инициализационном файле определяет количество процессов архивации, которое Oracle запустит изначально. Если процесс записи журналов пишет их быстрее, чем единственный процесс архивации по умолчанию может их архивировать, то процесс LGWR автоматически запускает новый новый процесс ARCn, тем самым увеличивая их количество свыше 2 по умолчанию. Поскольку база данных автоматически запускает дополнительные процессы, чтобы успевать сохранять генерируемые журналы повторного выполнения, вам на самом деле незачем устанавливать параметр LOG_ARCHIVE_MAX_PROCESSES. Поскольку это динамический парамет, его можно изменять в процессе работы базы данных, как показано ниже:
<br/><br/>

SQL> ALTER SYSTEM SET LOG_ARCHIVE_MAX_PROCESSES=8;
<br/><br/>

<h3> Процессы, относящиеся к ASM</h3>
<br/><br/>


Несколько фоновых процессов появляются только в том случае, если используется система автоматического управления хранилищем (Automatic Storage Management, ASM).
<br/><br/>

Ниже приводится список процессов, связанных с ASM.

<br/><br/>
<ul>
<li>Процесс мастера балансировки (RBAL, rebalance master) координирует балансировку дисковой активности при использовании системы хранилища на основе ASM.</li>
<li>Процессы балансировки ASM (ARBn) выполняют балансировку дисковой активности в экземпляре ASM. </li>
<li>Фоновый процесс ASM (ASMB) присутствует во всех базах данных Oracle, использующих систему хранения ASM. Процесс ASMB взаимодействует с экземпляром ASM, подключаясь к экземпляру ASM как процесс переднего плана. </li>

</ul>

<br/><br/>

<h3> Прочие фоновые процессы</h3>
<br/><br/>

Писатель базы данных, писатель журналов, архиватор и процесс контрольных точек – все их чаще всего называют фоновыми процессами. Однако Oracle Database 11g может иметь и другие фоновые процессы, запущенные для поддержки экземпляра.
<br/><br/>

Ниже кратко описаны наиболее важные из них.
<br/><br/>
<ul>
<li>Монитор управляемости (manageability monitor) собирает несколько типов статистики, помогающей базе данных управлять собой, таких, например, как информация снимков AWR, являющаяся основой диагностических возможностей базы данных. В дополнение MMON подает сигнал тревоги, когда показатель базы данных пересекают свои пороговые значения. </li>
<li>Облегченный монитор управляемости (manageability monitor light), выглядящий как Manageability Monitor Process 2, когда вы опрашиваете представление V$BGPROCESS. Этот процесс сбрасывает данные из хронологии активного сеанса (Active Session History – ASH) на диск при всяком заполнении буфера. Процесс MMNL также выполняет  и другие задачи, связанные с управляемостью, наподобие фиксации данных хронологии сеансов и вычисления показателей (метрик) базы данных. </li>
<li>Диспетчер памяти (memory manager) координирует размеры компонентов памяти. </li>
<li>Процесс координации очереди сообщений (job queue coordination) используется Oracle для планировании пользовательских задач. Этот процесс CJQO динамически запускает подчиненные процессы очереди задач (от J000 до J999), выполняющие пользовательские задания. Когда вы включаете средство ретроспективы баз данных. Oracle запускает процесс писателя восстановления (recovery writer – RVWR) для записи ретроспективных данных из буфера ретроспективных данных в журналы ретроспективы. В определенном смысле работа RVWR аналогична том, что делает фоновый процесс LGWR. </li>
<li>Oracle отслеживает физическое местоположение изменений базы данных в новом файле, называемом файлом отслеживания изменений (change tracking file). Recovery Manager – утилита резервного копирования Oracle – использует файл слежения за изменениями для ускорения создания инкрементных резервных копий за счет исключения полного чтения файлов данных. Процесс писателя, следящий за изменениями (change-tracking writer – CTWR) – это новый фоновый процесс Oracle, который пишет информацию об изменениях в файл изменений. </li>
<li>Процесс восстановителя (recover – RECO) используется для координации распределенных баз данных и других специализированных процессов. </li>
<li>Архиватор ретроспективных данных (flashback data archiver - FBDA) – процесс, отвечающий за запись изменений в таблицы, для которых включено архивирование ретроспективных данных в таблицах хронологии. </li>
<li>Фоновый процесс кэша результатов (result cache background - RCBG) – процесс, отвечающий за управление кэшем результатов. </li>

<br/><br/>

Помимо упомянутых здесь процессов в системе могут работать и другие фоновые процесс Oracle, выполняющие специализированные задачи. Например, если вы используете Oracle Real Application Cluster, то увидите фоновый процесс под названием процесса блокировок (LOCKn), отвечающий за выполнение блокировок экземпляра.



</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
