﻿<html>

<?php include_once "_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "_pagenav.php"?>



<br/><br/><br/>
<h2>Индексы Oracle</h2><br/>

Индексы Oracle обеспечивают быстрый доступ к строкам таблиц, сохраняя отсортированные значения указанных столбцов и используя эти отсортированные значения для быстрого нахождения ассоциированных строк таблицы . Индексы позволяют находить строку с определенным значением столбца, просматривая при этом лишь небольшую часть общего объема строк таблицы. Таким образом правильное использование индексов сокращает до минимума количество дорогостоящих операций ввода-вывода.
<br/><br/>
Применение индексов представляет собой компромисс между ускорением получения результатов запросов и замедлением обновлений и вставок данных. Первая часть этого компромисса – ускорение запросов – довольно очевидна: если поиск выполняется по отсортированному индексу вместо полного сканирования всей таблиц, то запрос проходит намного быстрее. Но всякий раз, когда вы обновляете, вставляете или удаляете строку таблицы с индексами, индексы также должны быть обновлены соответствующим образом. То есть такие операции на таблицах с индексами обходятся дороже. 
<br/><br/>

Вообще говоря, если таблицы в основном используются для чтения (выборки) информации, как в хранилищах данных, то лучше иметь много индексов. Если база данных относится к типу OLTP, с большим количеством вставок, обновлений и удалений, то лучше обойтись меньшим числом индексов.
<br/><br/>

Если только вам не нужно обращаться к большинству сток таблицы, индексированные запросы обеспечивают более быстрое получение результатов, чем запросы, не использующие индексы. Не существует ограничений на количество индексов, которые могут относиться к одной таблице Oracle, но, как упоминалось ранее, от их количества зависит производительность. Индекс полностью прозрачен для пользователя – т.е. оператор SQL пользователя не должен изменяться в результате создания индексов. Однако разработчикам приложений для построения эффективных запросов следует хорошо представлять себе , что такое индексы и как они работают.
<br/><br/>

Индексы могут относиться к нескольким типам, наиболее важные из которых перечислены ниже:

<br/><br/>

<ul>

<li> Уникальные и неуникальные индексы.  Уникальные индексы основаны на уникальном столбце – обычно вроде номера карточки социального страхования сотрудника. Хотя уникальные индексы можно создавать явно, Oracle не рекомендует это делать. Вместо этого следует использовать уникальные ограничения. Когда накладывается ограничение уникальности на столбец  таблицы, Oracle автоматически создает уникальные индексы по этим столбцам.</li>
<li> Первичные и вторичные индексы. Первичные индексы – это уникальные индексы в таблице, которые всегда должны иметь какое-то значение и  не могут быть равны null. Вторичные индексы – это прочие индексы таблицы, которые могут и не быть уникальными.</li>
<li> Составные индексы – индексы, содержащие два или более столбца из одной и той же таблицы. Они также известны как сцепленные индексы (concatenated index). Составные индексы особенно полезны для обеспечения уникальности сочетания столбцов таблицы в тех случаях, когда нет уникального столбца, однозначно идентифицирующего строку.</li>
</ul>

<h2> Руководство по созданию индексов</h2>

Хотя хорошо известно, что индексы повышают производительность базы данных, следует знать, как их заставить работать должным образом.  Добавление ненужных или неподходящих индексов к таблице может даже привести к снижению производительности. Ниже предоставлены некоторые рекомендации по созданию эффективных индексов в базе данных Oracle.
<br/><br/>

<ul>
<li> Индекс имеет смысл, если нужно обеспечить доступ одновременно не более чем к 4-5% данных таблицы. Альтернативной использования индекса для доступа к данным строки является полное последовательное чтение таблицы от начала до конца, что называется полным сканированием таблицы. Полное сканирование таблицы больше подходит для запросов, которые требуют извлечения большего процента данных таблицы. Помните, что применение индексов для извлечения строк требует двух операций чтения: индекса и затем таблицы.</li>
<li> Избегайте создания индексов для сравнительно небольших таблиц. Для таких таблиц больше подходит полное сканирование. В случае маленьких таблиц нет необходимости в хранении данных и таблиц, и индексов.</li>

<li> Создавайте первичные ключи для всех таблиц. При назначении столбца в качестве первичного колюча Oracle автоматически создаст  индекс по этому столбцу.</li>
<li> Индексируйте столбцы, участвующие в  многотабличных операциях соединения.</li>
<li> Индексируйте столбцы, которые часто используются в конструкциях WHERE.</li>
<li> Индексируйте столбцы, участвующие в операциях ORDER BY и GROUP BY или других операциях, таких как UNION и DISTINCT, включающих сортировку. Поскольку индексы уже отсортированы, объем  работы по выполнению необходимой сортировки данных для упомянутых операций будет существенно сокращен.</li>

<li> Столбцы, стоящие из длинно-символьных строк, обычно плохие кандидаты на индексацию.</li>

<li> Столбцы, которые часто обновляются, в идеале не должны быть индексированы из-за связанных с этим накладных расходов.</li>
<li> Индексируйте таблицы в которых мало строк имеют одинаковые значения.</li>
<li> Сохраняйте количество индексов небольшим.</li>
<li> Составные индексы могут понадобиться там, где одностолбцовые значения сами по себе не уникальны. В составных индексах первым столбцом ключа должен быть столбец в котором количество строк с одинаковым значением минимально.</li>
</ul>

<br/><br/>

Всегда помните золотое правило индексации таблиц: индекс таблицы должен быть основан на типах запросов, которые будут выполняться над столбцами этой таблицы. На таблице можно создавать более одного индекса: например, можно создать индекс на столбце X, или столбце Y, или обоих сразу, а также один составной индекс на обоих столбцах. Принимая правильное решение относительно того, какие индексы следует создавать, подумайте о наиболее часто используемых типах  запросов данных таблицы.
<br/><br/>

<h2> Схемы индексации Oracle </h2>

Oracle предлагает несколько схем индексации, соответствующих требованиям различных типов приложений. На фазе проектирования после тщательного анализа конкретных требований приложения, необходимо выбрать правильный тип индекса.
<br/><br/>

<h2> (B*tree)</h2>
<br/><br/>

В реализации индексов на основе B-деревьев используется концепция сбалансированного (на что указывает буква ‘B’ (balanced)) дерева поиска в качестве основы структуры индекса. В Oracle имеется собственный вариант B-дерева. Это обычные индексы, создаваемые по умолчанию, когда вы применяете оператора CREATE INDEX.
<br/><br/>

Индексы на основе B-деревьев структурированы в форме обратного дерева, где блоки верхнего уровня называются блоками ветвей (branch blocks), а блоки нижнего уровня – листовыми блоками (leaf blocks). В иерархии узлов все узлы кроме вершины, или корневого узла, имеют родительский узел и могут иметь ноль или более дочерних узлов. Если глубина древовидной структуры , т.е. количество уровней, одинакова от каждого листового блока до корневого узла, то такое дерево называется сбалансированным, или B-деревом.
<br/><br/>

B-деревья автоматически поддерживают необходимый уровень индекса по размеру таблицы. B-деревья также гарантируют, что индексные блоки всегда будут заполнены не меньше, чем наполовину, и менее, чем на 100%. B-деревья допускают операции выборки, вставки и удаления с очень небольшим количеством операций ввода-вывода на один оператор. Большинство B-деревьев имеет всего три и менее уровней. При использовании B-дерева нужно читать только блоки B-дерева, так что количество операций ввода-вывода будет ограничено числом уровней B-дерева (скажем, тремя) плюс две операции ввода-вывода на выполнение обновления или удаления (одна для чтения и одна для записи). Для выполнения поиска по B-дереву понадоисят всего три или менее обращений к диску.
<br/><br/>

Реализация B-дерева от Oracle – всегда сохраняет дерево сбалансированным. Листовые блоки содержат по два элемента: индексированные значения столбца и соответствующий идентификатор ROWID для строки, которая содержит это значение столбца. ROWID – уникальный указатель Oracle, идентифицирующий физическое местоположение строки и обеспечивающий самый быстрый способ доступа к строке в базе данных Oracle. Сканирование индекса быстро дает ROWID строки,  и отсюда можно быстро получить к ней доступ непосредственно. Если запрос нуждается лишь в значении индексированного столбца, то конечно, последний шаг исключается, поскольку извлекать дополнительные данные, кроме прочитанных из индекса, не потребуется.
<br/><br/>

<h2> Оценка размера индекса</h2>


Для оценки размера нового индекса можно использовать пакет DBMS_SPACE. Процедуре CREATE_INDEX_COST этого пакета потребуется передать оператор DDL, создающий индекс, в качестве атрибута.
<br/><br/>

<pre>
SET SERVEROUTPUT ON
DECLARE
l_index_ddl varchar2(1000);
l_used_bytes NUMBER;
l_allocated_bytes NUMBER;
BEGIN 
DBMS_SPACE.create_index_cost (
ddl => 'create index repsons_idx on EMP(ENAME)',
used_bytes => l_used_bytes,
alloc_bytes => l_allocated_bytes);
DBMS_OUTPUT.PUT_LINE ('RESULT:');
DBMS_OUTPUT.PUT_LINE ('used_bytes = ' || l_used_bytes || ' byte');
DBMS_OUTPUT.PUT_LINE ('alloc_bytes = ' || l_allocated_bytes || ' byte');
END;
/
</pre>

<br/><br/>

Обратите внимание на отличие между атрибутами, касающимися размера, в процедуре CREATE_INDEX_COST:
<br/><br/>
<ul>
<li> Used_bytes показывает количество байт, которыми представлены данные индекса;</li>
<li> Alloc_bytes показывает количество байт, которое займет индекс в табличном пространстве после его создания. </li>
</ul>


<h2> Создание индекса</h2>
<br/><br/>
Индекс создается с помощью оператора CREATE INDEX
<br/><br/>


CREATE INDEX employee_id ON employee(employee_id) <br/>
TABLESPACE MY_INDEXES;
<br/><br/>

По умолчанию Oracle допускает дублирование значения в столбцах индекса, которые также называются ключевыми столбцами. Однако можно специфицировать уникальный индекс, что исключит дублирование значений столбца в нескольких строках. 

<br/><br/>

Для создания уникального индекса служит оператор CREATE UNIQUE INDEX.
<br/><br/>

<h2> Специальные типы индексов</h2>


Нормальный или типовой индекс, который создается в базе данных, называется индексом кучи (heap index), или неупорядоченным индексом. Oracle также предоставляет несколько специальных типов индексов для специфических нужд. 
<br/><br/>

<h2> Битовые индексы (bitmap indexes)</h2>

Битовые индексы используют битовые карты для указания значения индексированного столбца. Это идеальный индекс для столбца с низкой кардинальностью (число уникальных записей в таблице мало) при при большом размере таблицы.  Эти индексы обычно не годятся для таблиц с интенсивным обновлением, но хорошо подходят для приложений хранилищ  данных.

<br/><br/>


Битовые индексы состоят из битового потока (единиц и нулей) для каждого столбца индекса. Битовые индексы очень компактны по сравнению с нормальными индексами на основе B-деревьев. 

<br/><br/>

<table border="1">
<tr>
<td>Индексы B-деревьев</td>
<td>Битовые индексы</td>
</tr>
<tr>
<td>Хороши для данных с высокой кардинальностью</td>
<td>Хороши для данных с низкой кардинальностью</td>
</tr>
<tr>
<td>Хороши для баз данных OLTP</td>
<td>Хороши для приложений хранилищ данных OLAP</td>
</tr>
<tr>
<td>Занимают много места</td>
<td>Используют, относительно мало места</td>
</tr>
<tr>
<td>Легко обновляются</td>
<td>Трудно обновляются</td>
</tr>
</table>


<br/><br/>

Для создания битового индекса используется оператор <br/><br/>
CREATE BITMAP INDEX  gender_dx ON employee(gender) <br/>
TABLESPACE MY_INDEXES; <br/>

<br/><br/>

Иногда можно наблюдать значительное повышение производительности при замене обычных индексов B-дерева на битовые в некоторых очень крупных таблицах. Однако каждый элемент битового индекса открывает огромное количество строк в таблице, так что когда данные обновляются,вставляются или удаляются из таблицы, то необходимые обновления битового индекса очень велики., и сам индекс может существенно увеличиться в размере. Единственный способ обойти это увеличение размера индекса с последующим падением производительности заключается в регулярной его перестройке. Битовый индекс – не слишком разумная альтернатива для таблиц, подвергающихся большому количеству вставок, удалений и обновлений.
<br/><br/>

<h2> Индексы с реверсированным ключом</h2>

Индексы с реверсированным ключом – это, по сути, то же самое, что и индексы B-деревьев, за исключением того, что байты данных ключевого столбца при индексации меняют порядок на противоположный. Порядок столбцов остается нетронутым, меняется только порядок  байтов. Самое большое преимущество применения индексов с реверсивным ключом состоит в том, что они исключают неприятные последствия упорядоченной вставки значений в индекс. Вот как создается индекс с реверсированным ключом:
<br/><br/>


SQL> CREATE INDEX reverse_idx ON employee(emp_id) REVERSE;
<br/><br/>

При использовании индекса с реверсированным ключом базы данных не сохраняет ключи индекса друг за другом в лексикографическом порядке. Таким образом, когда в запросе присутствует предикат неравенства, ответ получается медленнее, поскольку база данных вынуждена выполнять  полное сканирование таблицы. При индексе с реверсированным ключом база данных не может запустить запрос по диапазону ключа индекса.

<br/><br/>

<h2> Индексы со сжатым ключом</h2>

Сэкономить пространство хранения индекса вместе с повышением производительности можно за счет создания индекса со сжатым ключом. Всякий раз, когда индексируемый ключ имеет повторяющийся компонент, или же создается уникальный многостолбцовый индекс, получается выигрыш от использования сжатия ключа. Вот пример:
<br/><br/>

SQL> CREATE INDEX emp_indx1 ON employees(ename) <br/>
TABLESPACE MY_INDEXES<br/>
COMPRESS 1; <br/>
<br/><br/>

Приведенный выше оператор сжимает все дублированные вхождения индексированного ключа в листовом блоке индекса (на уровне 1).
<br/><br/>

<h2> Индексы на основе функций</h2>

Индексы на основе функций предварительно вычисляют значения функций по заданному столбцы и сохраняют результат в индексе. Когда конструкция WHERE содержит вызовы функций, то основанные на функциях индексы являются идеальным способом индексирования столбца.

<br/><br/>

Ниже показано, как создать индекс на основе функции LOWER
<br/>
<br/>
SQL> CREATE INDEX lastname _idx ON employees(LOWER(l_name));

Этот оператор CREATE INDEX создаст индекс по столбцу l_name, хранящему фамилии сотрудников в верхнем регистре. Однако этот индекс будет основан на функции, поскольку база данных создаст его по столбцу l_name, применив  к нему предварительно функцию LOWER для преобразования его значения в нижний регистр.
<br/><br/>

<h2> Секционированные индексы</h2>


Секционированные индексы используются для индексации секционированных таблиц. Oracle предлагает два типа индексов для таких таблиц: локальные и глобальные.
<br/><br/>

Существенное различие между ними заключается в том, что локальные индексы основаны на разделах таблицы, по которой они созданы. Если таблица секционирована на 12 разделов по диапазонам дат, то индексы также будут распределены по тем же 12 разделам. Другими словами, между разделами индексов и разделами таблиц существует соответствие «один к одному». Такого соответствия нет между глобальными индексами и разделами таблицы, потому что глобальные индексы секционируются независимо от базовых таблиц.
<br/><br/>

В следующих разделах будут раскрыт важные различия между управлением глобального секционированными индексами и локально секционированными индексами.
<br/><br/>

<h2> Глобальные индексы</h2>

Глобальные индексы на секционированных таблицах могут быть как секционированными, так и несекционированными. Глобальные несекционированные индексы подобны обычным индексам Oracle для несекционированных таблиц. Для создания таких индексов применяется обычный синтаксис CREATE INDEX.
<br/><br/>

Ниже приведен пример глобального индекса на таблице ticket_sales:
<br/><br/>

SQL> CREATE INDEX tickersales_idx ON ticket_sales(month) <br/>
GLOBAL  PARTITION BY range(month) <br/>
(PARTITION ticketsales1_idx VALUES LESS THAN (3) <br/>
PARTITION ticketsales1_idx VALUES LESS THAN (6) <br/>
PARTITION ticketsales2_idx VALUES LESS THAN (9) <br/>
PARTITION ticketsales3_idx VALUES LESS THAN (MAXVALUE);

<br/><br/>

Обратите внимание, что управление глобально секционированными индексами требует серьезных усилий. Всякий раз, когда происходит какое-т о действие DDL над секционированной таблицей, ее глобальные индексы требуют перестройки. Действия DDL над лежащей в основе таблице помечают глобальные индексы как недействительные. По умолчанию любая операция обслуживания секционированной таблицы делает недействительными глобальные индексы.
<br/><br/>

Давайте в качестве примера воспользуемся таблицей ticket_sales, чтобы разобраться, почему это так. Предположим, что вы ежеквартально уничтожаете самый старый раздел, чтобы освободить место для нового раздела, в который поступят данные за новый квартал. Когда уничтожается раздел, относящийся к таблице ticket_sales, глобальные индексы могут стать недействительными, потому что часть данных, на которые они указывают, перестают существовать. Чтобы предотвратить такое объявление недействительным индекса из-за уничтожения раздела, необходимо использовать опцию UPDATE GLOBAL INDEXES вместе с оператором DROP PARTITION:

<br/><br/>

SQL> ALTER TABLE ticket_sales<br/>
DROP PARTITION sales_quarter01<br/>
UPDATE GLOBAL INDEXES; <br/>

<br/><br/>

Если не включить оператор UPDATE GLOBAL INDEXES, то все глобальные индексы станут недействительными. Опцию UPDATE GLOBAL INDEXES можно также использовать при добавлении, объединении, обмене, слиянии, перемещении, разделении или усечении секционированных таблиц. Разумеется, с помощью ALTER INDEX..REBUILD можно перестраивать любой индекс, который становится недействительным, но эта опция также требует дополнительных затрат времени и обслуживания.
<br/><br/>

При небольшом количестве листовых блоков индекса, что приводит к высокой конкуренции Oracle рекомендует использовать глобальные индексы с хэш-секционированием. Синтаксис для создания хэш-секционированного глобального индекса подобен тому, что применяется для хэш-секционированной таблицы. Например, следующий оператор создает хэш-секционированный глобальный индекс:
<br/><br/>

SQL> CREATE INDEX hgidx ON tab (c1,c2,c3) GLOBAL<br/>
PARITION BY HASH (c1,c2) <br/>
(<br/>
PARTITION p1 TABLESPACE tsb_1, <br/>
PARTITION p2 TABLESPACE tsb_2, <br/>
PARTITION p3 TABLESPACE tsb_3, <br/>
PARTITION p4 TABLESPACE tsb_4, <br/>
); <br/>
<br/><br/>

<h2> Локальные индексы</h2>

Локально секционированные индексы, в отличие от глобально секционированных индексов, имею отношение «один к одному» с разделами таблицы. Локально секционированные индексы можно создавать в соответствии с разделами и даже подразделами. База данных конструирует индекс таким образом, чтобы он был секционирован так же, как и его таблица. При каждой модификации раздела таблицы база автоматически сопровождает это соответствующей модификацией раздела индекса. Это, наверное,  самое большое преимущество использования локально секционированных индексов – Oracle автоматически перестраивает их всегда, когда уничтожается раздел или над ним выполняется какая-то другая операция DDL.
<br/><br/>

Ниже приведен простой пример создания локально секционированного индекса на секционированной таблице:
SQL> CREATE INDEX ticket_no_idx ON<br/>
Ticket_sales(ticket_no) LOCAL<br/>
TABLESPACE localidx_01; <br/>
<br/><br/>

<h2> Невидимые индексы</h2>

По умолчанию оптимизатор «видит» все индексы. Тем не менее, можно создать невидимый индекс, который оптимизатор не обнаруживает и не принимает во внимание при создании плана выполнения оператора. Невидимый индекс можно применять в качестве временного индекса для определенных операций или его тестирования перед тем, как сделать его «официальным». Вдобавок, иногда объявления индекса невидимым можно использовать в качестве альтернативы уничтожению индекса или объявлению его недоступным. Сделать индекс невидимым можно временно, чтобы протестировать эффект от его уничтожения.
<br/><br/>

База данных поддерживает невидимый индекс точно так же, как и нормальный (видимый) индекс. После объявления индекса невидимым, его и все прочие невидимые индексы можно сделать вновь видимым для оптимизатора, установив значение параметра optimizer_use_invisible_index равным TRUE на уровне сеанса или всей системы. Значением этого параметра по умолчанию является FALSE, а это означает, что оптимизатор по умолчанию не может использовать невидимые индексы.
<br/><br/>

Создание невидимого индекса.
<br/><br/>

Чтобы сделать индекс невидимым, к оператору CRETE INDEX нужно добавить конструкцию INVISIBLE.
<br/><br/>

С помощью команды ALTER INDEX можно превратить существующий индекс в невидимый.
<br/><br/>

ALTER INDEX  test_idx INVISIBLE;
<br/><br/>
И обратная команда<br/><br/>
ALTER INDEX  test_idx VISIBLE;
<br/><br/>
Приведенный ниже запрос к представлению DBA_INDEXES показывает состояние видимости индекса:
<br/><br/>

SELECT index_name, visibility <br/>
FROM user_indexes<br/>
WHERE index_name =’indx1’; <br/>

<h2> Мониторинг использования индекса</h2>


Если вы сомневаетесь в использовании определенного индекса, можете попросить Oracle выполнить мониторинг его применения. Таким образом, если индекс окажется избыточным, его можно уничтожить и сэкономить место в хранилище, а также снизить накладные расходы на операции DML.
<br/><br/>

Опишем, что потребуется сделать для отслеживания индекса в базе данных. Предположим, что вы пытаетесь узнать, используется ли индекс p_key_sales в определенных запросах к таблице sales. Обеспечьте репрезентативный промежуток времени для оценки использования индекса. Для базы данных OLTP это промежуток может быть относительно коротким. Для хранилища данных может понадобится запустить тестовый мониторинг на несколько дней, чтобы точно проверить, как используется индекс.
<br/><br/>

Чтобы запустить мониторинг использования индекса, войдите в базу данный как владелец индекса p_keyPsales и запустите следующую команду:
<br/><br/>
SQL> ALTER INDEX p_key_sales MONITORING USAGE;
<br/><br/>

Теперь запустите какие-нибудь запросы к таблице sales. Завершите мониторинг, применив следующую команду:

<br/><br/>
SQL> ALTER INDEX p_key_sales NOMONITORING USAGE;
<br/><br/>

После этого можно запросить представление словаря данных V$OBJECT_USAGE для определения того, используется ли индекс p_key_sales. 
<br/><br/>
SELECT index_nm, used FROM v$object_usage<br/>
WHERE index_name=’P_KEY_SALES’;
<br/><br/>

Причина по которой нельзя узнать количество случаев использования индекса, связана с тем, что база данных выполняет мониторинг его использования только на фазе разбора (parsing);  если бы разбор производился при каждом выполнении, пострадала бы производительность.
<br/><br/>

<h2> Обслуживание индексов</h2>


Данные индекса постоянно изменяются из-за DML-действий, связанных с его таблицей. Индексы часто становятся слишком большими, если происходит много удалений сток, потому что пространство, занятое удаленными значениями, автоматически повторно индексом не используется. За счет периодического применения команды REBUILD можно реорганизовать индексы и сделать их более компактными, а потому и более эффективными. Команда REBUILD также служит для изменения параметров хранения, которые устанавливаются во время начального создания индекса. 
<br/><br/>

ALTER INDEX sales_idx REBUILD;
<br/><br/>

Перестройка индексов лучше уничтожения и воссоздания неудачного индекса, потому что при этой операции пользователи продолжают иметь доступ к индексу в процессе его перестройки. Однако индексы в процессе перестройки накладывают много ограничений на действия пользователя. Еще более эффективный способ перестройки индексов состоит в том, чтобы сделать это в оперативном (online) режиме, как показано в следующем примере. Во время оперативной перестройки индекса разрешено применение всех операций DML, но не операций DDL.
<br/><br/>

ALTER INDEX sales_idx REBUILD ONLINE;
<br/><br/>

Оперативную перестройку индекса можно ускорить за счет добавления к показанному выше оператору ALTER INDEX конструкции ONLINE NOLOGGING. После добавления этой конструкции база данных не будет генерировать данные повторного выполнения для операции перестройки индекса.



</div>		
		
	

<?php include_once "_footer.php"?>

</body>

</html>
