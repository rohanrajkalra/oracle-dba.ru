﻿<html>

<?php include_once "../../_header.php"?>


<body>




<br/><br/>

<div class="link">
<?php include_once "../../_pagenav.php"?>



<br/><br/><br/>
<h2>[Oracle Database Data Warehousing]:</h2>
<br/><br/>





<strong>Пространственное моделирование (Dimensional Modeling)</strong> 

<br/><br/>

Альтернативой модели связи сущностей является пространственная модель, которая отличается от предыдущей тем, что смотрит на данные с другой точки зрения. Вместо рассмотрения сущности, которая представляет собой некоторую вещь, такую как продукт или место, и связей между такими сущностями, пространственная модель описывает данные с помощью измерений (dimensions) и фактов (facts), которые и становятся конкретными таблицами базы данных.

<br/><br/>

	<div align = "center">
		<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/database/warehouse/Dimensional_Modeling.jpg" border="0" alt="Dimensional Modeling">
	</div>

<br/><br/>

Пространственная модель, несмотря на то, что она иногда выглядит очень простой, обеспечивает очень эффективный способ хранения текущих и исторических данных в такой форме, которая делает эти данные доступными пользователям и дает им возможность принимать правильные бизнес-решения. 




<br/><br/>
<strong>Таблица фактов</strong> 

<br/><br/>

Таблица фактов (таблиц может быть более одной) содержит фактическую информацию, является обычно самой большой таблицей в хранилище и, как правило, быстро растет. Именно в таблицах фактов, как правило, сохраняются подробные данные, которые вы хотите держать в хранилище, например все телефонные звонки, сделанные клиентом, или заказы, сделанные покупателем.

<br/><br/>

Следовательно, если клиент совершил 20 телефонных звонков, то, скорее всего, в таблице фактов, относящейся к данному клиенту, будет сохранено 20 строк.

<br/><br/>

В результате таблицы фактов, безусловно, будут самыми крупными таблицами базы данных, и в больших хранилищах они могут содержать сотни миллионов строк. Степень подробности данных, хранимых в таблице фактов, называется глубиной детализации (granularity) и является одним из важных проектных решений, которое должен принять разработчик хранилища данных. 
<br/><br/>


При разработке хранилища вы, в зависимости от рода вашего бизнеса, можете столкнуться с тем, что существуют разные виды таблиц фактов, например уровня транзакций, уровня элементов транзакций, зависимые от событий, или даже таблицы для объединенных данных.

<br/><br/>
<strong>Таблица измерений</strong> 


<br/><br/>

При проектировании с использованием пространственной модели может существовать только одна таблица фактов или лишь небольшое их число, но может быть множество таблиц измерений. Таблицу измерений можно рассматривать как справочную таблицу по отношению к таблице фактов, где хранятся описания и более статическая информация об элементе данных. Например, «продукт» считается измерением потому, что в данной таблице сохраняется вся информация о продукте, в частности его полное название, поставщики и габаритные
размеры. 

<br/><br/>

Если вы не знаете, являются ли некоторые данные измерением или фактом, задайте себе такой вопрос: «Являются ли эти данные относительно статичными?». Как правило, измерения, например идентификатор продукта, меняются нечасто, в то время как таблица фактов будет содержать сведения о продажах продуктов.
<br/><br/>

Таблица фактов содержит миллионы строк, тогда как таблицы измерений — только несколько. Например, измерение Регион может содержать только 15 строк, если в стране имеется только 15 регионов. Измерения не обязательно должны быть маленькими. Вы можете продавать 50000 продуктов или иметь измерение "Покупатели" с 5 миллионами строк. Все это — примеры допустимых измерений.

<br/><br/>

Трудно сказать, сколько измерений потребуется для вашего случая, но как правило, бывает не более 20 измерений и не менее 4. Следовательно, наше хранилище будет состоять всего из нескольких таблиц, но у него будут большие запросы на объемы записанной информации из-за количества строк в таблице фактов.

<br/><br/>
<strong>Ключи хранилища</strong> 


<br/><br/>

Данные, скорее всего, будут поступать в хранилище из многих источников, и код продукта в одной системе может отличаться от другой. Еще одна проблема состоит в том, что, когда данные хранятся в течение определенного периода времени, ключи, применяемые в рабочей системе, могут использоваться повторно. Следовательно, разработчик должен серьезно подумать о реализации ключей-заменителей (surrogate keys), которые имели бы полный контроль над идентификацией данных в хранилище. Преобразование ключа рабочей системы в ключ хранилища обрабатывается в ходе загрузки данных при помощи ETL и потребляет незначительный объем ресурсов. Преобразовать в ключ-заменитель можно любой ключ, включая временные ключи (time keys). Ключи-заменители не должны быть слишком сложны и могут просто начинаться с единицы, а далее последовательно увеличиваться при помощи последовательностей Oracle. Реализовав ключи-заменители, можно сэкономить место для хранения информации.

<br/><br/>
<strong>Нормализация хранилища</strong> 

<br/><br/>

Когда доходит до решения вопроса о том, должны ли данные в хранилище быть нормализованы, не все выбирают одно и то же. Некоторые эксперты считают, что хранилище нужно нормализовать, тогда как другие уверены, что более подходящей является нормальная пространственная форма.

Нормальная пространственная форма — вещь довольно интересная, поскольку она выглядит как комбинация нормализации и денормализации. На рис. 2.2
мы видим разницу между двумя подходами к хранению измерения «Магазин».

<br/><br/>



Нормализованную форму также называют снежинкой (snowflaking). Хотя Oracle 9i допускает использование нормализованных измерений, будьте осторожны с этим подходом. Одним из его недостатков является то, что он может повлиять на производительность, поскольку в запросах понадобится большее число соединений, что потребует времени. Форма снежинки является хорошим примером техники, используемой в системах обработки транзакций, но она не всегда подходит для хранилища данных.

<br/><br/>
На первый взгляд, кажется, что нормальная пространственная форма дублирует данные. Хотя можно подумать, что это непроизводительная трата места, на самом деле, число строк в измерениях, как правило, очень мало по сравнению с размерами таблицы фактов. Поэтому вы, возможно, удивитесь, узнав, что хранение этих дополнительных данных обойдется вам всего в несколько десятков мегабайт. Преимущество этого подхода в том, что для доступа к информации в данной модели требуется теперь только два навигационных уровня, что облегчает создание запросов, быстро возвращающих ответы.

<br/><br/>
<strong>Хранилище или тематическое хранилище?</strong>

<br/><br/>

Альтернативой созданию больших хранилищ является создание лавок данных, где каждое тематическое хранилище содержит часть данных большого хранилища.


<br/><br/>
Преимущество тематических хранилищ — в акценте на одной области бизнеса, так что в них можно хранить данные по региону или департаменту. Однако при использовании лавок данных следует быть осторожным. Хотя несколькими тематическими хранилищами (в отличие от одного источника) легче управлять и они идеальны для создания отчетов, интегрировать данные может быть чрезвычайно сложно. В результате можно получить несколько лавок, содержащих дублирующиеся данные, которые нельзя связать друг с другом. Тем не менее, довольно распространенной является практика создания сначала нескольких лавок данных, которые затем используются в качестве основы для создания хранилища масштаба всего предприятия.

<br/><br/>

<strong>Секционирование</strong> 

<br/><br/> 

Секционирование данных — это проектировочный метод, являющийся очень важным для хранилища, поскольку он дает возможность управлять большими объемами данных и контролировать их размещение на дисках. Вместо того, чтобы помещать все данные таблицы в одно табличное пространство, мы можем с помощью секционирования разместить их во многих табличных пространствах. Для определения того, в каком табличном пространстве хранятся данные, выбирается ключ секционирования, например, ключ времени (time_key).

<br/><br/> 

Например, мы проводим секционирование по месяцам, так что данные января попадают в один раздел, данные февраля — в другой и т.д. Ключ секционирования нужно выбирать осторожно, хотя обычным является секционирование по времени. 

<br/><br/> 

<strong>Материализованные представления</strong> 

<br/><br/> 


Мы уже видели, что хранилище или тематические хранилища могут хранить в таблице фактов огромные количества записей. Даже если бы у нас была самая быстрая в мире машина и мы могли бы кэшировать часть данных хранилища в памяти, время ответа на запросы могло бы составлять дни, и наверняка займет минуты или часы.

<br/><br/> 

Для преодоления этой проблемы, разработчики хранилищ используют метод создания сводок (summary), где под сводкой имеется в виду заранее созданная таблица результатов, которая в Oracle называется материализованным представлением (materialized view). 

<br/><br/> 

Например, предположим, что вы всегда запрашиваете число покупок за день по сегодняшнему специальному предложению. Вместо того
чтобы каждый раз подсчитывать эти результаты, создается материализованное представление, содержащее требуемую информацию. Затем, когда вы будете делать такой запрос, он будет направлен к материализованному представлению, а не к таблице фактов. Хотя это частично нарушает концепцию хранилища, в которой вы можете посылать базе данных заранее неизвестные вопросы, нужно честно признать, что довольно многие запросы хорошо известны. Если мы сможем улучшить время ответа на такие запросы, наши пользователи будут нам очень признательны.

<br/><br/> 

В Oracle 9i входит специальный компонент — Summary Management Component, который позволяет создавать вместо обычных таблиц материализованные представления. После этого оптимизатор будет явным образом переписывать ваш запрос для использования этого материализованного представления.


<br/><br/> 
<strong>Oracle Data Mining</strong> 
<br/><br/> 

Oracle Data Mining - обеспечивает встраивание в базу данных функции интеллектуальной обработки данных для выполнения классификации, составления прогнозов и определения связей.
<br/><br/> 


Интеллектуальная обработка данных является частью системы поиска информации. С помощью статистических методов можно преобразовать огромные объемы данных в полезную информацию. Данные служат чем-то вроде руды, извлекаемой из обычного рудника. После превращения в информацию они становятся драгоценным металлом.

<br/><br/> 

Интеллектуальная обработка данных извлекает из данных новую информацию. Это позволяет бизнесу получить из хранилища ранее неизвестные сведения и использовать их при принятии важных деловых решений.

<br/><br/> 

Процесс поиска, как правило, начинается без всякого предварительного представления о том, что будет найдено. Прочитываются большие объемы данных и ищутся сходства, которые можно сгруппировать и по которым можно выявить схемы и тенденции.

<br/><br/>

Средства OLAP и DSS просматривают предписанные взаимоотношения, связанные со структурой данных. Они отражаются в ограничениях (constraints) и измерениях (dimensions). Интеллектуальная обработка данных выявляет взаимоотношения, связанные с содержанием данных, которые еще не определены. Например,какие продукты с наибольшей вероятностью приобретаются вместе. Это называется анализом потребительской корзины. При анализе данных за определенный промежуток времени можно выявить неожиданные схемы поведения. Иногда можно определить вероятность выполнения определенных действий после осуществления некоторых других действий. Типичным применением интеллектуальной обработки данных является удержание покупателя, выявление мошенничества и определение
общей схемы совершения покупок покупателями. Интеллектуальную обработку данных можно применять для поиска новых рыночных возможностей.
<br/><br/>
<br/><br/>







</div>		
		
	

<?php include_once "../../_footer.php"?>

</body>

</html>
