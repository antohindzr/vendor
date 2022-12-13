Интерфейс для добавления оборудования в базу данных. Интерфейс состоит из формы, включающий следующие поля:
1.	Поле textarea для ввода серийных номеров (в каждой строке свой серийный номер).
2.	Поле тип оборудования (значения – из справочника типов оборудования).
3.	Кнопка «Добавить».
Для хранения информации об оборудовании используется 2 таблицы в базе данных:
1.	Тип оборудования (код, наименование типа, маска серийного номера).
2.	Оборудование (код, код типа, серийный номер – уникальное поле).
Пользователь интерфейса добавляет серийные номера в поле ввода, выбирает тип оборудования и нажимает на кнопку «Добавить». При нажатии на кнопку происходит обработка введенных в поле textarea серийных номеров с проверкой каждого номера по маске данного типа оборудования. Проверку использует регулярные выражения. Если серийный номер соответствует маске и отсутствует в базе, добавляем запись в таблицу оборудования, иначе выводим соответствующее сообщение об ошибке.

![Vendor_11](https://user-images.githubusercontent.com/52713085/207416793-9c770a38-ed72-4596-806b-c829837bd5c1.jpg)
![Vendor_21](https://user-images.githubusercontent.com/52713085/207416810-ec4403fa-d75b-44c0-a9e7-6369eac0f5b5.jpg)
![Vendor_31](https://user-images.githubusercontent.com/52713085/207416829-79a58890-6cb3-4f69-9e0a-67174c0511a7.jpg)
![Vendor_41](https://user-images.githubusercontent.com/52713085/207416843-3cc4c2d7-3ed3-46b2-8e16-459c8320084f.jpg)
![Vendor_51](https://user-images.githubusercontent.com/52713085/207416852-6fa9581b-a48a-4dc6-be1a-4b685cff5d7a.jpg)
![Vendor_61](https://user-images.githubusercontent.com/52713085/207416871-5f870868-b916-4b1b-b07c-3ef6c16490a2.jpg)
Приложение включает в себя RESTAPI-версию и WEB-версию.
Для запуска необходимо:
- создать MySQL-БД vendorDB;
- выполнить composer install;
- выполнить миграцию таблиц: php artisan migrate;
- выполнить в БД скрипт toVendor.sql (в корне проекта);
- запустить web-приложение: php artisan serve.
    
    Примеры запросов, доступных к выполнению через Web-интерфейс:
- http://127.0.0.1:8000/vendor;
- http://127.0.0.1:8000/equipment;
- http://127.0.0.1:8000/equipment/create;
- http://127.0.0.1:8000/equipment/1/edit;
- http://localhost:8000/api/requestEquipment;
- http://localhost:8000/api/requestVendor;
    Примеры запросов, доступных к выполнению через Postman:
- GET: http://localhost:8000/api/requestVendor;
- GET: http://localhost:8000/api/requestEquipment;
- POST: http://localhost:8000/api/saveEquipment?vendorID=1&serial=XXAAAAAXAI;
- POST: http://localhost:8000/api/saveVendor?vendorType=TP-Link TL-WR745&maskSN=XXBBBBBBBB;


Запустить rest api приложение: php -S 127.0.0.1:8080
	Примеры запросов, доступных к выполнению через Web-интерфейс:
- http://localhost:8080/app/api/api/read.php;
- http://localhost:8080/app/api/api/single_read.php/?id={};
    Примеры запросов, доступных к выполнению через Postman:
- GET: http://127.0.0.1:8080/app/api/api/read.php;
- GET: http://127.0.0.1:8080/app/api/api/single_read.php/?id={};
- POST: http://127.0.0.1:8080/app/api/api/delete.php; (body raw id);
- POST: http://127.0.0.1:8080/app/api/api/create.php; (body raw vendorID, "serial");
- POST: http://127.0.0.1:8080/app/api/api/update.php; (body raw id, vendorID, "serial").
